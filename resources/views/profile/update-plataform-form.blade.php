<div>
    <x-slot name="title">
        {{ __('Atualizar Plataformas de jogo') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Atualize as plataformas que voce joga') }}
    </x-slot>

    <x-slot name="form">
        <div wire:ignore>
        <form method="POST" action="{{route('logado.users.update', ['user' => Auth::user()->id])}}">
            @csrf
            @method('PUT')

            <div class="col-span-6 sm:col-span-4">
                <x-label for="plataforma">
                    <x-label for="plataforma" value="{{ __('Plataforma de Jogo') }}" />
                    <div class="flex items-center">
                        <?php $plataformas = \App\Models\Plataforma::all(); ?>
                        @foreach($plataformas as $plata)
                            <x-checkbox name="plataforma[]" id="plataforma" value="{{$plata->id}}" class="ml-3"/>
                            <div class="ml-2">
                                {!!   $plata->sigla !!}
                            </div>
                        @endforeach
                    </div>
                </x-label>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-button class="ml-4">
                    {{ __('Salvar') }}
                </x-button>
            </div>
        </form>
        </div>
    </x-slot>
</div>
