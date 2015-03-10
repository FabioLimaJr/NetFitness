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
    
    function __construct($idExameFisico, $data, $descricao, $aluno, $instrutor) {
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
