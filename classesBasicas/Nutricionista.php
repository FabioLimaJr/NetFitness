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

    function __construct($idNutricionista, $coordenador, $crn, $listaDietas, $listaDicas, 
                         $nome, $cpf, $endereco, $senha, $telefone, $email, $login) 
    {
        parent::__construct($idNutricionista, $nome, $cpf, $endereco, $senha, $telefone, $email, $login);
       
        $this->idNutricionista = $idNutricionista;
        $this->coordenador = $coordenador;
        $this->crn = $crn;
        $this->listaDietas = $listaDietas;
        $this->listaDicas = $listaDicas;
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
    function setDietas($listaDietas) {
        $this->listaDietas = $listaDietas;
    }
    function setListaDicas($listaDicas) {
        $this->listaDicas = $listaDicas;
    }
}