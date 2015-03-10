<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Musica
 *
 * @author Daniele
 */
class Musica 
{
    private $idMusica;
    private $titulo;
    private $secretaria;
    
    function __construct($idMusica, $titulo, $secretaria) {
        $this->idMusica = $idMusica;
        $this->titulo = $titulo;
        $this->secretaria = $secretaria;
    }

    
    function getIdMusica() {
        return $this->idMusica;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getSecretaria() {
        return $this->secretaria;
    }

    function setIdMusica($idMusica) {
        $this->idMusica = $idMusica;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setSecretaria($secretaria) {
        $this->secretaria = $secretaria;
    }


}
