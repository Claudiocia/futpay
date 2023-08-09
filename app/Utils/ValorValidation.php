<?php

namespace App\Utils;

class ValorValidation
{

    public function validate($attribute, $value, $parametters, $validator)
    {
        return $this->isValidate($attribute, $value);
    }

    protected function isValidate($attribute, $value)
    {
        $value = str_replace(',', '.', $value); // substitui vírgula por ponto
        $value = number_format((float)$value, 2, '.', ''); // formata com duas casas decimais
        //dd($value);
        if ($value >= 10.00 && $value <= 500.00) {
            return true;
        } else {
            return false;
        }
    }

}
