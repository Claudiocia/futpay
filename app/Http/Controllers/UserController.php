<?php

namespace App\Http\Controllers;

use App\Forms\UserForm;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $users = User::with(['plataformas', 'rachaos', 'jogos', 'conta', 'campeonatos'])->paginate();
        $slot = null;
        return view('admin.users.index', compact('users', 'slot'));
    }

    public function admin()
    {
        return view('admin.dashboard-admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $form = \FormBuilder::create(UserForm::class, [
            'url' => route('admin.users.store'),
            'method' => 'POST'
        ]);

        return \view('admin.users.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        \Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required'],
            'dt_nasc' => ['required', 'idade'],
            'cpf' => ['required', 'numeric', 'cpf', 'digits:11', 'unique:users'],
            'phone' => ['required', 'numeric', 'digits:11', 'unique:users'],
            'nick_game' => ['required', 'string', 'max:255', 'unique:users'],
            'plataforma' => $data['role'] == 1 ? [''] : ['required'],
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
            'name' =>  $data['name'],
            'email' =>  $data['email'],
            'nick_game' => $data['nick_game'],
            'dt_nasc' =>  $data['dt_nasc'],
            'phone' =>  $data['phone'],
            'cpf' =>  $data['cpf'],
            'role' => $data['role'],
            'password' => Hash::make('secret'),
        ]);

        $user->plataformas()->attach($data['plataforma']);

        $request->session()->flash('msg', 'Usuário Criado com sucesso');
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return View
     */
    public function show(User $user)
    {
        return \view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return View
     */
    public function edit(User $user)
    {
        $form = \FormBuilder::create(UserForm::class, [
            'url' => route('admin.users.update', ['user' => $user->id]),
            'method' => 'PUT',
            'model' => $user,
            'key' => 'model'
        ]);

        return \view('admin.users.edit', compact('form', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();
        \Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required'],
            'dt_nasc' => ['required', 'idade'],
            'cpf' => ['required', 'numeric', 'cpf', 'digits:11', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'numeric', 'digits:11', Rule::unique('users')->ignore($user->id)],
            'nick_game' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'plataforma' => $data['role'] == 1 ? [''] : ['required'],
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

        if (key_exists('plataforma', $data)){
            $user->plataformas()->sync($data['plataforma']);
        }else{
            $user->plataformas()->detach();
        }
        $user->fill($data);
        $user->save();

        $request->session()->flash('msg', 'Registro atualizado');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  User $user
     * @return RedirectResponse
     */
    public function destroy(Request  $request, User $user)
    {
        $user->plataformas()->detach();
        $user->delete();

        $request->session()->flash('msg', 'Registro deletado');
        return redirect()->route('admin.users.index');
    }
}
