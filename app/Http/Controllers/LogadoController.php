<?php

namespace App\Http\Controllers;

use App\Forms\PlataformaFormEdit;
use App\Forms\UserForm;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class LogadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return View
     */
    public function edit(User $user)
    {
        $form = \FormBuilder::create(PlataformaFormEdit::class, [
            'url' => route('logado.users.update', ['user' => $user->id]),
            'method' => 'PUT',
            'model' => $user,
            'key' => 'model'
        ]);
        $slot = null;
        return \view('logado.users.edit', compact('form', 'user', 'slot'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();
        \Validator::make($data, [
            'plataforma' => ['required'],
        ], [
            'plataforma.required' => 'Você precisa escolher pelo menos 1 plataforma de jogo',
        ])->validate();

        if (key_exists('plataforma', $data)){
            $user->plataformas()->sync($data['plataforma']);
        }else{
            $user->plataformas()->detach();
        }
        $user->fill($data);
        $user->save();

        $request->session()->flash('msg', 'Registro atualizado');
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
