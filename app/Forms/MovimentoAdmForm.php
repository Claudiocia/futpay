<?php

namespace App\Forms;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\Form;

class MovimentoAdmForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('id', 'hidden')
            ->add('autoriza','hidden', [
                'value' => Auth::id(),
            ])
            ->add('tipo', 'text', [
                'label' => 'Tipo de Movimentação',
                'attr' => ['disabled' => 'disabled']
            ])
            ->add('description', 'text', [
                'label' => 'Descrição',
                'attr' => ['disabled' => 'disabled']
            ])
            ->add('valor', 'text', [
                'label' => 'Valor',
                'value' => 'R$ '.number_format($this->model->valor, 2, ",", "."),
                'attr' => ['disabled' => 'disabled']
            ])
            ->add('data', 'text', [
                'label' => 'Data e hora da operação',
                'value' => Carbon::parse($this->model->data)->format('d/m/Y H:i:s'),
                'attr' => ['disabled' => 'disabled'],
            ])
            ->add('meio_pag', 'text', [
                'label' => 'Meio de pagamento',
                'attr' => ['disabled' => 'disabled']
            ])
            ->add('status', 'text', [
                'label' => 'Status da operação',
                'attr' => ['disabled' => 'disabled']
            ])
            ->add('motiv_status', 'text', [
                'label' => 'Motivo',
                'attr' => ['disabled' => 'disabled']
            ])
            ->add('operation_key', 'text', [
                'label' => 'Chave da operação',
                'attr' => ['disabled' => 'disabled']
            ])
            ->add('name', 'text', [
                'label' => 'Titular da Conta',
                'value' => $this->model->conta->user->name,
                'attr' => ['disabled' => 'disabled']
            ])->add('cpf', 'text', [
                'label' => 'CPF do Titular da Conta',
                'value' => $this->model->conta->user->cpf,
                'attr' => ['disabled' => 'disabled', 'id' => 'cpf']
            ])
            ->add('operacao', 'choice', [
                'label' => 'Essa operação será',
                'label_attr' => ['class' => 'control-label required'],
                'choices' => ['1' => 'Confirmada', '2' => 'Recusada'],
                'choice_options' => [
                    'wrapper' => ['class' => 'choice-wrapper-my'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'multiple' => false,
                'expanded' => true,
            ]);
    }
}
