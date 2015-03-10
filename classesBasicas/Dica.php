<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dica
 *
 * @author Daniele
 */
class Dica 
{
    private $idDica;
    private $descricao;
    private $titulo;
    
    function __construct($idDica, $descricao, $titulo) {
        $this->idDica = $idDica;
        $this->descricao = $descricao;
        $this->titulo = $titulo;
    }

    
    function getIdDica() {
        return $this->idDica;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function setIdDica($idDica) {
        $this->idDica = $idDica;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }


}
