<?php

/**
 * Description of Exercicio
 *
 * @author Marcelo
 */
class Exercicio {
    //put your code here
    
    private $idExercicio;
    private $nome;
    private $musculo;
    private $descricao;
    
    function __construct($idExercicio, $nome, $musculo, $descricao) {
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


}
