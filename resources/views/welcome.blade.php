<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bem-vindo à Nossa Igreja</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])

    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">

    <style>
        .slide-in-bottom {
            animation: slide-in-bottom 0.5s cubic-bezier(.25, .46, .45, .94) both;
        }

        .slide-in-bottom-h1 {
            animation: slide-in-bottom 0.5s cubic-bezier(.25, .46, .45, .94) 0.5s both;
        }

        .slide-in-bottom-subtitle {
            animation: slide-in-bottom 0.5s cubic-bezier(.25, .46, .45, .94) 0.75s both;
        }

        .fade-in {
            animation: fade-in 1.2s cubic-bezier(.39, .575, .565, 1.000) 1s both;
        }

        @keyframes slide-in-bottom {
            0% {
                transform: translateY(1000px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fade-in {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
</head>

<body class="leading-normal tracking-normal text-gray-900" style="font-family: 'Source Sans Pro', sans-serif;">

    <div class="h-screen bg-white bg-right bg-cover pb-14">
        <!--Nav-->
        <div class="container w-full p-6 mx-auto">
            <div class="flex items-center justify-between w-full">
                <a class="flex items-center text-2xl font-bold text-blue-400 no-underline hover:no-underline lg:text-4xl"
                    href="#">
                    <x-application-logo class="h-8 pr-2 text-blue-500 fill-current" />
                    <span>4FChurch</span>
                </a>
            </div>
        </div>

        <!--Main-->
        <div class="container flex flex-col flex-wrap items-center px-6 pt-24 mx-auto md:pt-48 md:flex-row">
            <!--Left Col-->
            <div class="flex flex-col justify-center w-full overflow-y-hidden xl:w-2/5 lg:items-start">
                <h1
                    class="my-4 text-3xl font-bold leading-tight text-center text-blue-400 md:text-5xl md:text-left slide-in-bottom-h1">
                    Bem-vindo à Nossa Igreja</h1>
                <p class="mb-8 text-base leading-normal text-center md:text-2xl md:text-left slide-in-bottom-subtitle">
                    Gerencie suas finanças e membros com fé e eficiência.</p>

                <div class="flex justify-center w-full pb-24 md:justify-start lg:pb-0 fade-in">
                    <a href="/login"
                        class="px-4 py-2 text-white bg-blue-500 rounded-full shadow hover:bg-blue-600">Entrar</a>
                    <a href="/register"
                        class="px-4 py-2 ml-4 text-white bg-green-500 rounded-full shadow hover:bg-green-600">Registrar</a>
                </div>

                <div class="mt-8 text-center md:text-left fade-in">
                    <p class="text-gray-600">"Porque Deus amou o mundo de tal maneira que deu o seu Filho unigênito,
                        para que todo aquele que nele crê não pereça, mas tenha a vida eterna." <br> <span
                            class="font-semibold">- João 3:16</span></p>
                </div>
            </div>

            <!--Right Col-->
            <div class="w-full py-6 overflow-y-hidden xl:w-3/5">
                <img class="w-5/6 mx-auto lg:mr-0 slide-in-bottom" src="devices.svg" alt="Imagem de Dispositivos">
            </div>
        </div>

        <!--Footer-->
        <div class="w-full pt-16 pb-6 text-sm text-center md:text-left fade-in">
            <a class="text-gray-500 no-underline hover:no-underline" href="#">&copy; Nossa Igreja 2024</a>
        </div>
    </div>
</body>

</html>
