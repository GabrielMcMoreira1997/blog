<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Blog sobre desenvolvimento de software, programação e tecnologia. Aprenda sobre as últimas tendências e dicas para melhorar suas habilidades.">
    <meta name="keywords" content="blog, software, desenvolvimento, programação, tecnologia, dicas, tutoriais">
    <meta name="author" content="Gabriel Martins Carvalho Moreira">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">

    <title>@yield('title', 'Blog - Software Development')</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/read.css') }}">
    <script src="https://kit.fontawesome.com/4925ae2c93.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo-transparent.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/highlight.js@11.9.0/styles/github-dark.min.css">
    <script src="https://cdn.jsdelivr.net/npm/highlight.js@11.9.0/lib/highlight.min.js"></script>
    {{-- Script do CKEditor 5 --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

</head>
<body>
    <div class="container p-5">

        @yield('content')

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    {{-- Seção para scripts específicos de cada página --}}
    @yield('scripts')
</body>
</html>