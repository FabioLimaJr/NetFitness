<?php
/**
 * Description of Alimento
 *
 * @author Daniele
 */
class Alimento 
{
    private $idAlimento;
    private $descricao;
    private $caloria;
    private $proteina;
    private $carboidrato;
    private $gordura;
    private $nutricionista;
    
    function __construct($idAlimento, $descricao, $caloria, $proteina, $carboidrato, $gordura, $nutricionista) 
    {
        $this->idAlimento = $idAlimento;
        $this->descricao = $descricao;
        $this->caloria = $caloria;
        $this->proteina = $proteina;
        $this->carboidrato = $carboidrato;
        $this->gordura = $gordura;
        $this->nutricionista = $nutricionista;
    }

    
    function getIdAlimento() {
        return $this->idAlimento;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getCaloria() {
        return $this->caloria;
    }

    function getProteina() {
        return $this->proteina;
    }

    function getCarboidrato() {
        return $this->carboidrato;
    }

    function getGordura() {
        return $this->gordura;
    }

    function getNutricionista() {
        return $this->nutricionista;
    }

    function setIdAlimento($idAlimento) {
        $this->idAlimento = $idAlimento;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setCaloria($caloria) {
        $this->caloria = $caloria;
    }

    function setProteina($proteina) {
        $this->proteina = $proteina;
    }

    function setCarboidrato($carboidrato) {
        $this->carboidrato = $carboidrato;
    }

    function setGordura($gordura) {
        $this->gordura = $gordura;
    }

    function setNutricionista($nutricionista) {
        $this->nutricionista = $nutricionista;
    }


    
}
