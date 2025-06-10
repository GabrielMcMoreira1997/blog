@extends('includes.template-admin')

@section('content')
    <div class="row mt-5 col-12 col-md-12">
        <div class="col-md-12">
            <div class="d-flex justify-content-between">

                <h2>Gerenciar postagens</h2>
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('posts.create') }}" class="btn btn-primary">Criar nova postagem</a>
                </div>
            </div>

            {{-- Lista de postagens --}}
            <ul class="list-group">
                @foreach($posts as $post)
                    <li class="list-group-item px-0 py-0 mb-2">
                        <div class="list-item d-flex justify-content-between align-items-start pe-2">

                            {{-- Imagem alinhada ao topo, sem espaço extra --}}
                            <div class="list-item-header me-3" style="align-self: start;">
                                <img src="{{ $post['content'][0]['image'] }}"
                                    style="width: 100px; height: 100px; border-radius: 5px; display: block;">
                            </div>

                            {{-- Conteúdo --}}
                            <div class="list-item-content flex-grow-1 me-3">
                                <a href="{{ route('posts.show', $post['slug']) }}"
                                    class="h5 d-block mb-1">{{ $post['title'] }}</a>
                                <p class="mb-2">{{ Str::limit(strip_tags($post['description']), 100) }}</p>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="list-group-item-footer-text text-muted">
                                        @foreach ($post['categories'] as $index => $category)
                                            {{ $category['name'] }}@if (!$loop->last), @endif
                                        @endforeach
                                    </div>
                                    <div>
                                        <small>Publicado em
                                            {{ \Carbon\Carbon::parse($post['created_at'])->translatedFormat('d \d\e F \d\e Y') }}</small>
                                    </div>
                                </div>
                            </div>

                            {{-- Botões à direita --}}
                            <div class="d-flex flex-column gap-2 align-items-end pt-2">
                                <a href="{{ route('posts.edit', $post['slug']) }}"
                                    class="btn btn-outline-warning btn-sm">Editar</a>
                                <form action="{{ route('posts.delete', $post['slug']) }}" method="POST"
                                    onsubmit="return confirm('Tem certeza que deseja excluir esta postagem?');"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Excluir</button>
                                </form>
                            </div>

                        </div>
                    </li>
                @endforeach


            </ul>
        </div>
    </div>

@endsection