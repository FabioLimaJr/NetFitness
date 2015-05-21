<?php
/**
 * Description of ExpressoesRegulares
 *
 * @author Marcelo
 */
class  ExpressoesRegulares {
    
    public static function validarTodosOsCampos($objeto){
        if(($objeto != "") && ($objeto != NULL))
        {
            
            if(!self::conferirNome($objeto->getNome()))
            {

                throw new Exception(Excecoes::nomeInvalido($objeto->getNome()));
            }

            if(!self::conferirCpf($objeto->getCpf()))
            {

                throw new Exception(Excecoes::cpfInvalido($objeto->getCpf()));
            }

            if(!self::conferirEmail($objeto->getEmail()))
            {
                throw new Exception(Excecoes::emailInvalido($objeto->getEmail()));
            }

            /** 
             * <?php // VALIDAR TELEFONE NO SEGUINTE FORMATO: (DDD) 3333-3333 
             * $telefone = "(014) 3236-3810";   
             * if (!eregi("^\([0-9]{3}\) [0-9]{4}-[0-9]{4}$", $telefone)) 
             * { echo "Telefone inválido"; 
             * }
             * ?> 
             */

            if(!self::conferirTelefone($objeto->getTelefone()))
            {
                throw new Exception(Excecoes::telefoneInvalido($objeto->getTelefone()));
            }

            if(!self::conferirLogin($objeto->getLogin()))
            {
                throw new Exception(Excecoes::loginInvalido($objeto->getLogin()));
            }

            if(!self::conferirSenha($objeto->getSenha()))
            {
                throw new Exception(Excecoes::senhaInvalida($objeto->getSenha()));
            }

            if(($objeto->getEndereco() === null) && ($objeto->getEndereco() === ""))
            {
                throw new Exception(Excecoes::enderecoInvalido($objeto->getEndereco()));
            }
            
        }else
        {
            throw new Exception(Excecoes::objetoNulo(""));
        }
        return true;
    }
    
    public static function validarTreino($objeto){
        if(($objeto != "") && ($objeto != NULL))
        {
            if(!self::conferirDescricao($objeto->getDescricao()))
            {

                throw new Exception(Excecoes::descricaoInvalida($objeto->getDescricao()));
            }
        }else
        {
            throw new Exception(Excecoes::objetoNulo(""));
        }
        return true;
    }
    
    
    public static function validarDieta($objeto)
    {
        if(($objeto != "") && ($objeto != NULL))
        {
            if( !self::conferirDescricao($objeto->getDescricao())|| $objeto->getDescricao()=="")
            {

                throw new Exception(Excecoes::descricaoInvalida($objeto->getDescricao()));
            }
            
            if($objeto->getListaAlimentos()==null)
            {
                throw new Exception(Excecoes::objetoNulo("A lista de alimentos é vazia"));
            }
            
            if($objeto->getNutricionista()==null)
            {
                throw new Exception(Excecoes::objetoNulo("Nutricionista não inicializada"));
            }
            if($objeto->getAluno()==null)
            {
                throw new Exception(Excecoes::objetoNulo("Aluno não inicializado"));
            }
            
        }
        else
        {
            throw new Exception(Excecoes::objetoNulo("Dieta não inicializada"));
        }
        return true;
    }
    
    
    public static function validarExameFisico($objeto)
    {
        if(($objeto != "") && ($objeto != NULL))
        {
            if( !self::conferirDescricao($objeto->getDescricao())|| $objeto->getDescricao()=="")
            {

                throw new Exception(Excecoes::descricaoInvalida($objeto->getDescricao()));
            }
            
            if($objeto->getInstrutor()==null)
            {
                throw new Exception(Excecoes::objetoNulo("Instrutor não inicializado"));
            }
            if($objeto->getAluno()==null)
            {
                throw new Exception(Excecoes::objetoNulo("Aluno não inicializado"));
            }
            
            if(!self::conferirData($objeto->getData()))
            {
                throw new Exception(Excecoes::dataInvalida("ExameFisico"));
            }
            
        }
        else
        {
            throw new Exception(Excecoes::objetoNulo("Dieta não inicializada"));
        }
        return true;
    }
    
