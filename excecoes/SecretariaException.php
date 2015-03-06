<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SecretariaException
 *
 * @author Fábio
 */
class SecretariaException {
    
    public static function nenhumSecretario($message)
    {
        return "Nenhum : ".$message."\n";
    }
    
}
