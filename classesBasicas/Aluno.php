<?php

/**
 * Description of Aluno
 *
 * @author Daniele
 */
class Aluno extends Pessoa
{
    private $idAluno;
    private $sexo;
    private $opiniao;
    private $secretaria;
    private $musica;
    private $dieta;
    private $listaPagamentos;
    private $listaTreinos; 
 
    
    public function __construct($idAluno, $nome, $cpf, $endereco, $senha, $telefone, $login, $email, $sexo, $opiniao, $secretaria) 
    {
        parent::__construct($idAluno, $nome, $cpf, $endereco, $senha, $telefone, $login, $email);
        
        $this->setIdAluno($idAluno);
        $this->setSexo($sexo);
        $this->setOpiniao($opiniao);
        $this->setSecretaria($secretaria);
        
    }
    
    
    function getIdAluno() {
        return $this->idAluno;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getOpiniao() {
        return $this->opiniao;
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

    function setOpiniao($opiniao) {
        $this->opiniao = $opiniao;
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
