<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Treino
 *
 * @author Marcelo
 */
class Treino 
{
    //put your code here
    private $idTreino;
    private $nome;
    private $descricao;
    private $instrutor;
    
    function __construct($idTreino, $nome, $descricao, $instrutor) {
        $this->idTreino = $idTreino;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->instrutor = $instrutor;
    }

    
    function getIdTreino() {
        return $this->idTreino;
    }

    function getNome() {
        return $this->nome;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getInstrutor() {
        return $this->instrutor;
    }

    function setIdTreino($idTreino) {
        $this->idTreino = $idTreino;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setInstrutor($instrutor) {
        $this->instrutor = $instrutor;
    }


}
