<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Secretaria
 *
 * @author Igor
 */

include_once('Pessoa.php');

class Secretaria extends Pessoa{
    //put your code here
    
    private $idSecretaria;
    private $coordenador;
    
    
    public function __construct() 
    {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }
    
    function __construct1($idSecretaria) 
    {
        
        parent::__construct($idSecretaria);
        
    }
    
    function __construct9($idSecretaria, $nome, $cpf, $endereco, $senha, $telefone, $login, $email, $coordenador) {
        
        parent::__construct($idSecretaria, $nome, $cpf, $endereco, $senha, $telefone, $login, $email);
        $this->setCoordenador($coordenador);
        $this->setIdSecretaria($idSecretaria);
        
    }
    
    public function getCoordenador(){
        return $this->coordenador;
    }
    
    public function setCoordenador($coordenador){
        $this->coordenador = $coordenador;
    }
    
    function getIdSecretaria() {
        return $this->idSecretaria;
    }

    function setIdSecretaria($idSecretaria) {
        $this->idSecretaria = $idSecretaria;
    }


}
