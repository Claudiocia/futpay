<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class MovimentoForm extends Form
{
    public function buildForm()
    {

        $this
            ->add('description', 'hidden', [
                'value' => $this->formOptions['tipo'] == 'credito' ? 'Depósito em carteira virtual' : 'Saque de carteira virtual',
            ])
            ->add('tipo', 'hidden', [
                'value' => $this->formOptions['tipo'],
            ])
            ->add('data', 'hidden', [
                'value' => now()
            ])
            ->add('conta_id', 'hidden', [
                'value' => $this->model->id,
            ])
            ->add('valor', 'text', [
                'label' => 'Valor mínimo R$ 10,00',
                'label_attr' => ['class' => 'small'],
                'rules' => ['required'],
                'attr' => ['placeholder' => 'Digite um valor entre 10,00 e 500,00']
            ]);
    }
}
