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
class Secretaria extends Pessoa{
    //put your code here
    
    private $idSecretaria;
    private $coordenador;
    
    public function __construct($idSecretaria, $nome, $cpf, $endereco, $senha, $telefone, $login, $email, $coordenador) {
        
        parent::__construct($idSecretaria, $nome, $cpf, $endereco, $senha, $telefone, $login, $email);
        $this->coordenador = $coordenador;
        $this->idSecretaria = $idSecretaria;
        
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
