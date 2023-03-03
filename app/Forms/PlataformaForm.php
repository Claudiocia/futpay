<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class PlataformaForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text');
    }
}
