@extends('layouts.admin')
@section('header')
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Painel de ADM') }}
        </h2>
    </div>
@endsection

@section('conteudo')
    <div class="py-12" style="margin-top: 80px">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome-admin />
            </div>
        </div>
    </div>
@endsection
