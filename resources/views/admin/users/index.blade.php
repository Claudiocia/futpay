@extends('layouts.admin')
@section('header')
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuários') }}
        </h2>
    </div>
@endsection

@section('conteudo')
<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div id="admin-content">
        <div class="container-admin">
            <div class="row">
                <div class="col-md-12">
                    <div class="w-auto p-3">
                        <div class="panel-heading-admin">
                            <h5>Lista de usuários</h5>
                        </div>
                        <div class="panel-body">
                            <div class="row btn-new-reset">
                                <div class="btn-hero">
                                    <p><a href="{{route('admin.users.create')}}" class="btn btn-primary btn-assinar">Novo</a></p>
                                    <p><a href="{{route('admin.users.index')}}" class="btn btn-success btn-assinar">Limpar</a></p>
                                </div>
                            </div>
                            <div class="row" style="margin-left: 10px; margin-right: 10px;">
                                <livewire:table :config="App\Tables\UsersTable::class"/>
                            </div>
                        </div>
                        </div>
                    {{ $users->links() }}

                </div>
            </div>
        </div>


    </div>
</div>
@endsection
