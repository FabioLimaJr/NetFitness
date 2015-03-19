<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pagamento
 *
 * @author Daniele
 */
class Pagamento 
{
    private $idPagamento;
    private $valor;
    private $dataVencimento;
    private $dataPagamento;
    private $secretaria;
    private $aluno;
    
    function __construct($idPagamento, $valor, $dataVencimento, $dataPagamento, $secretaria, $aluno) {
        $this->idPagamento = $idPagamento;
        $this->valor = $valor;
        $this->dataVencimento = $dataVencimento;
        $this->dataPagamento = $dataPagamento;
        $this->secretaria = $secretaria;
        $this->aluno = $aluno;
    }

    
    function getIdPagamento() {
        return $this->idPagamento;
    }

    function getValor() {
        return $this->valor;
    }

    function getDataVencimento() {
        return $this->dataVencimento;
    }

    function getDataPagamento() {
        return $this->dataPagamento;
    }

    function getSecretaria() {
        return $this->secretaria;
    }

    function getAluno() {
        return $this->aluno;
    }

    function setIdPagamento($idPagamento) {
        $this->idPagamento = $idPagamento;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setDataVencimento($dataVencimento) {
        $this->dataVencimento = $dataVencimento;
    }

    function setDataPagamento($dataPagamento) {
        $this->dataPagamento = $dataPagamento;
    }

    function setSecretaria($secretaria) {
        $this->secretaria = $secretaria;
    }

    function setAluno($aluno) {
        $this->aluno = $aluno;
    }


}
