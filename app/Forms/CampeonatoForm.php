<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class CampeonatoForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('hora', 'text')
            ->add('data', 'text')
            ->add('valor', 'text')
            ->add('premio', 'text')
            ->add('qtd_players', 'text')
            ->add('status', 'text')
            ->add('arrecadacao_total', 'text')
            ->add('vencedor', 'text')
            ->add('vice', 'text')
            ->add('terceiro', 'text')
            ->add('quarto', 'text')
            ->add('plataforma_id', 'text');
    }
}
