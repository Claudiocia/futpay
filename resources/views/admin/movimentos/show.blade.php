@extends('layouts.admin')

@section('conteudo')
<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div id="admin-content">
        <div class="container-admin">
            <div class="row">
                <div class="col-md-12">
                    <div class="w-auto p-3">
                        <div class="panel-heading-admin">
                            <h5 class="mb-3">Confirmar movimentação na conta de {{ $conta->user->name }}</h5>
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
                                                    <strong>{{ __('Inativa') }}</strong> <span class="font-small ft-italic"> (Ainda nào foi feito nenhum depósito nesta conta)</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="btn-horizont">
                                            <h5>DESCRIÇÃO DA MOVIMENTAÇÃO</h5>
                                        </div>
                                        <div class="btn-horizont">
                                            <div class="form-admin">
                                                <?php $icon = '<i class="fas fa-save"></i>'; ?>
                                                {!!
                                                    form($form->add('salvar', 'submit', [
                                                        'attr' => ['class' => 'btn btn-salvar', 'style' => 'width:120px'],
                                                        'label' => $icon.' Registrar'
                                                        ]))
                                                 !!}
                                            </div>
                                        </div>
                                        <div class="btn-horizont">
                                            <div>
                                                <p><a href="{{route('admin.contas.confirm', ['conta' => $conta->id])}}" class="btn btn-warning btn-conta">Cancelar</a></p>
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
