<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExpressoesRegulares
 *
 * @author Marcelo
 */
class  ExpressoesRegulares {
    
    public static function conferirNome($nome){
                    
        //$regularNome = "(^[\'\.\^\~\´\`\\áÁ\\àÀ\\ãÃ\\âÂ\\éÉ\\èÈ\\êÊ\\íÍ\\ìÌ\\óÓ\\òÒ\\õÕ\\ôÔ\\úÚ\\ùÙ\\çÇaA-zZ]+)+((\s[\'\.\^\~\´\`\\áÁ\\àÀ\\ãÃ\\âÂ\\éÉ\\èÈ\\êÊ\\íÍ\\ìÌ\\óÓ\\òÒ\\õÕ\\ôÔ\\úÚ\\ùÙ\\çÇaA-zZ]+)+)?$";
        
        $regularNome = "^[aA-zZ]+((\s[aA-zZ]+)+)?$";
        
        if(preg_match($regularNome, $nome)){
            return true;
        }else{
            return false;
        }
        
         return true;
    }
    
     public static function conferirCpf($cpf){
        
        $regularCpf = "^([0-9]){3}\.([0-9]){3}\.([0-9]){3}-([0-9]){2}$";
        
        if(!eregi($regularCpf, $cpf)){
            return true;
        }else{
            return false;
        }         
         return true;
    }
    
    public static function conferirEmail($email){
        
        $regularEmail = "^[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\-]+\.[a-z]{2,4}$";
        
        if(!eregi($regularEmail, $email)){
            return true;
        }else{
            return false;
        }         
         return true;
    }   
    
    public static function conferirTelefone($telefone){
        
        $regularTelefone = "^\([0-9]{3}\) [0-9]{4}-[0-9]{4}$";
        
        if(!eregi($regularTelefone, $telefone)){
            return true;
        }else{
            return false;
        }         
         return true;
    }
    
    public static function conferirLogin($login){
        
        $regularLogin = "/^[a-zA-Z]{1}[0-9a-zA-Z]+/g";
        
        if(preg_match($regularLogin, $login)){
            return true;
        }else{
            return false;
        }         
         return true;
    }
    
    public static function conferirSenha($senha){
        
        $regularSenha = "/[0-9]{3}[0-9]+/g";
        
        if(preg_match($regularSenha, $login)){
            return true;
        }else{
            return false;
        }         
         return true;
    }
}
