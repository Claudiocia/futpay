@php use App\Models\Game;
 use App\Models\Plataforma; @endphp
<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo/>
        </x-slot>

        <x-validation-errors class="mb-4"/>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}"/>
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                         autofocus autocomplete="name"/>
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}"/>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                         autocomplete="username"/>
            </div>

            <div class="mt-4">
                <x-label for="dt_nasc" value="{{ __('Data Nascimento') }}"/>
                <x-input id="dt_nasc" class="block mt-1 w-full" type="date" name="dt_nasc" :value="old('dt_nasc')"
                         required autocomplete="dt_nasc"/>
            </div>

            <div class="mt-4">
                <x-label for="cpf" value="{{ __('CPF') }}"/>
                <x-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf')" required
                         autocomplete="cpf"/>
            </div>

            <div class="mt-4">
                <x-label for="phone" value="{{ __('Phone') }}"/>
                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required
                         autocomplete="phone"/>
            </div>

            <div class="mt-4">
                <x-label for="nick_game" value="{{ __('Game ID') }}"/>
                <x-input id="nick_game" class="block mt-1 w-full" type="text" name="nick_game" :value="old('nick_game')"
                         required autocomplete="nick_game"/>
            </div>

            <div class="mt-4">
                <x-label for="plataforma">
                    <x-label for="plataforma" value="{{ __('Plataforma de Jogo') }}"/>
                    <div class="flex items-center">
                        <?php $plataformas = Plataforma::all(); ?>
                        @foreach($plataformas as $plata)
                            <x-checkbox name="plataforma[]" id="plataforma" value="{{$plata->id}}" class="ml-3"/>
                            <div class="ml-2">
                                {!!   $plata->name !!}
                            </div>
                        @endforeach
                    </div>
                </x-label>
            </div>

            <div class="mt-4">
                <x-label for="game">
                    <x-label for="game" value="{{ __('Games') }}"/>
                    <div class="flex items-center">
                        <?php $games = Game::all(); ?>
                        @foreach($games as $game)
                            <x-checkbox name="game[]" id="game" value="{{$game->id}}" class="ml-3"/>
                            <div class="ml-2">
                                {!!   $game->sigla !!}
                            </div>
                        @endforeach
                    </div>
                </x-label>
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}"/>
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                         autocomplete="new-password"/>
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}"/>
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                         name="password_confirmation" required autocomplete="new-password"/>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                   href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
