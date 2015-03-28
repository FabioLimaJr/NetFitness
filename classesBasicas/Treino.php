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
    
    
    public function __construct() 
    {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }
    
    function __construct1($idTreino) 
    {
        $this->setIdTreino($idTreino);
    }
    
    function __construct4($idTreino, $nome, $descricao, $instrutor) {
        $this->setIdTreino($idTreino);
        $this->setNome($nome);
        $this->setDescricao($descricao);
        $this->setInstrutor($instrutor);
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
