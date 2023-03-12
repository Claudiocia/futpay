<?php

namespace App\Forms;

use App\Models\Plataforma;
use Kris\LaravelFormBuilder\Form;

class PlataformaForms extends Form
{
    public function buildForm()
    {
        if($this->model){
            $i = count($this->model->plataformas);
            if ($i == 0){
                $plat[] = '';
            }else{
                $plat[] = $this->model->plataformas->pluck('id')->toArray();
            }
        }
        $this
            ->add('plataforma', 'choice', [
                'label' => 'Plataforma: ',
                'label_attr' => ['class' => 'label-form required'],
                'choices' => Plataforma::all()->pluck('name', 'id')->toArray(),
                'choice_options' => [
                    'wrapper' => ['class' => 'choice-wrapper-my'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'selected' => $this->model ? $plat[0] : [],
                'multiple' => true,
                'expanded' => true,
            ]);
    }
}
