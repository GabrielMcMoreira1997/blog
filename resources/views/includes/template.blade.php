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

    <style>
        /* Estilos para o spinner de loading */
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
            border-width: .15em;
        }
    </style>
</head>
<body>
    <div class="container px-5 pt-5">

        @yield('content')

        <footer class="mt-5 text-center footer">
            <h1>Receba novas postagens</h1>
            <p class="mb-0 pb-0">Assine a newsletter para receber atualizações sobre novos conteúdos.</p>

            {{-- Mensagem de retorno --}}
            @if(session('message'))
                <div id="newsletter-message" class="alert {{ session('status') ? 'alert-success' : 'alert-danger' }} mt-3 w-75 mx-auto">
                    {{ session('message') }}
                </div>
            @endif

            <form id="newsletter-form" action="{{ route('newslatter.register') }}" method="POST" class="d-flex justify-content-center mt-3">
                @csrf
                <input type="email" name="email" class="form-control me-2 email" placeholder="Seu e-mail" required>
                <button type="submit" class="btn btn-primary" id="newsletter-button">
                    Assinar
                </button>
            </form>

            <div class="row py-3">
               <div class="col-12 text-center">
                   <p class="text-muted mb-0" style="color: #4b5563 !important;">&copy; {{ date('Y') }} - About Software. | Desenvolvido com 💚 por Gabriel Moreira</p>
                   <p class="text-muted mb-0" style="color: #4b5563 !important;">
                       <a href="{{ route('policy') }}" class="text-decoration-none" style="color: #E5E7EB;">Política de Privacidade</a>
                   </p>
               </div>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        // Script para fazer a mensagem de retorno desaparecer
        setTimeout(() => {
            const msg = document.getElementById('newsletter-message');
            if (msg) {
                msg.style.transition = 'opacity 0.5s ease';
                msg.style.opacity = 0;
                setTimeout(() => msg.remove(), 500);
            }
        }, 4000);

        // Novo script para desabilitar o botão e adicionar loading
        document.addEventListener('DOMContentLoaded', function() {
            const newsletterForm = document.getElementById('newsletter-form');
            const newsletterButton = document.getElementById('newsletter-button');

            if (newsletterForm && newsletterButton) {
                newsletterForm.addEventListener('submit', function() {
                    // Desabilita o botão
                    newsletterButton.disabled = true;

                    // Adiciona o spinner de loading
                    newsletterButton.innerHTML = `
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    `;
                });
            }
        });
    </script>
</body>
</html>