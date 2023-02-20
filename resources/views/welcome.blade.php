<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.2/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="{{asset('css/my-style.css')}}" rel="stylesheet">
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-white green:text-gray-500 underline">Painel de Controle</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-white green:text-gray-500 underline">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-white green:text-gray-500 underline">Cadastre-se</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <!-- Icone Marca -->
                <div class="flex justify-center pt-8 sm:justify-start mb-3 sm:pt-0">
                    <a href="{{'/'}}"> <img src="{{asset('images/marca_sf.png')}}" alt="marca" height="120px"/></a>
                </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="card card-my">
                                    <div class="card-body">
                                        <h5 class="card-title">Rachão das 14h</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">FIFA Football</h6>
                                        <h6 class="card-subtitle mb-2 text-muted">Taxa de inscrição: $5,00</h6>
                                        <h6 class="card-subtitle mb-2 text-muted">Inscritos: 03 de 08 Vagas</h6>
                                        <p class="card-text">Rachão com no máximo 08 participantes. Entre e mostre que você é o melhor. O vencedor final leva o prêmio.</p>
                                        <a href="#" class="card-link">Entrar no rachão</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="card card-my">
                                    <div class="card-body">
                                        <h5 class="card-title">Rachão das 14h</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Pro Evolution Soccer</h6>
                                        <h6 class="card-subtitle mb-2 text-muted">Taxa de inscrição: $15,00</h6>
                                        <h6 class="card-subtitle mb-2 text-muted">Inscritos: 05 de 08 Vagas</h6>
                                        <p class="card-text">Rachão com no máximo 08 participantes. Entre e mostre que você é o melhor. O vencedor final leva o prêmio.</p>
                                        <a href="#" class="card-link">Entrar no rachão</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="card card-my">
                                    <div class="card-body">
                                        <h5 class="card-title">Rachão das 15h05</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">FIFA Football</h6>
                                        <h6 class="card-subtitle mb-2 text-muted">Taxa de inscrição: $50,00</h6>
                                        <h6 class="card-subtitle mb-2 text-muted">Inscritos: 03 de 08 Vagas</h6>
                                        <p class="card-text">Rachão com no máximo 08 participantes. Entre e mostre que você é o melhor. O vencedor final leva o prêmio.</p>
                                        <a href="#" class="card-link">Entrar no rachão</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="card card-my">
                                    <div class="card-body">
                                        <h5 class="card-title">Rachão das 15h05</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Pro Evolution Soccer</h6>
                                        <h6 class="card-subtitle mb-2 text-muted">Taxa de inscrição: $5,00</h6>
                                        <h6 class="card-subtitle mb-2 text-muted">Inscritos: 03 de 08 Vagas</h6>
                                        <p class="card-text">Rachão com no máximo 08 participantes. Entre e mostre que você é o melhor. O vencedor final leva o prêmio.</p>
                                        <a href="#" class="card-link">Entrar no rachão</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                <div class="mt-8 bg-green overflow-hidden sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                    <a href="#" class="underline text-white">Documentação</a>
                                </div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-white text-sm">
                                    Aqui você terá acesso a toda documentação da nossa plataforma. Nosso objetivo é proporcionar todo conforto e segurança nas suas disputas entre amigos. Nós recomendamos que você leia atentamente antes de criar a sua conta.
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-green-700 md:border-t-0 md:border-l">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white">
                                    <path stroke-linecap="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                    <a href="https://laracasts.com" class="underline text-white">Laracasts</a>
                                </div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-white text-sm">
                                    Laracasts offers thousands of video tutorials on Laravel, PHP, and JavaScript development. Check them out, see for yourself, and massively level up your development skills in the process.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-white sm:text-left">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-mt-px w-5 h-5 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                            </svg>

                            <a href="https://laravel.bigcartel.com" class="ml-1 underline">
                                Shop
                            </a>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ml-4 -mt-px w-5 h-5 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>

                            <a href="https://github.com/sponsors/taylorotwell" class="ml-1 underline">
                                Sponsor
                            </a>
                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm text-white sm:text-right sm:ml-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
