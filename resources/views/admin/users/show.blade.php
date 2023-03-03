@extends('layouts.admin')

@section('conteudo')
<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div id="admin-content">
        <div class="container-admin">
            <div class="row">
                <div class="col-md-12">
                    <div class="w-auto p-3">
                        <div class="panel-heading-admin">
                            <h5>Perfil do usuário {{ $user->name }}</h5>
                        </div>
                        <div class="panel-body">
                            <div class="row btn-new-reset">
                                <p><a href="{{route('admin.users.edit', ['user' => $user->id])}}" class="btn btn-primary btn-assinar">Editar</a></p>
                                <p><a href="{{route('admin.users.index')}}" class="btn btn-success btn-assinar">Voltar</a></p>
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
                                    'route' => ['admin.users.destroy', 'user' => $user->id],
                                    'method' => 'DELETE',
                                    'style' => 'display:none',
                                ]); ?>
                                {!! form($formDelete) !!}
                            </div>
                            <div class="row">
                                <div id="register-show">
                                    <div class="row bloco-div-show desk">
                                        <div class="nome">
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Nome Completo</h6>
                                            <div class="texto-show">
                                                {{ $user->name }}
                                            </div>
                                        </div>
                                        <div class="nome">
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Nickname</h6>
                                            <div class="texto-show">
                                                {{ $user->nick_game }}
                                            </div>
                                        </div>
                                        <div class="nome">
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">E-mail</h6>
                                            <div class="texto-show">
                                                {{ $user->email }}
                                            </div>
                                        </div>
                                        <div class="nome">
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">CPF</h6>
                                            <div class="texto-show">
                                                {{ $user->cpf }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row bloco-div-show desk-esq">
                                        <div class="nome dt-nasc">
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Data Nascimento</h6>
                                            <div class="texto-show">
                                                {{ \Carbon\Carbon::parse($user->dt_nasc)->format('d/m/Y')}}
                                            </div>
                                        </div>
                                        <div class="nome dt-nasc">
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Telefone</h6>
                                            <div class="texto-show">
                                                {{$user->phone}}
                                            </div>
                                        </div>
                                        <div class="nome dt-nasc">
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Plataforma</h6>
                                            <div class="texto-show">
                                                @if(count($user->plataformas) > 0)
                                                    @foreach($user->plataformas as $plataforma)
                                                        {{$plataforma->sigla}}
                                                    @endforeach
                                                @else
                                                    {{__('Sem plataforma de jogo')}}
                                                @endif
                                            </div>
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
@endsection
