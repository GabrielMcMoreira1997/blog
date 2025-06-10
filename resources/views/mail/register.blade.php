<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Inscrição</title>
    <style>
        /* Reset de CSS para consistência entre clientes de e-mail */
        body,
        p,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        table,
        td,
        tr,
        img {
            margin: 0;
            padding: 0;
            border: 0;
            font-family: Arial, sans-serif;
            box-sizing: border-box;
        }

        /* Estilos gerais do corpo do e-mail */
        body {
            background-color: #192339;
            color: #E5E7EB;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            width: 100% !important;
            min-width: 100%;
            height: 100%;
            line-height: 1.6;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill-rule='evenodd'%3E%3Cg fill='%234b5563' fill-opacity='0.14'%3E%3Cpath opacity='.5' d='M96 95h4v1h-4v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9zm-1 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9z'/%3E%3Cpath d='M6 5V0H5v5H0v1h5v94h1V6h94V5H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            background-repeat: repeat;
        }

        /* Container principal do e-mail */
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #192339;
            /* Para garantir que o background-image não sobreponha */
            border: 1px solid #4b5563;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Cabeçalho */
        .header {
            background-color: #192339;
            padding: 20px 30px;
            text-align: center;
            border-bottom: 1px solid #4b5563;
        }

        .header h1 {
            color: #E5E7EB;
            font-size: 28px;
            margin: 0;
        }

        /* Conteúdo principal */
        .content {
            padding: 30px;
            text-align: center;
        }

        .content p {
            color: #E5E7EB;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .content .button {
            display: inline-block;
            background-color: #4b5563;
            /* Cor do botão */
            color: #E5E7EB;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .content .button:hover {
            background-color: #6b7280;
            /* Cor do botão ao passar o mouse */
        }

        /* Rodapé */
        .footer {
            background-color: #192339;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #4b5563;
            font-size: 12px;
            color: #4b5563;
        }

        .footer p {
            margin-bottom: 5px;
            color: #E5E7EB;
        }

        .footer a {
            color: #E5E7EB;
            text-decoration: underline;
        }

        /* Responsividade básica (para clientes que suportam media queries) */
        @media screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
                margin: 0 auto !important;
                border-radius: 0;
            }

            .header,
            .content,
            .footer {
                padding: 20px !important;
            }

            .header h1 {
                font-size: 24px !important;
            }

            .content p {
                font-size: 15px !important;
            }

            .content .button {
                padding: 10px 20px !important;
                font-size: 16px !important;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>Recebemos sua inscrição 🎉</h1>
        </div>
        <div class="content">
            <p>Olá {{ $email }},</p>
            <p>Muito obrigado(a) por se inscrever na nossa newsletter! Estamos super felizes em tê-lo(a) a bordo. 🚀</p>
            <p>A partir de agora, você receberá todas as atualizações do nosso blog direto na sua caixa de entrada. 📩
            </p>
            <hr style="border-color: #4b5563;">
            <p>Se você não fez essa inscrição, sem problemas! Você pode ignorar este e-mail ou usar o link de
                cancelamento no rodapé. 🚫</p>
            <p>Atenciosamente,<br> Gabriel Moreira</p>
        </div>
        <div class="footer">
            <p>Sinta-se à vontade para conectar comigo! 👇</p>
            <p style="margin-bottom: 10px;">
                <a href="https://linkedin.com/in/gabriel-mcm" target="_blank"
                    style="text-decoration: none; color: #E5E7EB;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#E5E7EB" viewBox="0 0 24 24"
                        style="vertical-align: middle; margin-right: 5px;">
                        <path
                            d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                    </svg>
                    LinkedIn
                </a>
                <span style="color: #E5E7EB; margin: 0 5px;">|</span>
                <a href="https://github.com/GabrielMcMoreira1997" target="_blank"
                    style="text-decoration: none; color: #E5E7EB;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#E5E7EB" viewBox="0 0 24 24"
                        style="vertical-align: middle; margin-right: 5px;">
                        <path
                            d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.903.167 1.232-.39 1.232-.862 0-.423-.015-1.536-.021-3.09-.333.069-.652-.162-.973-.298-.484-.216-1.026-.511-1.428-.854-.424-.37-.775-.826-.959-1.258-.29-.69-.537-.92-.663-1.028-.207-.156-.506-.24-.007-.247.423-.01.768.196 1.054.492.356.368.835.816 1.722 1.21.677.306 1.346.459 2.02.459 2.122 0 3.491-1.229 3.491-2.616 0-.61-.226-1.127-.601-1.528 1.134-.124 2.329-.466 2.329-2.497 0-.709-.253-1.299-.672-1.756.07-.124.238-.667-.061-1.737 0 0-.546-.176-1.785.67-.521-.144-1.077-.216-1.65-.219-2.027.003-3.692 1.637-3.692 3.659 0 1.002.392 1.879 1.058 2.531-.838.163-1.603.262-2.148.262-.489 0-.962-.05-1.41-.143-1.879-.374-3.136-2.179-3.136-4.526 0-3.328 2.673-6 5.992-6 3.003 0 5.467 2.164 5.952 5.068.049.296.126.757.257 1.178.293.993.856 1.492 1.621 1.492.684 0 1.164-.26 1.455-.717.31-.497.491-1.096.491-1.895 0-2.493-1.901-4.707-4.582-4.707-.988 0-1.871.378-2.551 1.01-.157.149-.247.34-.247.544 0 .332.26.602.585.602h.001zm-4.772 13.918c-.896.34-.896.793-.896 1.442s0 1.096-.014 1.442c-.029.743.208 1.411 1.173 1.054 1.066-.39 1.259-.728 1.259-1.472 0-.649-.193-1.028-1.259-1.442z" />
                    </svg>
                    Github
                </a>
            </p>
            <p> <a href="{{ route('newslatter.unregister', [
                    'mail' => $emailEncode,
                    'decode' => true
                ]) }}" target="_blank" style="color: #E5E7EB; text-decoration: underline;">Cancelar Inscrição</a></p>
            <p style="color: #E5E7EB;">&copy; 2025 - About Software.</p>
        </div>
    </div>
</body>

</html>