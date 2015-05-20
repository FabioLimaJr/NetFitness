<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Texto
 *
 * @author Daniele
 */
class Texto
{
    public static function brReplace($text)
    {
         return str_replace("<br/>", "\n", $text);
    }
    
    public static function dataInvert($data)
    {
        $dataExplode = explode("-", $data);
        $dataReturn[0] = $dataExplode[2];
        $dataReturn[1] = $dataExplode[1];
        $dataReturn[2] = $dataExplode[0];
        
        return implode("-", $dataReturn);
    }
    
    public static function convertDataFormat($oldFormat, $newFormat, $data)
    {
        date_default_timezone_set('America/Recife');
        $myDateTime = DateTime::createFromFormat($oldFormat, $data);
        return $myDateTime->format($newFormat);
    }
}
