@extends('layouts.app')

@section('conteudo')
<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div id="admin-content">
        <div class="container-admin">
            <div class="row">
                <div class="col-md-12">
                    <div class="w-auto p-3">
                        <div class="panel-heading-admin">
                            <h5 class="mb-3">Conta de {{ $conta->user->name }}</h5>
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
                                        <div class="nome inline-flex">
                                            <div class="saldo">
                                                <h6 class="block font-medium text-sm text-gray-700 label-show">Saldo total</h6>
                                                <div class="texto-show">
                                                    <?php $timezon = Config::get('app.timezone'); ?>
                                                    @if(Config::get('app.timezone') != "America/Sao_Paulo")
                                                        US$ {{ $conta->saldo }}
                                                    @else
                                                        R$ {{number_format($conta->saldo, 2, ",", ".")}}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="saldo">
                                                <h6 class="block font-medium text-sm text-gray-700 label-show">Bloqueado</h6>
                                                <div class="texto-show">
                                                    <?php $timezon = Config::get('app.timezone'); ?>
                                                    @if(Config::get('app.timezone') != "America/Sao_Paulo")
                                                        US$ {{ $conta->bloqueado }}
                                                    @else
                                                        R$ {{number_format($conta->bloqueado, 2, ",", ".")}}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="saldo">
                                                <h6 class="block font-medium text-sm text-gray-700 label-show">Disponível</h6>
                                                <div class="texto-show">
                                                    <?php $timezon = Config::get('app.timezone'); ?>
                                                    @if(Config::get('app.timezone') != "America/Sao_Paulo")
                                                        US$ {{ $conta->disponivel }}
                                                    @else
                                                        R$ {{number_format($conta->disponivel, 2, ",", ".")}}
                                                    @endif
                                                </div>
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
                                                <p><a href="{{route('dashboard')}}" class="btn btn-warning btn-conta">Voltar</a></p>
                                            </div>
                                        </div>
                                        <hr/>
                                    </div>
                                </div>
                                <div class="row btn-new-reset">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
