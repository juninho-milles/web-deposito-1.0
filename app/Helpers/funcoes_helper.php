<?php

function validaCpfCnpj($inputCnpj_cpf) {
   
    $retorno = 'naovalido';
    if(strlen($inputCnpj_cpf) == 14) {
        return formataCpfCnpj($inputCnpj_cpf);
    }
    if(strlen($inputCnpj_cpf) == 18) {
        return formataCpfCnpj($inputCnpj_cpf);
    }
    if(strlen($inputCnpj_cpf) > 18){
        return $inputCnpj_cpf;
    }
    if(strlen($inputCnpj_cpf) == 0) {
        return '';
    }

    return $retorno;
}

function formataCpfCnpj($cpf_cnpj) {
    $cpf_cnpj = preg_replace("/[^0-9]/", "", $cpf_cnpj);
    $tipo_dado = NULL;
    if(strlen($cpf_cnpj)==11){
        $tipo_dado = "cpf";
    }
    if(strlen($cpf_cnpj)==14){
        $tipo_dado = "cnpj";
    }
    switch($tipo_dado){
        default:
            $cpf_cnpj_formatado = "Não foi possível definir tipo de dado";
        break;

        case "cpf":
            $bloco_1 = substr($cpf_cnpj,0,3);
            $bloco_2 = substr($cpf_cnpj,3,3);
            $bloco_3 = substr($cpf_cnpj,6,3);
            $dig_verificador = substr($cpf_cnpj,-2);
            $cpf_cnpj_formatado = $bloco_1.".".$bloco_2.".".$bloco_3."-".$dig_verificador;
        break;

        case "cnpj":
            $bloco_1 = substr($cpf_cnpj,0,2);
            $bloco_2 = substr($cpf_cnpj,2,3);
            $bloco_3 = substr($cpf_cnpj,5,3);
            $bloco_4 = substr($cpf_cnpj,8,4);
            $digito_verificador = substr($cpf_cnpj,-2);
            $cpf_cnpj_formatado = $bloco_1.".".$bloco_2.".".$bloco_3."/".$bloco_4."-".$digito_verificador;
        break;
    }
    return $cpf_cnpj_formatado;
}

function validaCampoPeso($peso) {

    if($peso == ''):
        return '0.000';
    else:
        return $peso;
    endif;
}

function validaCampoDescarrego($valor) {
    if($valor == ''):
        return '0,00';
    else:
        return $valor;
    endif;
}

function formataPlacadeCarro($placa){

        if($placa != '') {
            

            $primeiraParte = substr($placa,0,3);
            $segundaParte = substr($placa,3);
        
            $PLACA = $primeiraParte ."-". $segundaParte;
            return strtoupper($PLACA);
        }else {
            return '';
        }
    
}

function retornaDataAtual() {
    $timezone = new DateTimeZone('America/Fortaleza');
    $agora = new DateTime('now', $timezone); 

    return $agora->format('Y-m-d');
}

function retornaDataHoraAtual() {
    $timezone = new DateTimeZone('America/Fortaleza');
    $agora = new DateTime('now', $timezone); 

    return $agora->format('Y-m-d h:i:s');
}

function converteValorPorExtenso($value, $uppercase = 0) {
	if (strpos($value, ",") > 0) {
        $value = str_replace(".", "", $value);
        $value = str_replace(",", ".", $value);
    }
    $singular = ["centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão"];
    $plural = ["centavos", "reais", "mil", "milhões", "bilhões", "trilhões", "quatrilhões"];
 
    $c = ["", "cem", "duzentos", "trezentos", "quatrocentos", "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos"];
    $d = ["", "dez", "vinte", "trinta", "quarenta", "cinquenta", "sessenta", "setenta", "oitenta", "noventa"];
    $d10 = ["dez", "onze", "doze", "treze", "quatorze", "quinze", "dezesseis", "dezesete", "dezoito", "dezenove"];
    $u = ["", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove"];
 
    $z = 0;
 
    $value = number_format($value, 2, ".", ".");
    $integer = explode(".", $value);
    $cont = count($integer);
    for ($i = 0; $i < $cont; $i++)
        for ($ii = strlen($integer[$i]); $ii < 3; $ii++)
            $integer[$i] = "0" . $integer[$i];
 
    $fim = $cont - ($integer[$cont - 1] > 0 ? 1 : 2);
    $rt = '';
    for ($i = 0; $i < $cont; $i++) {
        $value = $integer[$i];
        $rc = (($value > 100) && ($value < 200)) ? "cento" : $c[$value[0]];
        $rd = ($value[1] < 2) ? "" : $d[$value[1]];
        $ru = ($value > 0) ? (($value[1] == 1) ? $d10[$value[2]] : $u[$value[2]]) : "";
 
        $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd &&
                $ru) ? " e " : "") . $ru;
        $t = $cont - 1 - $i;
        $r .= $r ? " " . ($value > 1 ? $plural[$t] : $singular[$t]) : "";
        if ($value == "000"
        )
            $z++;
        elseif ($z > 0)
            $z--;
        if (($t == 1) && ($z > 0) && ($integer[0] > 0))
            $r .= ( ($z > 1) ? " de " : "") . $plural[$t];
        if ($r)
            $rt = $rt . ((($i > 0) && ($i <= $fim) &&
                    ($integer[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
    }
 
    if (!$uppercase) {
        return trim($rt ? $rt : "zero");
    } elseif ($uppercase == "2") {
        return trim(strtoupper($rt) ? strtoupper(strtoupper($rt)) : "Zero");
    } else {
        return trim(ucwords($rt) ? ucwords($rt) : "Zero");
    }
}

?>