    public static function conferirData($data)
    {
        $arrayData = explode("-", $data);
        date_default_timezone_set('America/Recife');
        
        if(checkdate($arrayData[1], $arrayData[0], $arrayData[2]))
        {
            if (strtotime($data) < time()) 
            {
                return false;
            }
            
            return true;
        }
        else
        {
            return false;
        }
                
    }
    
    public static function conferirDataNascimento($data)
    {
        $arrayData = explode("-", $data);
        
        if(checkdate($arrayData[1], $arrayData[0], $arrayData[2]))
        {
            return true;
        }
        else
        {
            return false;
        }
                
    }
    
    public static function conferirNome($nome){                    
        //$regularNome = "(^[\'\.\^\~\´\`\\áÁ\\àÀ\\ãÃ\\âÂ\\éÉ\\èÈ\\êÊ\\íÍ\\ìÌ\\óÓ\\òÒ\\õÕ\\ôÔ\\úÚ\\ùÙ\\çÇaA-zZ]+)+((\s[\'\.\^\~\´\`\\áÁ\\àÀ\\ãÃ\\âÂ\\éÉ\\èÈ\\êÊ\\íÍ\\ìÌ\\óÓ\\òÒ\\õÕ\\ôÔ\\úÚ\\ùÙ\\çÇaA-zZ]+)+)?$";        
        //$regularNome = "^[aA-zZ]+((\s[aA-zZ]+)+)?$";
        
        $regularNome = "~[a-zA-Z áÁãÃâÂàÀéÉêÊíÍóÓõÕôÔúÚçÇ-]{3,30}$~";
        
        if(preg_match($regularNome, $nome)){
            return true;
        }else{
            return false;
        }
    }
    
     public static function conferirCpf($cpf){
        
        $regularCpf = "~^[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}$~";
        
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
        $regularTelefone = "~^\([0-9]{2}\) [0-9]{4}-[0-9]{4}$~";        
              
        if(preg_match($regularTelefone, $telefone)){
            return true;
        }else{
            return false;
        }   
    }
    
    public static function conferirLogin($login){
        
        //$regularLogin = "/^[a-zA-Z]{1}[0-9a-zA-Z]+/g";
        
        $regularLogin = "~[a-zA-Z0-9@_.-]{8,16}$~";
        
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
        
        //$regularSenha = '$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$';
        $regularSenha = "~[a-zA-Z0-9@_.-]{8,16}$~";
        
        if(preg_match($regularSenha, $senha)){
            return true;
        }else{
            return false;
        }  
    }
    
    public static function conferirDescricao($descricao){                    
        //$regularNome = "(^[\'\.\^\~\´\`\\áÁ\\àÀ\\ãÃ\\âÂ\\éÉ\\èÈ\\êÊ\\íÍ\\ìÌ\\óÓ\\òÒ\\õÕ\\ôÔ\\úÚ\\ùÙ\\çÇaA-zZ]+)+((\s[\'\.\^\~\´\`\\áÁ\\àÀ\\ãÃ\\âÂ\\éÉ\\èÈ\\êÊ\\íÍ\\ìÌ\\óÓ\\òÒ\\õÕ\\ôÔ\\úÚ\\ùÙ\\çÇaA-zZ]+)+)?$";        
        //$regularNome = "^[aA-zZ]+((\s[aA-zZ]+)+)?$";
        
        $regularDescricao = "~[a-zA-Z0-9 áÁãÃâÂàÀéÉêÊíÍóÓõÕôÔúÚçÇ?=/!$%&()*+.,:;#@<>£^_|-]{3,500}$~";
        
        if(preg_match($regularDescricao, $descricao)){
            return true;
        }else{
            return false;
        }
    }
    
    public static function inverterData($data){
        
        $arrayData = explode("-", $data);
        $dataSqlFormat = $arrayData[2]."-".$arrayData[1]."-".$arrayData[0];
            
        return $dataSqlFormat;
    }
}
