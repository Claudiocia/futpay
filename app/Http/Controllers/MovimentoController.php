<?php

namespace App\Http\Controllers;

use App\Forms\MovimentoAdmForm;
use App\Models\Conta;
use App\Models\Movimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MovimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function confirma(Movimento $movimento)
    {
        dd("Cheguei para confirmar o movimento ".$movimento);
    }

    public function recusa(Movimento $movimento)
    {
        dd("Cheguei para recusar o movimento");
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
     * @param  Movimento $movimento
     * @return View
     */
    public function show(Movimento $movimento)
    {
        //dd($movimento);
        $form = \FormBuilder::create(MovimentoAdmForm::class, [
            'url' => route('admin.movimentos.update', ['movimento' => $movimento->id]),
            'method' => 'PUT',
            'model' => $movimento,
        ]);
        $conta = Conta::whereId($movimento->conta->id)->first();
        return \view('admin.movimentos.show', compact('form', 'conta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Movimento $movimento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movimento $movimento)
    {
        $data = $request->all();
        //dd($data);
        \Validator::make($data, [
            'operacao' => ['required'],
            'autoriza' => ['autorAction:'.$movimento->id],
        ], [
            'operacao.required' => 'Você precisa escolher uma das opções. Se for para aguardar, clique no botão cancelar abaixo!',
            'autoriza.autor_action' => 'Você não pode confirmar uma operação em sua própria conta. Solicite que outro administrador confirme.',
        ])->validate();
        $conta = Conta::whereId($movimento->conta->id)->first();
        //operação 1 confirma 2 deleta
        if($movimento->status == 'Bloqueado' || 'Em operação'){
            if ($data['operacao'] == 1){
                $dataConta['bloqueado'] = $conta->bloqueado - $movimento->valor;
                $dataConta['disponivel'] = $conta->disponivel + $movimento->valor;
                $data['status'] = 'Confirmado';
                $data['motivo_status'] = 'Operação já confirmada';
                $movimento->fill($data);
                $movimento->save();
                $conta->fill($dataConta);
                $conta->save();
                $msg = 'Operação confirmada com sucesso';
            }else{
                $dataConta['bloqueado'] = $conta->bloqueado - $movimento->valor;
                $dataConta['saldo'] = $conta->saldo - $movimento->valor;
                $data['status'] = 'Cancelado';
                $data['motivo_status'] = 'Não foi possível confirmar essa operação';
                $movimento->fill($data);
                $movimento->save();
                $conta->fill($dataConta);
                $conta->save();
                $msg = 'Operação cancelada com sucesso';
            }
        }else{
            $msg = 'Essa movimentação já se encontra com status definido como '.$movimento->status;
        }

        $request->session()->flash('msg', $msg);
        return redirect()->route('admin.contas.confirm', compact('conta'));
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
