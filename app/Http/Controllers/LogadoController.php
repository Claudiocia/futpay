<?php

namespace App\Http\Controllers;

use App\Forms\MovimentoForm;
use App\Forms\PlataformaFormEdit;
use App\Forms\SaqueForm;
use App\Forms\UserForm;
use App\Mail\EmailDep;
use App\Models\Conta;
use App\Models\Movimento;
use App\Models\Taxa;
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
        //dd($data);
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
            return redirect()->route('logado.users.show', compact('user', 'conta'));
        }else{
            $error = 'Ops! Tivemos problema. Verifique a sua conta, caso o valor tenha sido transferido passe um email pelo formulário de contato.';
            $request->session()->flash('error', $error);
            return redirect()->route('logado.users.show', compact('user', 'conta'));
        }

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
        $taxa = Taxa::whereOperation('Saque')->first();
        $form = FormBuilder::create(MovimentoForm::class, [
            'url' => route('logado.users.confirma-saq', ['conta' => $conta->id]),
            'method' => 'GET',
            'model' => $conta,
            'tipo' => 'debito',
        ]);
        return \view('logado.users.gerar-saq', compact('conta', 'form', 'taxa'));
    }

    public function confirmaSaque(Request  $request, Conta $conta)
    {
        $data = $request->all();
        Validator::make($data, [
            'valor' => ['required' , 'valor', 'saldo:'.$conta->id ],
        ], [
            'valor.valor' => 'Valor fora da faixa padrão',
            'valor.saldo' => 'Saldo disponivel insuficiente na conta',
        ])->validate();
        $format = numfmt_create('pt_BR', NumberFormatter::DECIMAL);
        $vlrTotal = numfmt_parse($format, $data['valor']);
        $taxa = Taxa::whereOperation('Saque')->first();
        $taxaOp = $taxa->valor;
        $valueOp = number_format((float)$taxaOp, 2, '.', '');
        if ($taxa->tipo == 1){
            $vlrLiquido = $vlrTotal - $valueOp;
        }else{
            $valueOp = ($vlrTotal * $valueOp) / 100;
            $vlrLiquido = $vlrTotal - $valueOp;
        }
        $form = FormBuilder::create(SaqueForm::class, [
            'url' => route('logado.users.sacar', ['conta' => $conta->id]),
            'method' => 'PUT',
            'model' => $conta,
            'tipo' => 'debito',
            'opera' => $valueOp,
            'liqui' => $vlrLiquido,
            'total' => $vlrTotal,
        ]);
        return \view('logado.users.confirma-saq', compact('conta', 'taxa', 'form'));
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
        //dd($data);

        $dataObj = new \DateTime($data['data']);
        $timestamp = $dataObj->getTimestamp();
        $data['data_unix'] = $timestamp;
        $data['operation_key'] = 'h'.$timestamp.'t-'.md5($data['tipo']).'c-'.$conta->numero.'-p'.$conta->user->id.'y-'.rand(1001,9999);
        $format = numfmt_create('pt_BR', NumberFormatter::DECIMAL);
        $int = numfmt_parse($format, $data['valor']);
        $saldo = $conta->saldo - $int;
        $disponivel = $conta->disponivel - $int;
        $user = User::whereId($conta->user->id)->first();

        $contaAdm = Conta::whereId(1)->first();

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
            'disponivel' => $disponivel,
        ]);
        $conta->save();

        $data['operation_key_adm'] = 'h'.$timestamp.'t-'.md5('credito').'c-'.$contaAdm->numero.'-p'.$contaAdm->user->id.'y-'.rand(1001,9999);

        Movimento::create([
            'description' => 'Crédito ref. saque cliente',
            'tipo' => 'crédito',
            'valor' => $data['opera_vlr'],
            'data' => $data['data'],
            'data_unix' => $data['data_unix'],
            'conta_id' => $contaAdm->id,
            'operation_key' => $data['operation_key_adm'],
            'status' => "Em operação",
            'motiv_status' => 'aguardando confirmação',
            'meio_pag' => 1,
        ]);

        $contaAdm->fill([
            'saldo' => $contaAdm->saldo + $data['opera_vlr'],
            'disponivel' => $contaAdm->disponivel + $data['opera_vlr'],
        ]);
        $contaAdm->save();

        //email para o cliente
        $email = $user->email;
        $emailAdm = 'admfutpay@futpay.com.br';
        $subject = 'Saque em conta';
        $mensagemCli = "<br/>";
        $mensagemCli .= "Você acabou de realizar um saque em sua conta FutPay. Já iniciamos o processamento.";
        $mensagemCli .= "<br/><br/>";
        $mensagemCli .= "O crédito será efetuado em sua conta através de PIX. Acompanhe seu extrato que o crédito será efetivado em até 36 horas.";
        $mensagemCli .= "<br/>";
        $mensagemCli .= "Qualquer dúvida pode entrar em contato via formulário que você acessa através do link no botão abaixo.";
        $mensagemCli .= "<br/>";
        $mensagemCli .= "Não responda a este e-mail, pois esta é uma mensagem automática.";
        $mensagemCli .= "<br/><br/>";
        $mensagemCli .= "<strong>Dados da transação:</strong>";
        $mensagemCli .= "<br/><br/>";
        $mensagemCli .= "<strong>Valor Total:</strong> R$ ".number_format((float)$data['valor'], 2, ',', '.');
        $mensagemCli .= "<br/>";
        $mensagemCli .= "<strong>Taxa Adm:</strong> R$ ".number_format((float)$data['opera_vlr'], 2, ',', '.');
        $mensagemCli .= "<br/>";
        $mensagemCli .= "<strong>Valor Líquido a ser creditado:</strong> R$ ".number_format((float)$data['valor_liq'], 2, ',', '.');
        $mensagemCli .= "<br/>";
        $mensagemCli .= "<strong>Data:</strong> ".$data['data'];
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
            'sub-title' => 'Saque em conta',
            'date' => now(),
            'email' => env('MAIL_FROM_ADDRESS'),
        ];

        $mensagemAdm = "<br/>";
        $mensagemAdm .= "O usuário ".$user->name." acabou de fazer um saque na conta dele.";
        $mensagemAdm .= "<br/>";
        $mensagemAdm .= "CPF do usuário: ".$user->cpf;
        $mensagemAdm .= "<br/>";
        $mensagemAdm .= "Agora, você precisa transferir da conta depósito FutPay para a conta do usuário de acordo com os dados abaixo:";
        $mensagemAdm .= "<br/><br/>";
        $mensagemAdm .= "<strong>Dados da transação:</strong>";
        $mensagemAdm .= "<br/><br/>";
        $mensagemAdm .= "<strong>Valor:</strong> R$ ".number_format((float)$data['valor'], 2, ',', '.');
        $mensagemAdm .= "<br/>";
        $mensagemAdm .= "<strong>Taxa Adm:</strong> R$ ".number_format((float)$data['opera_vlr'], 2, ',', '.');
        $mensagemAdm .= "<br/>";
        $mensagemAdm .= "<strong>Valor Líquido a ser creditado para o cliente:</strong> R$ ".number_format((float)$data['valor_liq'], 2, ',', '.');
        $mensagemAdm .= "<br/>";
        $mensagemAdm .= "<strong>Data:</strong> ".$data['data'];
        $mensagemAdm .= "<br/>";
        $mensagemAdm .= "<strong>Chave:</strong>";
        $mensagemAdm .= "<br/>";
        $mensagemAdm .= $data['operation_key'];
        $mensagemAdm .= "<br/>";
        $mensagemAdm .= "Após realizar a transferencia favor confirmar a operação no sistema";
        $mensagemAdm .= "<br/>";
        $mensagemAdm .= "Para acessar o sistema use o link do botão abaixo";
        $mensagemAdm .= "<br/><br/>";
        $mailDataAdm = [
            'mensagem' => $mensagemAdm,
            'url' => route('login'),
            'title-button' => 'Acessar sistema',
            'title' => 'Olá Administrador',
            'sub-title' => 'Saque em conta',
            'date' => now(),
            'email' => env('MAIL_FROM_ADDRESS'),
        ];

        Mail::to($email)->send(new EmailDep($mailData, $subject));
        Mail::to($emailAdm)->send(new EmailDep($mailDataAdm, $subject));
        if (ResponseAlias::HTTP_OK){
            $msg = 'Saque realizado com sucesso. Enviamos um E-mail com os dados!';
            $request->session()->flash('msg', $msg);
            return redirect()->route('logado.users.show', compact('user', 'conta'));
        }else{
            $error = 'Ops! Tivemos problema. Verifique a sua conta, caso o valor tenha sido abatido do seu saldo, passe um email pelo formulário de contato.';
            $request->session()->flash('error', $error);
            return redirect()->route('logado.users.show', compact('user', 'conta'));
        }
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
        //dd($conta->id);
        $today = Carbon::now();
        if ($data == null){
            $startDate = $today->subDays(7);
            //dd($startDate);
            $movimentos = \DB::table('movimentos')
                ->where('conta_id', $conta->id)
                ->whereBetween('data', [now()->subDays(7), now()])
                ->orderBy('data', 'DESC')->get();
            $periodo = "Extrato dos últimos 7 dias daqui";
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
