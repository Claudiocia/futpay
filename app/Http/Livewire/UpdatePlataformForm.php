<?php

namespace App\Http\Livewire\Profile;

use App\Forms\PlataformaFormEdit;
use App\Forms\UserForm;
use Livewire\Component;

class UpdatePlataformForm extends Component
{
    public function render()
    {
        return view('profile.update-plataform-form');
    }
}
