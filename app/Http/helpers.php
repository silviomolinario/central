<?php

function reais($valor){
    $valor = str_replace(',', '', $valor);
    $valor = number_format((float) $valor, 2, ',','.');
    return 'R$ '.$valor;
}

function convertFloat($valor){
    $valor = str_replace('.', '', $valor);
    $valor = str_replace(',', '.', $valor);
    return $valor;
}

function converteArray($objects,$key,$name){
    
    $array = [];
    
    if($objects){
        foreach ($objects AS $object){
            $array[$object->$key] = $object->$name;
        }
    }
    return $array;
}

function justNumber($number){
    return preg_replace("/[^0-9]/", "", $number);;
}

function convertData($data)
{
    return \DateTime::createFromFormat('d/m/Y', $data)->format('Y-m-d');
}

function formatoBrazil($data)
{
    return date('d/m/Y', strtotime($data));
}