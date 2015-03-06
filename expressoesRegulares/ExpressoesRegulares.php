<?php
/**
 * Description of ExpressoesRegulares
 *
 * @author Marcelo
 */
class  ExpressoesRegulares {
    
    public static function conferirNome($nome){                    
        //$regularNome = "(^[\'\.\^\~\´\`\\áÁ\\àÀ\\ãÃ\\âÂ\\éÉ\\èÈ\\êÊ\\íÍ\\ìÌ\\óÓ\\òÒ\\õÕ\\ôÔ\\úÚ\\ùÙ\\çÇaA-zZ]+)+((\s[\'\.\^\~\´\`\\áÁ\\àÀ\\ãÃ\\âÂ\\éÉ\\èÈ\\êÊ\\íÍ\\ìÌ\\óÓ\\òÒ\\õÕ\\ôÔ\\úÚ\\ùÙ\\çÇaA-zZ]+)+)?$";        
        //$regularNome = "^[aA-zZ]+((\s[aA-zZ]+)+)?$";
        
        $regularNome = "/[a-zA-Z ]{6,12}$/";
        
        if(preg_match($regularNome, $nome)){
            return true;
        }else{
            return false;
        }
    }
    
     public static function conferirCpf($cpf){
        
        $regularCpf = "/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}$/";
        
        if(preg_match($regularCpf, $cpf)){
            return true;
        }else{
            return false;
        } 
    }
    
    public static function conferirEmail($email){        
        //$regularEmail = "/^[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\-]+\.[a-z]{2,4}$/";
        
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }   
    
    public static function conferirTelefone($telefone){
        
        //$regularTelefone = "/^\([0-9]{3}\) [0-9]{4}-[0-9]{4}$/";
        //$regularTelefone = "/^(\(11\) [9][0-9]{4}-[0-9]{4})|(\(1[2-9]\) [5-9][0-9]{3}-[0-9]{4})|(\([2-9][1-9]\) [5-9][0-9]{3}-[0-9]{4})$/";        
        //'/^(0[1-2][1-9]9\d{8})$/'
        //$regularTelefone = "/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/";
        $regularTelefone = "/^\([0-9]{2}\) [0-9]{4}-[0-9]{4}$/";        
              
        if(preg_match($regularTelefone, $telefone)){
            return true;
        }else{
            return false;
        }   
    }
    
    public static function conferirLogin($login){
        
        //$regularLogin = "/^[a-zA-Z]{1}[0-9a-zA-Z]+/g";
        
        $regularLogin = "/^[A-Za-z]{1}[A-Za-z0-9]{5,31}$/";
        
        if(preg_match($regularLogin, $login)){
            return true;
        }else{
            return false;
        }
    }
    
    public static function conferirSenha($senha){
        
         //$regularSenha = "/[0-9]{3}[0-9]+/g";
        //$regularSenha = "/^\S*(?=\S{8,})(?=\S*[az])(?=\S*[AZ])(?=\S*[\d])\S*$/";
        //$regularSenha = "/^(?=.*\d)(?!.*\s).{4,8}$/";
        
        $regularSenha = '$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$';
        
        if(preg_match($regularSenha, $senha)){
            return true;
        }else{
            return false;
        }  
    }
}
