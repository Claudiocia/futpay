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
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
        <script type="text/javascript">
            $("#cpf").mask("000.000.000-00");
            $("#indicado_por").mask("000.000.000-00");
            $("#dtnasc").mask("00/00/0000");
            $("#tel_fixo").mask('(00) 0000-0000');
            $("#celular").mask('(00) 00000-0000');
            $("#tel_com").mask('(00) 0000-00009');
            $("#cep").mask('00.000-000');
        </script>
    </body>
</html>
