<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class JogoForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('player1', 'text')
            ->add('player2', 'text')
            ->add('vencedor', 'text')
            ->add('url_video', 'text');
    }
}
