<?php

namespace App\Forms;

use App\Models\User;
use App\Utils\GerarConta;
use Kris\LaravelFormBuilder\Form;

class ContaForm extends Form
{
    public function buildForm()
    {
        if (!$this->model) {
            $gerar = new GerarConta();
            $numero = $gerar->gerarNumeroComVerificador();
            $users = User::whereNotIn('id', function ($query){
                $query->select('user_id')->from('contas');
            })->pluck('name', 'id')->toArray();
        }else{
            $numero = $this->model->numero;
            $users = User::whereIn('id', function ($query){
                $query->select('user_id')->from('contas')->where('user_id', '=', $this->model->user->id);
            })->pluck('name', 'id')->toArray();
        }
        $this
            ->add('num', 'text', [
                'label' => 'Numero da Conta',
                'value' => $numero,
                'attr' => ['disabled' => 'disabled']
            ])
            ->add('numero', 'hidden', [
                'value' => $numero,
            ])
            ->add('saldo', 'text', [
                'label' => 'Saldo Inicial',
                'value' => '0,00',
                'attr' => ['disabled' => 'disabled']
            ])
            ->add('user_id', 'choice', [
                'label' => 'Usuário',
                'label_attr' => ['class' => 'label-form required'],
                'choices' => $users,
                'choice_options' => [
                    'wrapper' => ['class' => 'choice-wrapper-my'],
                    'label_attr' => ['class' => 'label-class'],
                    'attr' => $this->model ? ['disabled' => 'disabled'] : [''],
                ],
                'empty_value' => $this->model ? $this->model->user->nome : 'Selecione...',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('active', 'choice', [
                'label' => 'Conta ativa? ',
                'label_attr' => ['class' => 'label-form required'],
                'choices' => ['s' => 'Sim', 'n' => 'Não'],
                'choice_options' => [
                    'wrapper' => ['class' =>  'choice-wrapper-my'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'selected' => $this->model ? [$this->model->active] : ['n'],
                'multiple' => false,
                'expanded' => true,
            ]);
    }
}
