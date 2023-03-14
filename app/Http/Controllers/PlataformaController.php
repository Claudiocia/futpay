<?php

namespace App\Http\Controllers;

use App\Forms\PlataformaForm;
use App\Models\Plataforma;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PlataformaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $plataformas = Plataforma::with('users')->paginate();
        $slot = null;
        return view('admin.plataformas.index', compact('plataformas', 'slot'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $form = \FormBuilder::create(PlataformaForm::class, [
            'url' => route('admin.plataformas.store'),
            'method' => 'POST'
        ]);

        return \view('admin.plataformas.create', compact('form'));
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
            'name' => ['required', 'string', 'max:255', 'unique:plataformas'],
            'sigla' => ['required', 'string', 'max:25', 'unique:plataformas'],
        ],
        [
            'name.unique' => 'Já existe uma plataforma de jogo com este nome!',
            'sigla.unique' => 'Já existe uma plataforma de jogo com esta sigla.'
        ])->validate();

        Plataforma::create($data);

        $request->session()->flash('msg', 'Plataforma criada com sucesso');
        return redirect()->route('admin.plataformas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Plataforma $plataforma
     * @return View
     */
    public function show(Plataforma $plataforma)
    {
        return \view('admin.plataformas.show', compact('plataforma'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Plataforma $plataforma
     * @return View
     */
    public function edit(Plataforma $plataforma)
    {
        $form = \FormBuilder::create(PlataformaForm::class, [
            'url' => route('admin.plataformas.update', ['plataforma' => $plataforma->id]),
            'method' => 'PUT',
            'model' => $plataforma,
        ]);
        return \view('admin.plataformas.edit', compact('form', 'plataforma'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Plataforma $plataforma
     * @return RedirectResponse
     */
    public function update(Request $request, Plataforma $plataforma)
    {
        $data = $request->all();
        \Validator::make($data, [
            'name' => ['required', 'string', 'max:255', Rule::unique('plataformas')->ignore($plataforma->id)],
            'sigla' => ['required', 'string', 'max:25', Rule::unique('plataformas')->ignore($plataforma->id)],
        ],
            [
                'name.unique' => 'Já existe uma plataforma de jogo com este nome!',
                'sigla.unique' => 'Já existe uma plataforma de jogo com esta sigla.'
            ])->validate();
        $plataforma->fill($data);
        $plataforma->save();

        $request->session()->flash('msg', 'Registro atualizado');
        return redirect()->route('admin.plataformas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Plataforma $plataforma
     * @return RedirectResponse
     */
    public function destroy(Request $request, Plataforma $plataforma)
    {
        $plataforma->users()->detach();
        $plataforma->delete();

        $request->session()->flash('msg', 'Registro deletado');
        return redirect()->route('admin.plataformas.index');
    }
}
