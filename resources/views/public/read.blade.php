@extends('includes.template')

@section('content')
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $post['title'] }}</li>
    </ol>
</nav>
<div class="header d-flex flex-column align-items-center">
    <div class="header-image w-100">

        <img src="{{ $post['content'][0]['image'] }}" alt="Imagem do post">
    </div>

    <div class="header-text text-center mt-3 px-3">
        <h1 class="mb-1">{{ $post['title'] }}</h1>
        <div class="d-flex flex-column justify-content-between">
            <div class="text-muted mb-1">
                <img src="{{ asset('images/profile.jpg') }}" alt="Autor" width="30" height="30" class="rounded-circle me-2" style="object-fit: cover;">
                Gabriel Moreira <i class="fa-solid fa-user"></i>
            </div>
            <div class="text-muted mb-1">
                Publicado em 22 de abril de 2025 <i class="fa-solid fa-calendar-days"></i>
            </div>
        </div>

        <hr style="width: 100%; height: 1px; background-color: #ccc; border: none;" class="mb-3">
    </div>

    <div class="post-content">
        {!! $post['content'][0]['content'] !!}
    </div>

    <!-- <div class="post-footer">
        Technology, Health, Lifestyle
    </div> -->
</div>
@endsection
