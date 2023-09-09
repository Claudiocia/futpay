@extends('layouts.app')

@section('conteudo')
<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div id="admin-content">
        <div class="container-admin">
            <div class="row">
                <div class="col-md-12">
                    <div class="w-auto p-3">
                        <div class="panel-heading-admin">
                            <h5 class="mb-3">Extrato da conta</h5>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div id="register-show">
                                    <div class="row bloco-div-show desk">
                                        <div class="nome">
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Nome Títular</h6>
                                            <div class="texto-show">
                                                {{ $conta->user->name }}
                                            </div>
                                        </div>
                                        <div class="nome">
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Numero da Conta</h6>
                                            <div class="texto-show">
                                                {{ $conta->numero }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row bloco-div-show desk">
                                        <div class="nome">
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Saldo atual</h6>
                                            <div class="texto-show">
                                                {{ $conta->saldo }}
                                            </div>
                                        </div>
                                        <div class="nome">
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Status da conta</h6>
                                            <div class="texto-show">
                                                @if($conta->active == 's')
                                                    {{ __('Ativa') }}
                                                @else
                                                    <strong>{{ __('Inativa') }}</strong> <span class="font-small ft-italic"> (para ativar a conta você precisa efetuar o primeiro depósito)</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="btn-horizont">
                                            <div>
                                                <p><a href="{{route('logado.users.gerar-dep', ['conta' => $conta->id])}}" class="btn btn-success btn-conta">Depositar</a></p>
                                            </div>
                                            <div>
                                                <p><a href="{{route('logado.users.extrato', ['conta' => $conta->id])}}" class="btn btn-primary btn-conta">Extrato</a></p>
                                            </div>
                                            <div>
                                                <p><a href="{{route('logado.users.gerar-saq', ['conta' => $conta->id])}}" class="btn btn-danger btn-conta">Sacar</a></p>
                                            </div>
                                            <div>
                                                <p><a href="{{route('logado.users.show', ['user' => Auth::user()->id])}}" class="btn btn-warning btn-conta">Voltar</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="extr">
                                        <div class="col-12 mb-4">
                                            <h4 class="extr-title">Extrato</h4>
                                            <hr class="extr-linh"/>
                                        </div>
                                        <div class="col-12 mb-4">
                                            <div class="extr">
                                                <h4 class="extr-title">Selecionar período</h4>
                                                <x-validation-errors class="mb-4"/>
                                                <form action="{{route('logado.users.extrato', ['conta' => $conta->id])}}" method="get">
                                                    @csrf
                                                    <div class="form-row">
                                                    <p class="mt-4">Data ini: <x-input type="text" class="calendario my-field" name="data_ini" :value="old('data_ini')" /></p>
                                                    <p class="mt-4 ml-2">Data fim: <x-input type="text" class="calendario my-field" name="data_fim" :value="old('data_fim')" /></p>
                                                    <div class="buton-search ml-2">
                                                        <button type="submit" class="btn btn-salvar mt-4">Carregar</button>
                                                    </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="extr">
                                        <div class="row">
                                            <h4>Periodo</h4>
                                            <livewire:table :config="App\Tables\ExtratoAdmTable::class" :configParams="['contaId' => $conta->id ]"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $( ".calendario" ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
            dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
            dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
            monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
        });
    });
</script>
@endsection

