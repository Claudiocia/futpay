<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class DisputacampForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('campeonato_id', 'text')
            ->add('player1', 'text')
            ->add('player2', 'text')
            ->add('data', 'text')
            ->add('hora', 'text')
            ->add('vencedor', 'text')
            ->add('url_video', 'text');
    }
}
