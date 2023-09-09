@include('layouts.includes.header-adm')
<body class="font-sans antialiased">
<x-banner />

<div class="min-h-screen bg-gray-100">
    @livewire('nav-admin-menu')

    <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                @yield('header')
            </div>
        </header>
    <div class="col-6">
        @if (Session::has('msg'))
            <div class="my-alert">
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    {!! Session::get('msg') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @elseif(Session::has('error'))
            <div>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {!! Session::get('error') !!}
                    <button type="button" class="btn-close btn-assinar" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
    </div>


    <!-- Page Content -->
    <main>
        @yield('conteudo')
    </main>
</div>

@stack('modals')
<script type="text/javascript">
    $("#cpf").mask("000.000.000-00");
    $("#indicado_por").mask("000.000.000-00");
    $("#dtnasc").mask("00/00/0000");
    $("#tel_fixo").mask('(00) 0000-0000');
    $("#celular").mask('(00) 00000-0000');
    $("#tel_com").mask('(00) 0000-00009');
    $("#cep").mask('00.000-000');
</script>
@livewireScripts
</body>
</html>
