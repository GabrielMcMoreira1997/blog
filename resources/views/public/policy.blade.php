@extends('includes.template')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="logo-container">
            <img src="{{ asset('images/logo-home-transparent.png') }}" alt="Logo" class="logo">
        </div>
    </div>
    <div class="row mt-5 col-12 col-md-12">
        <div class="col-md-12">
            {{-- Cole o conteúdo da política de privacidade aqui --}}
            <div class="container my-5" style="background-color: #192339; color: #E5E7EB; padding: 30px; border-radius: 8px; border: 1px solid #4b5563;">
                <h2 class="text-center mb-4" style="color: #E5E7EB;">Nossa Política de Privacidade (bem de boa! 😉)</h2>
                <p>Olá! Que bom te ver por aqui, interessado(a) em saber como cuidamos dos seus dados. A gente valoriza muito a sua privacidade e quer deixar tudo superclaro.</p>

                <h3 class="mt-4" style="color: #E5E7EB;">O Que Coletamos (e o Que Não Coletamos!) 🧐</h3>
                <p>A gente gosta de manter as coisas simples. No nosso blog, <strong>não coletamos cookies</strong>, <strong>nem salvamos nenhum tipo de informação de navegação</strong> sobre você. Pode relaxar!</p>
                <p>A única informação que guardamos é o seu <strong>e-mail</strong>, e isso acontece <strong>apenas se você se inscrever na nossa newsletter</strong>. Assim, conseguimos te enviar as novidades do blog diretamente.</p>
                <ul>
                    <li><strong>E-mail</strong>: Coletamos seu endereço de e-mail e a data de registro quando você assina nossa newsletter. Simples assim!</li>
                </ul>

                <h3 class="mt-4" style="color: #E5E7EB;">Controle Total do Seu E-mail (Sem Complicações! ✅)</h3>
                <p>Sua liberdade é importante para nós! Se, a qualquer momento, você decidir que não quer mais receber nossas notícias, é super fácil sair da lista:</p>
                <ul>
                    <li><strong>Cancelar Inscrição</strong>: Você pode remover seu e-mail do nosso banco de dados a qualquer momento, clicando neste link: <a href="javascript:void(0);" onclick="promptForEmailAndunsubscritionscribe();" style="color: #4b5563; text-decoration: underline;"><strong>[Cancelar Inscrição da Newsletter]</strong></a>.</li>
                    <li><strong>No E-mail</strong>: E para sua comodidade, todo e-mail de newsletter que você receberá também virá com um link de "cancelar inscrição" lá no rodapé. Fique à vontade!</li>
                </ul>

                <h3 class="mt-4" style="color: #E5E7EB;">Quer Bater um Papo? Fale Comigo! 💬</h3>
                <p>Se tiver qualquer dúvida, sugestão ou só quiser trocar uma ideia, pode me procurar! Adoraria conversar.</p>
                <ul>
                    <li><strong>E-mail</strong>: <a href="mailto:gabrielc.moreira97@gmail.com" style="color: #4b5563; text-decoration: underline;">gabrielc.moreira97@gmail.com</a></li>
                    <li><strong>LinkedIn</strong>: <a href="https://linkedin.com/in/gabriel-mcm" target="_blank" style="color: #4b5563; text-decoration: underline;">Conecte-se no LinkedIn!</a></li>
                    <li><strong>GitHub</strong>: <a href="https://github.com/GabrielMcMoreira1997" target="_blank" style="color: #4b5563; text-decoration: underline;">Veja meus projetos no GitHub!</a></li>
                </ul>
                <p class="mt-4">Obrigado(a) por fazer parte da nossa comunidade! 😊</p>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.footer').empty();
        });

        function promptForEmailAndunsubscritionscribe() {
            const email = prompt("Por favor, digite o e-mail que deseja cancelar a inscrição:");

            if (email) {
                const encodedEmail = encodeURIComponent(email);
                window.location.href = "{{ route('newslatter.unregister') }}?mail=" + encodedEmail;
            } else if (email === null) {
                alert("Cancelamento de inscrição abortado.");
            } else {
                alert("Por favor, digite um e-mail válido para cancelar a inscrição.");
            }
        }
    </script>
@endsection