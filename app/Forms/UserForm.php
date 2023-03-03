<?php

namespace App\Forms;

use App\Models\Plataforma;
use Kris\LaravelFormBuilder\Form;

class UserForm extends Form
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
            ->add('name', 'text', [
                'label' => 'Nome',
                'label_attr' => ['class' => 'label-form required'],
                'attr' => ['placeholder' => 'informe o nome completo', 'class' => 'form-control my-field']
            ])
            ->add('email', 'email', [
                'label' => 'Email',
                'label_attr' => ['class' => 'label-form required'],
                'attr' => ['placeholder' => 'informe o seu email válido', 'class' => 'form-control my-field']
            ])
            ->add('dt_nasc', 'date', [
                'label' => 'Data Nascimento',
                'label_attr' => ['class' => 'label-form required'],
            ])
            ->add('nick_game', 'text', [
                'label' => 'Nick name',
                'label_attr' => ['class' => 'label-form required'],
                'attr' => ['placeholder' => 'informe como você se chama nos Jogos', 'class' => 'form-control my-field']
            ])
            ->add('phone', 'text', [
                'label' => 'Celular',
                'label_attr' => ['class' => 'label-form required'],
                'attr' => ['placeholder' => 'informe o número no formato (dd) 999999999', 'class' => 'form-control my-field']
            ])
            ->add('cpf', 'text', [
                'label' => 'CPF',
                'label_attr' => ['class' => 'label-form required'],
                'attr' => ['placeholder' => 'informe o seu CPF(só números)', 'class' => 'form-control my-field']
            ])
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
            ->add('role', 'choice', [
                'label' => 'Administrador: ',
                'label_attr' => ['class' => 'label-form required'],
                'choices' => ['1' => 'Sim', '2' => 'Não'],
                'choice_options' => [
                    'wrapper' => ['class' =>  'choice-wrapper-my'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'selected' => $this->model ? [$this->model->role] : [2],
                'multiple' => false,
                'expanded' => true,
            ]);
    }
}
