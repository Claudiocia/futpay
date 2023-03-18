<?php

namespace App\Utils;

class GerarConta
{
    // Função para gerar um número com 8 dígitos e 1 verificador
    public function gerarNumeroComVerificador() {
        // Gera um número aleatório com 8 dígitos
        $num = str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT);

        // Verifica se o número contém uma sequência maior que 2 dígitos iguais
        for ($i = 0; $i < 10; $i++) {
            $seq = str_repeat($i, 3);
            if (strpos($num, $seq) !== false) {
                // Caso o número contenha uma sequência maior que 2 dígitos iguais, gera um novo número
                return $this->gerarNumeroComVerificador();
            }
        }

        // Calcula o verificador
        $verificador = array_sum(str_split(substr($num, 0, 4))) - array_sum(str_split(substr($num, 4)));

        if ($verificador < 0) {
            $verificador *= -1;
        }

        $numero = $num.$verificador;
        if (!$this->verificarNumeroComVerificador($numero)){
            return $this->gerarNumeroComVerificador();
        }
        $dado = array(
            'numero' => $numero,
        );
        $validado = \Validator::make($dado, [
            'numero' => ['unique:contas']
        ])->validate();

        if (!$validado){
            return $this->gerarNumeroComVerificador();
        }

        // Adiciona o verificador ao final do número e retorna
        return $num.$verificador;
    }

    // Função para verificar se um número com 8 dígitos e 1 verificador é válido
    function verificarNumeroComVerificador($num) {
        // Verifica se o número tem 9 caracteres
        if (strlen($num) != 9) {
            return false;
        }

        // Verifica se o número contém apenas dígitos
        if (!ctype_digit($num)) {
            return false;
        }

        // Verifica se o número contém uma sequência maior que 2 dígitos iguais
        for ($i = 0; $i < 10; $i++) {
            $seq = str_repeat($i, 3);
            if (strpos($num, $seq) !== false) {
                return false;
            }
        }

        // Verifica se a soma dos 4 primeiros dígitos, diminuída da soma dos 4 últimos dígitos, é igual ao verificador
        $verificador = (int) substr($num, 8, 1);
        $soma1 = array_sum(str_split(substr($num, 0, 4)));
        $soma2 = array_sum(str_split(substr($num, 4, 4)));
        $result = $soma1 - $soma2;
        if ($result < 0){
            $result *= -1;
        }
        if ($result != $verificador) {
            return false;
        }

        // Caso todas as verificações tenham passado, o número é válido
        return true;
    }

}
