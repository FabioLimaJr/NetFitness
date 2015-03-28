<?php
/**
 * Description of Nutricionista
 *
 * @author Erick
 */
class Nutricionista extends Pessoa {
    
    private $idNutricionista;
    private $coordenador;
    private $crn;
    private $listaDietas;
    private $listaDicas;

    public function __construct() 
    {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }
    
    
    function __construct1($idNutricionista)
    {
        parent::__construct($idNutricionista);
        $this->setIdNutricionista($idNutricionista);
    }
    
    
    function __construct12($idNutricionista, $coordenador, $crn, $listaDietas, $listaDicas, 
                         $nome, $cpf, $endereco, $senha, $telefone, $email, $login) 
    {
        parent::__construct($idNutricionista, $nome, $cpf, $endereco, $senha, $telefone, $login, $email);
       
        $this->setIdNutricionista($idNutricionista);
        $this->setCoordenador($coordenador);
        $this->setCrn($crn);
        $this->setListaDietas($listaDietas);
        $this->setListaDicas($listaDicas);
    }
    
    function getIdNutricionista() {
        return $this->idNutricionista;
    }
    function getCoordenador() {
        return $this->coordenador;
    }
    function getCrn() {
        return $this->crn;
    }
    function getListaDietas() {
        return $this->listaDietas;
    }
    function getListaDicas() {
        return $this->listaDicas;
    }
    function setIdNutricionista($idNutricionista) {
        $this->idNutricionista = $idNutricionista;
    }
    function setCoordenador($coordenador) {
        $this->coordenador = $coordenador;
    }
    function setCrn($crn) {
        $this->crn = $crn;
    }
    function setListaDietas($listaDietas) {
        $this->listaDietas = $listaDietas;
    }
    function setListaDicas($listaDicas) {
        $this->listaDicas = $listaDicas;
    }
}