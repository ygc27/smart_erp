<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('dateBR2MySQL')) {

    /**
     * Converte dd/mm/yyyy -> Y-m-d
     *
     * @param string $valor            
     * @return numeric
     */
    function dateBR2MySQL($valor) {
        $valor = explode("/", $valor);
        $valor = $valor [2] . '-' . $valor [1] . '-' . $valor [0];
        return $valor;
    }

}

if (!function_exists('dateMySQL2BR')) {

    /**
     * Converte Y-m-d - > dd/mm/yyyy
     *
     * @param string $valor
     * @return numeric
     */
    function dateMySQL2BR($valor) {
        $date = date_create($valor);
        return date_format($date, 'd/m/Y');
    }

}

if (!function_exists('getDiaDaSemana')) {

    function getDiaDaSemana($timestamp) {

        $timestamp = strtotime($timestamp);
        $date = getdate($timestamp);
        $diaSemana = $date['weekday'];

        if (preg_match('@(sunday|domingo)@is', $diaSemana))
            $diaSemana = 'Domingo';

        if (preg_match('@(monday|segunda)@is', $diaSemana))
            $diaSemana = 'Segunda';

        if (preg_match('@(tuesday|terça)@is', $diaSemana))
            $diaSemana = 'Terça';

        if (preg_match('@(wednesday|quarta)@is', $diaSemana))
            $diaSemana = 'Quarta';

        if (preg_match('@(thursday|quinta)@is', $diaSemana))
            $diaSemana = 'Quinta';

        if (preg_match('@(friday|sexta)@is', $diaSemana))
            $diaSemana = 'Sexta';

        if (preg_match('@(saturday|sábado)@is', $diaSemana))
            $diaSemana = 'Sábado';

        return $diaSemana;
    }

}

if (!function_exists('vencimentoBoleto')) {

    function vencimentoBoleto($data) {
        if (getDiaDaSemana($data) == ("Sábado"))
            $data = date('Y-m-d', strtotime($data . ' + 2 days'));
        else if (getDiaDaSemana($data) == ("Domingo"))
            $data = date('Y-m-d', strtotime($data . '+ 1 days'));
        else
        //Data planejada para o vencimento
            $data = date('Y-m-d', strtotime($data . '+ 1 days'));

        $data = date_create($data);
        $data = date_format($data, 'd/m/Y');

        return $data;
    }

}

if (!function_exists('validaCPF')) {

    /**
     * Valida se o CPF informado é válido
     *
     * @param integer $cpf            
     */
    function validaCPF($cpf) {
        if (!is_numeric($cpf)) {
            return false;
        }

        $aCPFsBloqueados = array(
            "00000000000",
            "11111111111",
            "22222222222",
            "33333333333",
            "44444444444",
            "55555555555",
            "66666666666",
            "77777777777",
            "88888888888",
            "99999999999"
        );

        if (in_array($cpf, $aCPFsBloqueados)) {
            return false;
        }

        // DÍGITO VERIFICADOR

        $dv_informado = substr($cpf, 9, 2);

        for ($i = 0; $i <= 8; $i ++) {
            $digito [$i] = substr($cpf, $i, 1);
        }

        // CALCULA O VALOR DO 10º DÍGITO DE VERIFICAÇÃO

        $posicao = 10;
        $soma = 0;

        for ($i = 0; $i <= 8; $i ++) {
            $soma = $soma + $digito [$i] * $posicao;
            $posicao = $posicao - 1;
        }

        $digito [9] = $soma % 11;

        if ($digito [9] < 2) {
            $digito [9] = 0;
        } else {
            $digito [9] = 11 - $digito [9];
        }

        // CALCULA O VALOR DO 11º DÍGITO DE VERIFICAÇÃO
        $posicao = 11;
        $soma = 0;

        for ($i = 0; $i <= 9; $i ++) {
            $soma = $soma + $digito [$i] * $posicao;
            $posicao = $posicao - 1;
        }

        $digito [10] = $soma % 11;

        if ($digito [10] < 2) {
            $digito [10] = 0;
        } else {
            $digito [10] = 11 - $digito [10];
        }

        $dv = $digito [9] * 10 + $digito [10];

        if ($dv != $dv_informado) {
            return false;
        }

        return true;
    }

}

if (!function_exists('validaCNPJ')) {

    /**
     * Valida se o CNPJ informado é válido
     *
     * @param integer $cnpj            
     */
    function validaCNPJ($cnpj) {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        // Valida tamanho
        if (strlen($cnpj) != 14)
            return false;
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
            return false;
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
    }

}


if (!function_exists('modificaDinheiroBanco')) {

    /**
     * Modifica o valor de moeda para gravar no banco de dados
     *
     * @param string $valor            
     * @return numeric
     */
    function modificaDinheiroBanco($valor) {
        if (!$valor) {
            return 0;
        }
        $valor = str_replace('.', null, $valor);
        $valor = str_replace(',', '.', $valor);
        return $valor;
    }

}

if (!function_exists('modificaNumericValor')) {

    /**
     * Modifica o valor de numeric para valor em R$
     *
     * @param string $valor            
     * @return numeric
     */
    function modificaNumericValor($valor) {
        $valor = number_format($valor, 2, ',', '.');
        return $valor;
    }

}