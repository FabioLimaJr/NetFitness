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
    
    public function __construct() 
    {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }
    
    function __construct1($idPagamento) 
    {
        $this->setIdPagamento($idPagamento);
       
    }
    
    function __construct6($idPagamento, $valor, $dataVencimento, $dataPagamento, $secretaria, $aluno) {
        $this->setIdPagamento($idPagamento);
        $this->setValor($valor);
        $this->setDataVencimento($dataVencimento);
        $this->setDataPagamento($dataPagamento);
        $this->setSecretaria($secretaria);
        $this->setAluno($aluno);
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
