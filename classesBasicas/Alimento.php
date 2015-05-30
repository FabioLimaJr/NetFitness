<?php
/**
 * Description of Alimento
 *
 * @author Marcelo
 */
class Alimento {
    
    private $idAlimento;
    private $descricao;
    private $caloria;
    private $proteina;
    private $carboidrato;
    private $gordura;
    private $qtdAlimento;
    private $nutricionista;
    
    public function __construct() 
    {
        $get_arguments = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }
    
    
    function __construct1($idAlimento)
    {
        $this->setIdAlimento($idAlimento);
    }
    
    function __construct7($idAlimento,$descricao, $caloria, $proteina, $carboidrato, $gordura, $nutricionista) {
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
    
    function getQtdAlimento() {
        return $this->qtdAlimento;
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

    function setQtdAlimento($qtdAlimento) {
        $this->qtdAlimento = $qtdAlimento;
    }
    
    function setNutricionista($nutricionista) {
        $this->nutricionista = $nutricionista;
    }
}
