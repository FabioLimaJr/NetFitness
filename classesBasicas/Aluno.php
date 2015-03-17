<?php

/**
 * Description of Aluno
 *
 * @author Daniele
 */

include_once('Pessoa.php');

class Aluno extends Pessoa
{
    private $idAluno;
    private $sexo;
    private $dataNascimento;
    private $secretaria;
    private $musica;
    private $dieta;
    private $listaPagamentos;
    private $listaTreinos; 
 
    
    public function __construct($idAluno, $nome, $cpf, $endereco, $senha, $telefone, $login, $email, $sexo, $dataNascimento, $secretaria,
                                $musica, $dieta, $listaPagamentos, $listaTreinos) 
    {
        parent::__construct($idAluno, $nome, $cpf, $endereco, $senha, $telefone, $login, $email);
        
        $this->setIdAluno($idAluno);
        $this->setSexo($sexo);
        $this->setdataNascimento($dataNascimento);
        $this->setSecretaria($secretaria);
        $this->setDieta($dieta);
        $this->setMusica($musica);
        $this->setListaPagamentos($listaPagamentos);
        $this->setListaTreinos($listaTreinos);
        
    }
    
    
    function getIdAluno() {
        return $this->idAluno;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getdataNascimento() {
        return $this->dataNascimento;
    }

    function getSecretaria() {
        return $this->secretaria;
    }

    function setIdAluno($idAluno) {
        $this->idAluno = $idAluno;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setdataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    function setSecretaria($secretaria) {
        $this->secretaria = $secretaria;
    }
    
    function getMusica() {
        return $this->musica;
    }

    function getDieta() {
        return $this->dieta;
    }

    function getListaPagamentos() {
        return $this->listaPagamentos;
    }

    function getListaTreinos() {
        return $this->listaTreinos;
    }

    function setMusica($musica) {
        $this->musica = $musica;
    }

    function setDieta($dieta) {
        $this->dieta = $dieta;
    }

    function setListaPagamentos($listaPagamentos) {
        $this->listaPagamentos = $listaPagamentos;
    }

    function setListaTreinos($listaTreinos) {
        $this->listaTreinos = $listaTreinos;
    }



}
