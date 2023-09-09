<?php

namespace App\Utils;

use App\Models\Movimento;

class AutorizaAction
{
    public function autorAction($attribute, $value, $parameters, $validator)
    {
        return $this->isValidate($attribute, $value, $parameters);
    }

    protected function isValidate($attribute, $value, $parametters)
    {
        $moveId = $parametters[0];
        $movimento = Movimento::whereId($moveId)->first();
        $userId = $movimento->conta->user->id;
        $authId = $value;
        if($userId == $authId){
            return false;
        }else{
            return true;
        }
    }
}
