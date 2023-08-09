<?php

namespace App\Utils;

use App\Models\Conta;

class SaldoValidation
{

    public function validate($attribute, $value, $parametters, $validator)
    {
        return $this->isValidate($attribute, $value, $parametters);
    }

    protected function isValidate($attribute, $value, $parametters)
    {
        $id = $parametters[0];
        $conta = Conta::whereId($id)->first();
        $value = str_replace(',', '.', $value); // substitui vírgula por ponto
        if ($conta->disponivel >= $value){
            return true;
        }else {
            return false;
        }
    }
}
