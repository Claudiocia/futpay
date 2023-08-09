<?php

namespace App\Http\Controllers;

use App\Forms\MovimentoForm;
use App\Forms\PlataformaFormEdit;
use App\Forms\UserForm;
use App\Mail\EmailDep;
use App\Models\Conta;
use App\Models\Movimento;
use App\Models\User;
use App\Utils\GerarConta;
use Carbon\Carbon;
use Faker\Core\DateTime;
use FormBuilder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use NumberFormatter;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

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
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * O método show é acionado
     * ao clica o menu saldo
     * no painel do usuário logado
     *
     * @param  User $user
     * @return View
     */
    public function show(User $user)
    {
        $conta = Conta::whereUserId($user->id)->first();
        if ($conta == null){
            $gerar = new GerarConta();
            $numero = $gerar->gerarNumeroComVerificador();
            $conta = Conta::create([
                'numero' => $numero,
                'user_id' => $user->id,
            ]);
        }
        return \view('logado.users.show', compact('user', 'conta'));
    }

    /**
     * O método gerarDeposito apenas
     * leva o usuario para o formulario
     * de depósito
     *
     * @param Conta $conta
     * @return View
     */
    public function gerarDeposito(Conta $conta)
    {
        $form = FormBuilder::create(MovimentoForm::class, [
            'url' => route('logado.users.depositar', ['conta' => $conta->id]),
            'method' => 'PUT',
            'model' => $conta,
            'tipo' => 'credito',
        ]);
        return \view('logado.users.gerar-dep', compact('conta', 'form'));
    }

    /**
     * O método depositar é acionado
     * quando o usuario vai creditar
     * recursos na conta dele
     *
     * @param  Conta $conta
     * @param Request $request
     * @return RedirectResponse
     */
    public function depositar(Request  $request, Conta $conta)
    {
        $data = $request->all();
        Validator::make($data, [
            'valor' => ['required' , 'valor'],
        ], [
            'valor.valor' => 'Valor fora da faixa padrão',
        ])->validate();

        $dataObj = new \DateTime($data['data']);
        $timestamp = $dataObj->getTimestamp();
        $dataOrig = $dataObj->format('Y-m-d H:i:s');

        $data['data_unix'] = $timestamp;

        $data['operation_key'] = 'h'.$timestamp.'t-'.md5($data['tipo']).'c-'.$conta->numero.'-p'.$conta->user->id.'y-'.rand(1001,9999);


        switch ($data['meiopag']){
            case '1':
                $data['meio_pag'] = 'PIX';
                //dispara a integração ApiPix
            break;
            case '2':
                $data['meio_pag'] = 'PagSeguro';
                //dispara a integração Pagseguro
                break;
            case '3':
                $data['meio_pag'] = 'PAYPAL';
                //dispara a integração PayPal
                break;
        }

        $format = numfmt_create('pt_BR', NumberFormatter::DECIMAL);
        $int = numfmt_parse($format, $data['valor']);
        $bloqueado = $conta->bloqueado + $int;
        $saldo = $bloqueado + $conta->disponivel;


        $user = User::whereId($conta->user->id)->first();

        Movimento::create([
            'description' => $data['description'],
            'tipo' => $data['tipo'],
            'valor' => $int,
            'data' => $data['data'],
            'data_unix' => $data['data_unix'],
            'conta_id' => $data['conta_id'],
            'operation_key' => $data['operation_key'],
            'status' => "Bloqueado",
            'motiv_status' => 'aguardando confirmação',
            'meio_pag' => $data['meio_pag'],
        ]);

        $conta->fill([
            'bloqueado' => $bloqueado,
            'saldo' => $saldo,
            'active' => 's',
        ]);
        $conta->save();

        $email = $user->email;
        $emailAdm = 'admfutpay@futpay.com.br';
        $subject = 'Depósito em conta';
        $mensagemCli = "<br/>";
        $mensagemCli .= "Acabamos de receber o seu depósito. Estamos em processo de confirmação.";
        $mensagemCli .= "<br/><br/>";
        $mensagemCli .= "Tão logo seja confirmado o crédito via ".$data['meio_pag']." vamos liberar o saldo para uso e lhe notificar.";
        $mensagemCli .= "<br/>";
        $mensagemCli .= "Qualquer dúvida pode entrar em contato via formulário que você acessa através do link no botão abaixo.";
        $mensagemCli .= "<br/>";
        $mensagemCli .= "Não responda a este e-mail, pois esta é uma mensagem automática.";
        $mensagemCli .= "<br/><br/>";
        $mensagemCli .= "<strong>Dados da transação:</strong>";
        $mensagemCli .= "<br/><br/>";
        $mensagemCli .= "<strong>Valor:</strong> ".$data['valor'];
        $mensagemCli .= "<br/>";
        $mensagemCli .= "<strong>Data:</strong> ".$data['data'];
        $mensagemCli .= "<br/>";
        $mensagemCli .= "<strong>Meio Pag:</strong> ".$data['meio_pag'];
        $mensagemCli .= "<br/>";
        $mensagemCli .= "<strong>Chave:</strong>";
        $mensagemCli .= "<br/>";
        $mensagemCli .= $data['operation_key'];
        $mensagemCli .= "<br/><br/>";
        $mensagemCli .= "Obrigado por usar a plataforma FutPay";
        $mailData = [
            'mensagem' => $mensagemCli,
            'url' => '#',
            'title-button' => 'Falar com a FutPay',
            'title' => 'Olá '.$user->nick_game,
            'sub-title' => 'Depósito em conta',
            'date' => now(),
            'email' => env('MAIL_FROM_ADDRESS'),
        ];

        $mensagemAdm = "<br/>";
        $mensagemAdm .= "O usuário ".$user->name." acabou de fazer um depósito na conta dele.";
        $mensagemAdm .= "<br/>";
        $mensagemAdm .= "CPF do usuário: ".$user->cpf;
        $mensagemAdm .= "<br/>";
        $mensagemAdm .= "Verifique os dados abaixo se conferem com crédito na conta FutPay.";
        $mensagemAdm .= "<br/><br/>";
        $mensagemAdm .= "<strong>Dados da transação:</strong>";
        $mensagemAdm .= "<br/><br/>";
        $mensagemAdm .= "<strong>Valor:</strong> ".$data['valor'];
        $mensagemAdm .= "<br/>";
        $mensagemAdm .= "<strong>Data:</strong> ".$data['data'];
        $mensagemAdm .= "<br/>";
        $mensagemAdm .= "<strong>Meio Pag:</strong> ".$data['meio_pag'];
        $mensagemAdm .= "<br/>";
        $mensagemAdm .= "<strong>Chave:</strong>";
        $mensagemAdm .= "<br/>";
        $mensagemAdm .= $data['operation_key'];
        $mensagemAdm .= "<br/>";
        $mensagemAdm .= "Caso os dados informados sejam confirmados favor liberar o saldo no sistema";
        $mensagemAdm .= "<br/>";
        $mensagemAdm .= "Para acessar o sistema use o link do botão abaixo";
        $mensagemAdm .= "<br/><br/>";
        $mailDataAdm = [
            'mensagem' => $mensagemAdm,
            'url' => route('login'),
            'title-button' => 'Acessar sistema',
            'title' => 'Olá Administrador',
            'sub-title' => 'Depósito em conta',
            'date' => now(),
            'email' => env('MAIL_FROM_ADDRESS'),
        ];

        Mail::to($email)->send(new EmailDep($mailData, $subject));
        Mail::to($emailAdm)->send(new EmailDep($mailDataAdm, $subject));
        if (ResponseAlias::HTTP_OK){
            $msg = 'Depósito realizado com sucesso. Enviamos um E-mail com os dados!';
            $request->session()->flash('msg', $msg);
        }else{
            $error = 'Ops! Tivemos problema. Verifique a sua conta, caso o valor tenha sido transferido passe um email pelo formulário de contato.';
            $request->session()->flash('error', $error);
        }

        $request->session()->flash('msg', '');
        return redirect()->route('logado.users.show', compact('user', 'conta'));
    }

    /**
     * O método gerarSaque apenas
     * leva o usuario para o formulario
     * de saque
     *
     * @param Conta $conta
     * @return View
     */
    public function gerarSaque(Conta $conta)
    {
        $form = FormBuilder::create(MovimentoForm::class, [
            'url' => route('logado.users.sacar', ['conta' => $conta->id]),
            'method' => 'PUT',
            'model' => $conta,
            'tipo' => 'debito',
        ]);
        return \view('logado.users.gerar-saq', compact('conta', 'form'));
    }

    /**
     * O método sacar é acionado
     * quando o usuario vai debitar
     * recursos na conta dele
     *
     * @param  Conta $conta
     * @param Request $request
     * @return RedirectResponse
     */
    public function sacar(Request  $request, Conta $conta)
    {
        $data = $request->all();
        Validator::make($data, [
            'valor' => ['required' , 'valor', 'saldo:'.$conta->id ],
        ], [
            'valor.valor' => 'Valor fora da faixa padrão',
            'valor.saldo' => 'Saldo disponivel insuficiente na conta',
        ])->validate();

        $dataObj = new \DateTime($data['data']);
        $timestamp = $dataObj->getTimestamp();
        $data['data_unix'] = $timestamp;
        $data['operation_key'] = 'h'.$timestamp.'t-'.md5($data['tipo']).'c-'.$conta->numero.'-p'.$conta->user->id.'y-'.rand(1001,9999);
        $format = numfmt_create('pt_BR', NumberFormatter::DECIMAL);
        $int = numfmt_parse($format, $data['valor']);
        $saldo = $conta->saldo - $int;
        $user = User::whereId($conta->user->id)->first();

        Movimento::create([
            'description' => $data['description'],
            'tipo' => $data['tipo'],
            'valor' => $int,
            'data' => $data['data'],
            'data_unix' => $data['data_unix'],
            'conta_id' => $data['conta_id'],
            'operation_key' => $data['operation_key'],
            'status' => "Em operação",
            'motiv_status' => 'aguardando confirmação',
            'meio_pag' => 1,
        ]);

        $conta->fill([
            'saldo' => $saldo,
            'active' => 's'
        ]);
        $conta->save();

        $request->session()->flash('msg', 'Saque iniciado com sucesso');
        return redirect()->route('logado.users.show', compact('user', 'conta'));
    }

    /**
     * O método extrato é acionado
     * quando o usuario vai listar
     * os movimentos na conta dele
     *
     * @param  Conta $conta
     * @return View
     */
    public function extrato(Conta $conta, Request $request)
    {
        $data = $request->all();
        //dd($data);
        $today = Carbon::now();
        if ($data == null){
            $startDate = $today->subDays(7);
            $movimentos = Movimento::whereContaId($conta->id)
                ->where('data', '>=', $startDate)
                ->orderBy('data', 'DESC')->get();
            $periodo = "Extrato dos últimos 7 dias";
            return \view('logado.users.extrato', compact('movimentos', 'conta', 'periodo'));
        }elseif ($data['data_fim'] != null && $data['data_ini'] == null){
            \Validator::make($data, [
                'data_ini' => ['required']
            ], [
                'data_ini.required' => 'O campo Data Inicial precisa ser informado',
            ])->validate();
        }elseif ($data['data_fim'] == null && $data['data_ini'] != null){
            \Validator::make($data, [
                'data_fim' => ['required']
            ], [
                'data_fim.required' => 'O campo Data Final precisa ser informado',
            ])->validate();
        }elseif ($data['data_fim'] != null && $data['data_ini'] != null){
            dd($data);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Movimento $movimento
     * @return View
     */
    public function extratoDetail(Movimento $movimento)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return View
     */
    public function edit(User $user)
    {
        $form = FormBuilder::create(PlataformaFormEdit::class, [
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
     * @param Request $request
     * @param  User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();
        \Validator::make($data, [
            'plataforma' => ['required'],
            'game' => ['required']
        ], [
            'plataforma.required' => 'Você precisa escolher pelo menos 1 plataforma de jogo',
            'game.required' => 'Você precisa escolher pelo menos 1 game para seu perfil',
        ])->validate();

        if (key_exists('plataforma', $data)){
            $user->plataformas()->sync($data['plataforma']);
        }else{
            $user->plataformas()->detach();
        }

        if (key_exists('game', $data)){
            $user->games()->sync($data['game']);
        }else{
            $user->games()->detach();
        }

        $request->session()->flash('msg', 'Registro atualizado');
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
