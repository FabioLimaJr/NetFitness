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
    private $idPagameto;
    private $valor;
    private $dataVencimento;
    private $dataPagamento;
    private $secretaria;
    private $aluno;
    
    function __construct($idPagameto, $valor, $dataVencimento, $dataPagamento, $secretaria, $aluno) {
        $this->idPagameto = $idPagameto;
        $this->valor = $valor;
        $this->dataVencimento = $dataVencimento;
        $this->dataPagamento = $dataPagamento;
        $this->secretaria = $secretaria;
        $this->aluno = $aluno;
    }

    
    function getIdPagameto() {
        return $this->idPagameto;
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

    function setIdPagameto($idPagameto) {
        $this->idPagameto = $idPagameto;
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
