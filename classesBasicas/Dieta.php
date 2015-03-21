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
    
    function __construct($idDieta, $descricao, $listaAlimentos, $nutricionista, $aluno) {
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
