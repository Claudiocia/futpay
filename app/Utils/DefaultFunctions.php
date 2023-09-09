<?php

namespace App\Utils;

class DefaultFunctions
{
    public static function tirarAcentos($string)
    {
        $str = preg_replace(array("/(á|à|ã|â|ä|Á|À|Ã|Â|Ä)/","/(é|è|ê|ë|É|È|Ê|Ë)/","/(í|ì|î|ï|Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö|Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü|Ú|Ù|Û|Ü)/","/(ñ|Ñ)/","/(ç|Ç)/","/( )/"),explode(" ","a e i o u n c _"),$string);
        return strtolower($str);
    }
}
