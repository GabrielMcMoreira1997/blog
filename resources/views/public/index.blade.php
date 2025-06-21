@extends('includes.template')


@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ url('/') }}">Home</a></li>
            </ol>
        </nav>
        <div class="d-flex justify-content-center">
            <div class="logo-container">
                <img src="{{ asset('images/logo-home-transparent.png') }}" alt="Logo" class="logo">
            </div>
        </div>
        <div class="row mt-5 col-12 col-md-12">
            <div class="col-md-12">
                <h2>Últimas postagens</h2>
                <ul class="list-group">
                    @foreach($posts as $post)

                        <li class="list-group-item px-0 py-0 mb-2">
                            <div class="list-item d-flex align-items-start pe-2">

                                <div class="list-item-header me-3">
                                    <img src="{{ $post['content'][0]['image'] }}"
                                        style="width: 100px; height: 100px; border-radius: 5px; display: block;">
                                </div>

                                <div class="list-item-content flex-grow-1 pt-2">
                                    <a href="{{ route('posts.show', $post['slug']) }}">{{ $post['title'] }}</a>
                                    <p class="m-0">{{ Str::limit($post['description'], 100) }}</p>

                                    <div class="d-flex pt-2 justify-content-between align-items-center ">
                                        <div class="list-group-item-footer-text text-muted fs-5">
                                            @foreach ($post['categories'] as $index => $category)
                                                <a class="category-name"
                                                    href="{{ route('posts.search', ['category' => $category['name']]) }}">
                                                    {{ $category['name'] }}
                                                </a>@if (!$loop->last), @endif
                                            @endforeach
                                        </div>
                                        <div>
                                            <small>Publicado em
                                                {{ \Carbon\Carbon::parse($post['created_at'])->translatedFormat('d \d\e F \d\e Y') }}</small>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </li>

                    @endforeach
                </ul>
            </div>
        </div>
@endsection