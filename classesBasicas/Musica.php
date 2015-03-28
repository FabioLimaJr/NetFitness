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
    
    public function __construct() 
    {
        $get_arguments = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }
    
    function __construct1($idMusica) 
    {
        $this->setIdMusica($idMusica);
    }
    
    function __construct3($idMusica, $titulo, $secretaria) {
        $this->setIdMusica($idMusica);
        $this->setTitulo($titulo);
        $this->setSecretaria($secretaria);
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
