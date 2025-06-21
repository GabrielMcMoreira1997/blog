@extends('includes.template')

@section('content')
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pesquisa</li>
    </ol>
</nav>
<header class="header text-center justify-content-center mb-4">
<div class="header-text mx-auto" style="max-width: 800px;">
    <h1 class="display-4 fw-bold" style="color: #E5E7EB;">Pesquisar Postagens</h1>
    <p class="lead" style="color: #9CA3AF;">Encontre artigos e tutoriais do seu interesse em nosso blog.</p>
</div>
</header>

<div class="row justify-content-center mb-5">
    <div class="col-md-8">
        <form action="{{ route('posts.search') }}" method="GET" class="d-flex flex-column flex-md-row align-items-md-end">
            <div class="flex-grow-1 me-md-2 mb-3 mb-md-0">
                <label for="pesquisa" class="form-label visually-hidden">Pesquisar por Título ou Conteúdo</label>
                <input type="text" class="form-control form-control-lg" id="pesquisa" name="pesquisa" placeholder="Pesquisar por título ou conteúdo..." value="{{ request('pesquisa') }}">
            </div>
            <div class="me-md-2 mb-3 mb-md-0">
                <label for="category" class="form-label visually-hidden">Categoria</label>
                <select class="form-select form-select-lg" id="category" name="category">
                    <option value="">Todas as Categorias</option>
                    {{-- Iterar sobre as categorias passadas pela controladora --}}
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary btn-lg w-100 w-md-auto">
                    <i class="fas fa-search me-2"></i>Buscar
                </button>
            </div>
        </form>
    </div>
</div>

---

<section class="search-results">
    @if(isset($posts) && $posts->count() > 0)
        <h2 class="mb-4" style="color: #E5E7EB;">Resultados da Pesquisa</h2>
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100" style="background-color: #1f2937; border: none;">
                        @if($post->content[0]->image) {{-- Verifica se a imagem existe --}}
                            <img src="{{$post->content[0]->image}}" class="card-img-top" alt="{{ $post->title }}" style="max-height: 200px; object-fit: cover;">
                        @else
                            {{-- Placeholder ou imagem padrão se não houver imagem --}}
                            <img src="{{ asset('images/default-post-image.jpg') }}" class="card-img-top" alt="Imagem Padrão" style="max-height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title" style="color: #93C5FD;">{{ $post->title }}</h5>
                            {{-- Acessa o conteúdo do corpo da postagem para o excerpt --}}
                            <p class="card-text" style="color: #D1D5DB;">{{ Str::limit($post->description ?? '', 100) }}</p>
                            <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-outline-light">Leia Mais</a>
                        </div>
                        <div class="card-footer" style="background-color: #111827; border-top: 1px solid #374151;">
                            <small class="text-muted">Publicado em: {{ $post->created_at->format('d/m/Y') }}</small>
                            @if($post->categories->isNotEmpty())
                                <small class="text-muted d-block">Categoria:
                                    @foreach($post->categories as $category)
                                        <span class="badge bg-secondary">{{ $category->name }}</span>
                                    @endforeach
                                </small>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{-- Adiciona os parâmetros da pesquisa à paginação --}}
            {{ $posts->appends(request()->query())->links() }}
        </div>
    @elseif(request()->has('pesquisa') || request()->has('category'))
        <div class="alert alert-info text-center" role="alert" style="background-color: #1f2937; color: #D1D5DB; border: 1px solid #4B5563;">
            Nenhum resultado encontrado para sua pesquisa.
        </div>
    @endif
</section>
@endsection