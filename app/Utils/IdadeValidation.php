<?php

namespace App\Utils;

use Faker\Core\DateTime;

class IdadeValidation
{
    public function validate($attribute, $value, $parametters, $validator)
    {
        return $this->isValidate($attribute, $value);
    }

    protected function isValidate($attribute, $value)
    {
        list($ano, $mes, $dia) = explode('-', $value);
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $dia_nasc = mktime(0, 0, 0, $mes, $dia, $ano);

        $idade = floor((((($hoje - $dia_nasc) / 60) / 60) / 24) / 365.25); //floor(($hoje - $dia_nasc) / (60 * 60 * 24 * 365));

        if ($idade >= 18) {
            return true;
        }else {
            return false;
        }
    }

}
