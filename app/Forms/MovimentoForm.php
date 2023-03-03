<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class MovimentoForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('description', 'text')
            ->add('tipo', 'text')
            ->add('valor', 'text')
            ->add('data', 'text')
            ->add('conta_id', 'text');
    }
}
