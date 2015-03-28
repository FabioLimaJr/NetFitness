<?php

/**
 * Description of Instrutor
 *
 * @author Marcelo
 */
include_once('Pessoa.php');

class Instrutor extends Pessoa {
    
    private $idInstrutor;
    private $coordenador;
    private $listaTreinos;
    private $listaExamesFisicos;
    private $listaDicas;

    
    public function __construct() 
    {
        $get_arguments = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }
    
    function __construct1($idInstrutor)
    {
        parent::__construct($idInstrutor);
        $this->setIdInstrutor($idInstrutor);
    }
    
    function __construct12($idInstrutor, $coordenador, $listaTreinos, $listaExamesFisicos, $listaDicas, 
                         $nome, $cpf, $endereco, $senha, $telefone, $email, $login) 
    {
        parent::__construct($idInstrutor, $nome, $cpf, $endereco, $senha, $telefone, $email, $login);
       
        $this->setIdInstrutor($idInstrutor);
        $this->setCoordenador($coordenador);
        $this->setListaTreinos($listaTreinos);
        $this->setListaExamesFisicos($listaExamesFisicos);
        $this->setListaDicas($listaDicas);

    }
    
    function getIdInstrutor() {
        return $this->idInstrutor;
    }

    function getCoordenador() {
        return $this->coordenador;
    }

    function getListaTreinos() {
        return $this->listaTreinos;
    }

    function getListaExamesFisicos() {
        return $this->listaExamesFisicos;
    }

    function getListaDicas() {
        return $this->listaDicas;
    }

    function setIdInstrutor($idInstrutor) {
        $this->idInstrutor = $idInstrutor;
    }

    function setCoordenador($coordenador) {
        $this->coordenador = $coordenador;
    }

    function setListaTreinos($listaTreinos) {
        $this->listaTreinos = $listaTreinos;
    }

    function setListaExamesFisicos($listaExamesFisicos) {
        $this->listaExamesFisicos = $listaExamesFisicos;
    }

    function setListaDicas($listaDicas) {
        $this->listaDicas = $listaDicas;
    }
}
