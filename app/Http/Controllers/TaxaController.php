<?php

namespace App\Http\Controllers;

use App\Forms\TaxaForm;
use App\Models\Taxa;
use App\Utils\DefaultFunctions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TaxaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $taxas = Taxa::paginate();
        return view('admin.taxas.index', compact('taxas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $form = \FormBuilder::create(TaxaForm::class, [
            'url' => route('admin.taxas.store'),
            'method' => 'POST'
        ]);

        return \view('admin.taxas.create', compact('form'));
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
            'operation' => ['required', 'string', 'unique:taxas'],
            'tipo' => ['required'],
            'valor' => ['required'],
        ], [
            'operation.unique' => 'Já existe uma taxa cadastrada para este tipo de operação. Se quiser alterar melhor é editá-la',
            'operation.required' => 'Precisa informar um tipo de operação',
            'tipo' => 'Selecione o tipo de taxa se é valor fixo ou percentual',
            'valor' => 'Precisa informar o valor da taxa',
        ])->validate();
        Taxa::create($data);
        $request->session()->flash('msg', 'Taxa criada com sucesso');
        return redirect()->route('admin.taxas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Taxa $taxa)
    {
        return \view('admin.taxas.show', compact('taxa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Taxa $taxa
     * @return View
     */
    public function edit(Taxa $taxa)
    {
        $form = \FormBuilder::create(TaxaForm::class, [
            'url' => route('admin.taxas.update', ['taxa' => $taxa->id]),
            'method' => 'PUT',
            'model' => $taxa,
        ]);
        return \view('admin.taxas.edit', compact('form', 'taxa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Taxa $taxa
     * @return RedirectResponse
     */
    public function update(Request $request, Taxa $taxa)
    {
        $data = $request->all();
        \Validator::make($data, [
            'operation' => ['required', 'string', Rule::unique('taxas')->ignore($taxa->id)],
            'tipo' => ['required'],
            'valor' => ['required'],
        ], [
            'operation.unique' => 'Já existe uma taxa cadastrada para este tipo de operação. Se quiser alterar melhor é editá-la',
            'operation.required' => 'Precisa informar um tipo de operação',
            'tipo' => 'Selecione o tipo de taxa se é valor fixo ou percentual',
            'valor' => 'Precisa informar o valor da taxa',
        ])->validate();
        $taxa->fill($data);
        $taxa->save();
        $request->session()->flash('msg', 'Registro atualizado');
        return redirect()->route('admin.taxas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Taxa $taxa
     * @return RedirectResponse
     */
    public function destroy(Request $request, Taxa $taxa)
    {
        $taxa->delete();
        $request->session()->flash('msg', 'Registro deletado');
        return redirect()->route('admin.taxas.index');
    }
}
