<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'dt_nasc' => ['required', 'idade'],
            'cpf' => ['required', 'numeric', 'cpf', 'digits:11', 'unique:users'],
            'phone' => ['required', 'numeric', 'digits:11', 'unique:users'],
            'nick_game' => ['required', 'string', 'max:255', 'unique:users'],
            'plataforma' => ['required'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ], [
            'email.email' => 'Informe um email válido.',
            'cpf.required' => 'O campo CPF é obrigatório',
            'cpf.numeric' => 'O campo CPF deve ser apenas numeros, sem pontos ou traços',
            'cpf.cpf' => 'O CPF informado não é válido',
            'cpf.digits' => 'O CPF é composto por 11 digitos incluindo o verificador',
            'cpf.unique' => 'Este CPF já está cadastrado em nosso sistema',
            'dt_nasc.idade' => 'Para se registrar você precisa ter acima de 18 anos completo',
            'plataforma.required' => 'Você precisa esclher pelo menos 1 plataforma de jogo',
            'nick_game.unique' => 'Esse nickname já está em uso por outro jogador',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'nick_game' => $input['nick_game'],
            'dt_nasc' =>  $input['dt_nasc'],
            'phone' => $input['phone'],
            'cpf' => $input['cpf'],
            'role' => User::ROLE_PLAYER,
            'password' => Hash::make($input['password']),
        ]);
        $user->plataformas()->attach($input['plataforma']);

        return $user;
    }
}
