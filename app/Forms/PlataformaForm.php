<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class PlataformaForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', [
                'label' => 'Nome',
                'label_attr' => ['class' => 'label-form required'],
                'attr' => ['placeholder' => 'informe o nome da Plataforma', 'class' => 'form-control my-field']
            ])
            ->add('sigla', 'text', [
                'label' => 'Sigla',
                'label_attr' => ['class' => 'label-form required'],
                'attr' => ['placeholder' => 'informe a sigla que será usada', 'class' => 'form-control my-field']
            ]);
    }
}
