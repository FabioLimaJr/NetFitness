<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExameFisico
 *
 * @author Daniele
 */
class ExameFisico 
{
    private $idExameFisico;
    private $data;
    private $descricao;
    private $aluno;
    private $instrutor;
    
    public function __construct() 
    {
        $get_arguments = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }
    
    function __construct5($idExameFisico, $data, $descricao, $aluno, $instrutor) {
        $this->idExameFisico = $idExameFisico;
        $this->data = $data;
        $this->descricao = $descricao;
        $this->aluno = $aluno;
        $this->instrutor = $instrutor;
    }

    
    function getIdExameFisico() {
        return $this->idExameFisico;
    }

    function getData() {
        return $this->data;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getAluno() {
        return $this->aluno;
    }

    function getInstrutor() {
        return $this->instrutor;
    }

    function setIdExameFisico($idExameFisico) {
        $this->idExameFisico = $idExameFisico;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setAluno($aluno) {
        $this->aluno = $aluno;
    }

    function setInstrutor($instrutor) {
        $this->instrutor = $instrutor;
    }


    
}
