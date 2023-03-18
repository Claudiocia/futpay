@extends('layouts.admin')

@section('conteudo')
<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div id="admin-content">
        <div class="container-admin">
            <div class="row">
                <div class="col-md-12">
                    <div class="w-auto p-3">
                        <div class="panel-heading-admin">
                            <h5>Conta do usuário {{ $conta->user->name }}</h5>
                        </div>
                        <div class="panel-body">
                            <div class="row btn-new-reset">
                                <p><a href="{{route('admin.contas.edit', ['conta' => $conta->id])}}" class="btn btn-primary btn-assinar">Editar</a></p>
                                <p><a href="{{route('admin.contas.index')}}" class="btn btn-success btn-assinar">Voltar</a></p>
                                <button type="button" class="btn btn-danger btn-deletar" style="margin-left: 23px" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Deletar
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><span class="aviso">Confirme sua ação</span></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <span class="aviso">Você tem certeza que deseja deletar o registro?</span>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-cancelar" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-danger btn-deletar" onclick="event.preventDefault();document.getElementById('form-delete').submit();">Deletar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $formDelete = FormBuilder::plain([
                                    'id' => 'form-delete',
                                    'route' => ['admin.contas.destroy', 'conta' => $conta->id],
                                    'method' => 'DELETE',
                                    'style' => 'display:none',
                                ]); ?>
                                {!! form($formDelete) !!}
                            </div>
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
                                    <hr/>
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
                                                    {{ __('Inativa') }}
                                                @endif
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
</div>
@endsection
