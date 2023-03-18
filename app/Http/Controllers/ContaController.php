<?php

namespace App\Http\Controllers;

use App\Forms\ContaForm;
use App\Models\Conta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $contas = Conta::with('user', 'movimentos')->paginate();
        $slot = null;
        return view('admin.contas.index', compact('contas', 'slot'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $form = \FormBuilder::create(ContaForm::class, [
            'url' => route('admin.contas.store'),
            'method' => 'POST',
        ]);

        return \view('admin.contas.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        \Validator::make($data, [
            'numero' => ['required', 'unique:contas'],
            'user_id' => ['required', 'unique:contas'],
    ])->validate();

        Conta::create($data);

        $request->session()->flash('msg', 'Conta criada com sucesso');
        return redirect()->route('admin.contas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Conta $conta
     * @return View
     */
    public function show(Conta $conta)
    {
        return \view('admin.contas.show', compact('conta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Conta $conta
     * @return View
     */
    public function edit(Conta $conta)
    {
        $form = \FormBuilder::create(ContaForm::class, [
            'url' => route('admin.contas.update', ['conta' => $conta->id]),
            'method' => 'PUT',
            'model' => $conta,
        ]);

        return \view('admin.contas.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Conta $conta
     * @return RedirectResponse
     */
    public function update(Request $request, Conta $conta)
    {
        $data = $request->all();
        $conta->fill($data);
        $conta->save();

        $request->session()->flash('msg', 'Registro atualizado');
        return redirect()->route('admin.contas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Conta $conta
     * @return RedirectResponse
     */
    public function destroy(Request  $request, Conta $conta)
    {
        //
    }
}
