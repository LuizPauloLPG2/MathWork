<?php

class Config
{

    public static function convertDateToFormatBr($date)
    {
        return implode('/', array_reverse(explode('-', $date)));
    }

    public static function getCurrentDay()
    {
        setlocale(LC_ALL, 'pt_BR');
        date_default_timezone_set('America/Sao_Paulo');
        $date = date("Y-m-d");
        return $date;
    }

    public static function getCurrentTime()
    {
        setlocale(LC_ALL, 'pt_BR');
        date_default_timezone_set('America/Sao_Paulo');
        $time = date('H:i:s');
        return $time;
    }

    public static function convertNumberToFormatBr($valor)
    {
        return number_format($valor, 2, ',', '.');
    }
}
