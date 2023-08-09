<?php

namespace App\Forms;

use App\Models\Game;
use App\Models\Plataforma;
use Kris\LaravelFormBuilder\Form;

class PlataformaFormEdit extends Form
{
    public function buildForm()
    {
        if($this->model){
            $i = count($this->model->plataformas);
            $g = count($this->model->games);
            if ($i == 0){
                $plat[] = '';
            }else{
                $plat[] = $this->model->plataformas->pluck('id')->toArray();
            }
            if ($g == 0){
                $gam[] = '';
            }else{
                $gam[] = $this->model->games->pluck('id')->toArray();
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
            ])
            ->add('game', 'choice', [
                'label' => 'Game: ',
                'label_attr' => ['class' => 'label-form required'],
                'choices' => Game::all()->pluck('name', 'id')->toArray(),
                'choice_options' => [
                    'wrapper' => ['class' => 'choice-wrapper-my'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'selected' => $this->model ? $gam[0] : [],
                'multiple' => true,
                'expanded' => true,
            ]);
    }
}
