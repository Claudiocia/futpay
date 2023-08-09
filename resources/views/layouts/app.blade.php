@include('layouts.includes.header-log')
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            <div class="col-6">
                @if (Session::has('msg'))
                    <div class="my-alert">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {!! Session::get('msg') !!}
                        </div>
                    </div>
                @elseif(Session::has('error'))
                    <div>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {!! Session::get('error') !!}
                        </div>
                    </div>
                @endif
            </div>

            <!-- Page Content -->
            <main>
                @if(isset($slot))
                    {{$slot}}
                @else
                    @yield('conteudo')
                @endif
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
