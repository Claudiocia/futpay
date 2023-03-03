<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class RachaoForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('premio', 'text')
            ->add('hora', 'text')
            ->add('valor', 'text')
            ->add('data', 'text')
            ->add('plataforma_id', 'text')
            ->add('qtd_players', 'text')
            ->add('status', 'text')
            ->add('arrecadacao_total', 'text');
    }
}
