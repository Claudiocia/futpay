<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class TaxaForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('operation', 'text', [
                'label' => 'Tipo de Operação',
                'attr' => ['placeholder' => 'Qual operação vc deseja taxar -- escreva aqui']
            ])
            ->add('tipo', 'choice', [
                'label' => 'Tipo: ',
                'label_attr' => ['class' => 'label-form required'],
                'choices' => ['1' => 'Valor Fixo', '2' => 'Percentual'],
                'choice_options' => [
                    'wrapper' => ['class' =>  'choice-wrapper-my'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'selected' => $this->model ? [$this->model->tipo] : [],
                'multiple' => false,
                'expanded' => true,
            ])
            ->add('valor', 'text', [
                'attr' => ['placeholder' => 'Seja percentual, ou valor use o formato 0.00']
            ]);
    }
}
