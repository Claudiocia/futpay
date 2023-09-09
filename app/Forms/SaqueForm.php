<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class SaqueForm extends Form
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
            ->add('valor', 'hidden', [
                'value' => $this->formOptions['total'],
            ])
            ->add('valor_tot', 'text', [
                'label' => 'Valor Solicitado',
                'value' => 'R$ '.number_format((float)$this->formOptions['total'], 2, ',', '.'),
                'label_attr' => ['class' => 'small'],
                'attr' => ['disabled' => 'disabled']
            ])->add('opera_vlr', 'hidden', [
                'value' => $this->formOptions['opera'],
            ])
            ->add('opera', 'text', [
                'label' => 'Taxa Administrativa',
                'value' => 'R$ '.number_format((float)$this->formOptions['opera'], 2, ',', '.'),
                'label_attr' => ['class' => 'small'],
                'attr' => ['disabled' => 'disabled']
            ])->add('valor_liq', 'hidden', [
                'value' => $this->formOptions['liqui'],
            ])
            ->add('liquido', 'text', [
                'label' => 'Valor que será creditado em sua conta',
                'value' => 'R$ '.number_format((float)$this->formOptions['liqui'], 2, ',', '.'),
                'label_attr' => ['class' => 'small'],
                'attr' => ['disabled' => 'disabled']
            ]);
    }
}
