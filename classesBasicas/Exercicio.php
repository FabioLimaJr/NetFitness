<?php

/**
 * Description of Exercicio
 *
 * @author Marcelo
 */
class Exercicio implements JsonSerializable{
    //put your code here
    
    private $idExercicio;
    private $nome;
    private $musculo;
    private $descricao;
    private $series;
    private $repeticoes;
    
    
    public function __construct() 
    {
        $get_arguments = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }
    
    function __construct1($idExercicio)
    {
        $this->setIdExercicio($idExercicio);
    }
            
    function __construct4($idExercicio, $nome, $musculo, $descricao) {
        $this->idExercicio = $idExercicio;
        $this->nome = $nome;
        $this->musculo = $musculo;
        $this->descricao = $descricao;
    }

    function getIdExercicio() {
        return $this->idExercicio;
    }

    function getNome() {
        return $this->nome;
    }

    function getMusculo() {
        return $this->musculo;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setIdExercicio($idExercicio) {
        $this->idExercicio = $idExercicio;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setMusculo($musculo) {
        $this->musculo = $musculo;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function getSeries() {
        return $this->series;
    }

    function getRepeticoes() {
        return $this->repeticoes;
    }

    function setSeries($series) {
        $this->series = $series;
    }

    function setRepeticoes($repeticoes) {
        $this->repeticoes = $repeticoes;
    }

    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        return $vars;
    }

}
