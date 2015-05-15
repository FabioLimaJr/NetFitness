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
}
