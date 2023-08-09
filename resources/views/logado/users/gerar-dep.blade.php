@extends('layouts.app')

@section('conteudo')
<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div id="admin-content">
        <div class="container-admin">
            <div class="row">
                <div class="col-md-12">
                    <div class="w-auto p-3">
                        <div class="panel-heading-admin">
                            <h5 class="mb-3">Realizar Depósito</h5>
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
                                        <div class="form-admin">
                                            <div class="row d-flex text-center">
                                                <h3 class="title">Adicionar crédito</h3>
                                            </div>
                                            <?php $icon = '<i class="fas fa-save"></i>'; ?>
                                            {!!
                                                form($form->add('meiopag', 'choice', [
                                                    'label' => 'Meios de pagamento',
                                                    'label_attr' => ['class' => 'label-form required'],
                                                    'choices' => ['1' => 'Pix', '2' => 'PagSeguro(boletos e cartões)', '3' => 'PayPal(pagamentos internacionais)'],
                                                    'choice_options' => [
                                                        'wrapper' => ['class' =>  'choice-wrapper'],
                                                        'label_attr' => ['class' => 'label-class'],
                                                        ],
                                                        'selected' => 1,
                                                        'multiple' => false,
                                                        'expanded' => true,
                                                        ])->add('salvar', 'submit', [
                                                            'attr' => ['class' => 'btn btn-salvar', 'style' => 'width:120px'],
                                                            'label' => $icon.' Depositar'
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
