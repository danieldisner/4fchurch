<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .success-message {
            background-color: #0e8312;
            color: white;
            padding: 10px;
            margin-top: 20px;
            border-radius: 4px;
            text-align: center;
        }

        .error-message {
            background-color: #af0c00;
            color: white;
            padding: 10px;
            margin-top: 20px;
            border-radius: 4px;
            text-align: center;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Include navigation -->
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Success message -->
        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error modal -->
        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Seleciona as mensagens de sucesso e de erro
        var successMessage = document.querySelector('.success-message');
        var errorMessage = document.querySelector('.error-message');

        // Função para ocultar as mensagens após 5 segundos
        function hideMessages() {
            setTimeout(function() {
                if (successMessage)
                    successMessage.style.display = 'none';
                /*
                if (errorMessage)
                    errorMessage.style.display = 'none';
                */
            }, 5000);
        }

        // Chama a função para ocultar as mensagens
        hideMessages();
    });
</script>
