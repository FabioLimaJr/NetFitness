<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dieta
 *
 * @author Daniele
 */
class Dieta 
{
    private $idDieta;
    private $descricao;
    private $listaAlimentos;
    private $nutricionista;
    private $aluno;
    
    public function __construct() 
    {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }
    
    function __construct1($idDieta)
    {
        $this->setIdDieta($idDieta);
    }
    
    function __construct5($idDieta, $descricao, $listaAlimentos, $nutricionista, $aluno) {
        $this->idDieta = $idDieta;
        $this->descricao = $descricao;
        $this->listaAlimentos = $listaAlimentos;
        $this->nutricionista = $nutricionista;
        $this->aluno = $aluno;
    }
    
    
    function getIdDieta() {
        return $this->idDieta;
    }

    function getDescricao() {
        return $this->descricao;
    }
    
    function getListaAlimentos()
    {
        return $this->listaAlimentos;
    }

    function setListaAlimentos($listaAlimentos)
    {
        $this->listaAlimentos = $listaAlimentos;
    }

    
    function getNutricionista() {
        return $this->nutricionista;
    }

    function getAluno() {
        return $this->aluno;
    }

    function setIdDieta($idDieta) {
        $this->idDieta = $idDieta;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setNutricionista($nutricionista) {
        $this->nutricionista = $nutricionista;
    }

    function setAluno($aluno) {
        $this->aluno = $aluno;
    }


}
