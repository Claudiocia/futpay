<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ContaForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('numero', 'text')
            ->add('saldo', 'text')
            ->add('user_id', 'text');
    }
}
