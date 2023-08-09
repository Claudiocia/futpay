<?php

namespace App\Utils;

use Carbon\Carbon;

class DatasExtratoValidation
{
    public function ordemData($attribute, $value, $parametters, $validator)
    {
        return $this->isOrdemData($attribute, $value, $parametters);
    }

    public function diferencaDias($attribute, $value, $parametters, $validator)
    {
        return $this->isDiferencaDias($attribute, $value, $parametters);
    }

    public function dataFinal($attribute, $value, $parametters, $validator)
    {
        return $this->isDataFinal($attribute, $value);
    }

    protected function isOrdemData($attribute, $value, $parametters,)
    {
        $data_ini = $parametters[0];
        if ($data_ini > $value){
            return false;
        }else {
            return true;
        }
    }

    protected function isDiferencaDias($attribute, $value, $parametters)
    {
        $diferencaDias = (strtotime($value) - strtotime($parametters[0])) / (60 * 60 * 24);
        if ($diferencaDias > 90){
            return false;
        }else{
            return true;
        }
    }

    protected function isDataFinal($attribute, $value)
    {
        $today = Carbon::now();
        if ($value > $today){
            return false;
        }else {
            return true;
        }
    }
}
