@extends('layouts.app')

@section('conteudo')
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <div id="admin-content">
            <div class="container-admin">
                <div class="row">
                    <div class="col-md-12">
                        <div class="w-auto p-3">
                            <div class="panel-heading-admin">
                                <h5 class="mb-3">Operação Saque</h5>
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
                                                <h6 class="block font-medium text-sm text-gray-700 label-show">Saldo Total</h6>
                                                <div class="texto-show">
                                                    {{ $conta->saldo }}
                                                </div>
                                            </div>
                                            <div class="nome">
                                                <h6 class="block font-medium text-sm text-gray-700 label-show">Saldo Bloqueado</h6>
                                                <div class="texto-show">
                                                    {{ $conta->bloqueado }}
                                                </div>
                                            </div>
                                            <div class="nome">
                                                <h6 class="block font-medium text-sm text-gray-700 label-show">Saldo disponível</h6>
                                                <div class="texto-show">
                                                    {{ $conta->disponivel }}
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
                                            <div class="form-admin">
                                                <div class="row d-flex text-center">
                                                    <h3 class="title">Confirmar Dados do Saque</h3>
                                                </div>
                                                <div class="row d-flex text-center">
                                                    <h4 class="required">Regras Para Saque</h4>
                                                    <li class="required">Valor: mínimo R$ 10,00 - Máximo R$ 500,00</li>
                                                    <li class="required">Taxa operacional: {{$taxa->tipo == 1 ? 'R$ '.str_replace('.', ',', $taxa->valor) : str_replace('.', ',', $taxa->valor).'% '}} por saque</li>
                                                    <li class="required">A TAXA OPERACIONAL, será descontada do valor do valor total do saque</li>
                                                    <li class="required">O crédito só pode ser realizado em conta da mesma titularidade e CPF</li>
                                                    <li class="required">Prazo de crédito na sua conta é de até 36hs a contar do primeiro dia útil</li>
                                                </div>
                                                <?php $icon = '<i class="fas fa-save"></i>'; ?>
                                                {!!
                                                    form($form->add('salvar', 'submit', [
                                                        'attr' => ['class' => 'btn btn-salvar', 'style' => 'width:120px'],
                                                        'label' => $icon.' Confirmar'
                                                        ]))
                                                 !!}

                                            </div>
                                            <div class="row btn-new-reset">
                                                <div class="btn-hero">
                                                    <p><a href="{{route('logado.users.show', ['user' => Auth::user()->id])}}" class="btn btn-primary btn-salvar">Voltar</a></p>
                                                </div>
                                            </div>
                                            <hr/>
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
@endsection
