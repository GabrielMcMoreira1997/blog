@extends('includes.template-admin')

@section('content')

<form action="{{ route('posts.update') }}" method="POST" enctype="multipart/form-data">
    {{ method_field('PUT') }}
    <input type="hidden" name="post_id" value="{{ $post['id'] }}">
    <input type="hidden" name="old_image" value="{{ $post['content'][0]['image'] }}">

    @csrf
    <div class="mb-3">
        <label for="img_header" class="form-label text-white">Imagem Header:</label>
        <input type="file" class="form-control" id="img_header" name="img_header">
    </div>
    <div class="mb-3">
        <label for="title" class="form-label text-white">Título</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ $post['title'] }}" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label text-white">Descrição</label>
        <input type="text" class="form-control" id="description" name="description" value="{{ $post['description'] }}" required>
    </div>
    <div class="mb-3">
        <label for="content" class="form-label text-white">Conteúdo</label>
        <textarea id="editor" name="content" class="form-control">{{ $post['content'][0]['content'] }}</textarea>
    </div>

    <div class="mb-3">
        <label for="categories" class="form-label text-white">Categorias</label>
        <select class="form-control" id="categories" name="categories[]" multiple required>
            @foreach($categories as $category)
                @if($category->id === $post['categories'][0]['id'])
                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                @else
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <input type="submit" value="Editar Post" class="btn btn-primary">
    </div>
</form>

<hr style="width: 100%; height: 1px; background-color: #ccc; border: none;" class="mb-3">
<h1 class="text-center">Preview</h1>
<hr style="width: 100%; height: 1px; background-color: #ccc; border: none;" class="mb-3">

<div class="header d-flex flex-column align-items-center">
    <div class="header-image w-100">
        <img id="preview-image" src="{{ $post['content'][0]['image'] }}" alt="Imagem do post">
    </div>

    <div class="header-text text-center mt-3 px-3">
        <div class="d-flex flex-column justify-content-between">
            <h1 class="mb-1" id="preview-title">{{ $post['title'] }}</h1>
            <div class="text-muted mb-1">
                <img src="{{ asset('images/profile.jpg') }}" alt="Autor" width="30" height="30" class="rounded-circle me-2" style="object-fit: cover;">
                Gabriel Moreira <i class="fa-solid fa-user"></i>
            </div>
            <div class="text-muted mb-1">
                Publicado em {{ \Carbon\Carbon::now()->translatedFormat('d \d\e F \d\e Y') }} <i class="fa-solid fa-calendar-days"></i>
            </div>
        </div>

        <hr style="width: 100%; height: 1px; background-color: #ccc; border: none;" class="mb-3">
    </div>

    <div class="post-content" id="preview-content">
        <p>{!! $post['content'][0]['content'] !!}</p>
    </div>
</div>

<script>
    // Preview do título
    document.getElementById('title').addEventListener('input', function () {
        document.getElementById('preview-title').textContent = this.value || 'Post Exemplo';
    });

    // Preview da imagem do cabeçalho
    document.getElementById('img_header').addEventListener('change', function (e) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('preview-image').src = e.target.result;
        };
        if (this.files[0]) {
            reader.readAsDataURL(this.files[0]);
        }
    });

    // --- Adaptador de Upload de Imagem para Base64 ---
    class MyUploadAdapter {
        constructor( loader ) {
            // O 'loader' é um objeto CKEditor 5 que representa o arquivo a ser carregado.
            this.loader = loader;
        }

        // Método chamado pelo CKEditor para iniciar o upload.
        upload() {
            return this.loader.file
                .then( file => new Promise( ( resolve, reject ) => {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        // Quando o arquivo é lido, resolve a promise com a string Base64.
                        // O CKEditor 5 espera um objeto com uma propriedade 'default'.
                        resolve({ default: reader.result });
                    };

                    reader.onerror = function(error) {
                        // Se houver um erro na leitura do arquivo, rejeita a promise.
                        reject(error);
                    };

                    reader.onabort = function() {
                        // Se a leitura for abortada, rejeita a promise.
                        reject();
                    };

                    // Inicia a leitura do arquivo como uma URL de dados (Base64).
                    reader.readAsDataURL(file);
                } ) );
        }

        // Método chamado pelo CKEditor para abortar o upload.
        // Para Base64, geralmente não há uma operação assíncrona para abortar.
        abort() {
            // Pode deixar vazio ou adicionar lógica de limpeza se necessário.
        }
    }

    // Plugin customizado para integrar o MyUploadAdapter ao CKEditor.
    function MyCustomUploadAdapterPlugin( editor ) {
        editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
            return new MyUploadAdapter( loader );
        };
    }

    // --- Fim do Adaptador de Upload ---

    // Inicialização do CKEditor 5
    ClassicEditor
        .create(document.querySelector('#editor'), {
            // Adiciona o plugin customizado que acabamos de criar.
            extraPlugins: [ MyCustomUploadAdapterPlugin ],

            // Configuração da barra de ferramentas do editor.
            toolbar: {
                items: [
                    'undo', 'redo', '|', 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',
                    '|', 'imageUpload', 'insertTable', 'mediaEmbed', // 'imageUpload' é o botão que usará nosso adaptador
                    '|', 'codeBlock', 'highlight', '|', 'sourceEditing'
                ]
            },
            // Configurações específicas para o plugin de imagem.
            image: {
                toolbar: [
                    'imageTextAlternative',
                    'toggleImageCaption',
                    'imageStyle:inline',
                    'imageStyle:block',
                    'imageStyle:side'
                ],
                // Define os tipos de arquivo permitidos para upload via o seletor de arquivos.
                upload: {
                    types: [ 'jpeg', 'png', 'gif', 'bmp', 'webp' ]
                }
            },
            // Desativa o recurso EasyImage, que tenta fazer upload para um serviço de backend.
            easyImage: {
                uploadUrl: '' // Deixe vazio para garantir que ele não tente usar um URL de upload externo.
            },
            // Permite que o editor preserve certos elementos HTML, atributos e classes.
            htmlSupport: {
                allow: [
                    {
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }
                ]
            }
        })
        .then(editor => {
            console.log('CKEditor 5 foi inicializado', editor);
            // Atualiza o preview do conteúdo em tempo real conforme o usuário digita.
            editor.model.document.on('change:data', () => {
                document.getElementById('preview-content').innerHTML = editor.getData();
            });
        })
        .catch(error => {
            // Loga qualquer erro que ocorra durante a inicialização do editor.
            console.error(error);
        });
</script>

@endsection
