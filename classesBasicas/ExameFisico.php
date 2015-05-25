<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExameFisico
 *
 * @author Daniele
 */
class ExameFisico implements JsonSerializable
{
    private $idExameFisico;
    private $data;
    private $descricao;
    private $imc;
    private $altura;
    private $peso;
    private $circTorax;
    private $circAbdomen;
    private $circBraco;
    private $circAntebraco;
    private $circCoxa;
    private $circPanturrilha;
    private $aluno;
    private $instrutor;
    
   
    
    public function __construct() 
    {
        $get_arguments = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }
    
      
    
    function __construct1($idExameFisico)
    {
        $this->setIdExameFisico($idExameFisico);
    }
            
    function __construct5($idExameFisico, $data, $descricao, $aluno, $instrutor) {
        $this->idExameFisico = $idExameFisico;
        $this->data = $data;
        $this->descricao = $descricao;
        $this->aluno = $aluno;
        $this->instrutor = $instrutor;
    }
    
    function __construct14($idExameFisico, $data, $descricao, $imc, $altura, $peso, $circTorax, $circAbdomen, $circBraco, $circAntebraco, $circCoxa, $circPanturrilha, $aluno, $instrutor)
   {
       $this->idExameFisico = $idExameFisico;
       $this->data = $data;
       $this->descricao = $descricao;
       $this->imc = $imc;
       $this->altura = $altura;
       $this->peso = $peso;
       $this->circTorax = $circTorax;
       $this->circAbdomen = $circAbdomen;
       $this->circBraco = $circBraco;
       $this->circAntebraco = $circAntebraco;
       $this->circCoxa = $circCoxa;
       $this->circPanturrilha = $circPanturrilha;
       $this->aluno = $aluno;
       $this->instrutor = $instrutor;
   }

    
    function getIdExameFisico() {
        return $this->idExameFisico;
    }

    function getData() {
        return $this->data;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getAluno() {
        return $this->aluno;
    }

    function getInstrutor() {
        return $this->instrutor;
    }

    function setIdExameFisico($idExameFisico) {
        $this->idExameFisico = $idExameFisico;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setAluno($aluno) {
        $this->aluno = $aluno;
    }

    function setInstrutor($instrutor) {
        $this->instrutor = $instrutor;
    }
    
    function getImc()
    {
        return $this->imc;
    }

    function getAltura()
    {
        return $this->altura;
    }

    function getPeso()
    {
        return $this->peso;
    }

    function getCircTorax()
    {
        return $this->circTorax;
    }

    function getCircAbdomen()
    {
        return $this->circAbdomen;
    }

    function getCircBraco()
    {
        return $this->circBraco;
    }

    function getCircAntebraco()
    {
        return $this->circAntebraco;
    }

    function getCircCoxa()
    {
        return $this->circCoxa;
    }

    function getCircPanturrilha()
    {
        return $this->circPanturrilha;
    }

    function setImc($imc)
    {
        $this->imc = $imc;
    }

    function setAltura($altura)
    {
        $this->altura = $altura;
    }

    function setPeso($peso)
    {
        $this->peso = $peso;
    }

    function setCircTorax($circTorax)
    {
        $this->circTorax = $circTorax;
    }

    function setCircAbdomen($circAbdomen)
    {
        $this->circAbdomen = $circAbdomen;
    }

    function setCircBraco($circBraco)
    {
        $this->circBraco = $circBraco;
    }

    function setCircAntebraco($circAntebraco)
    {
        $this->circAntebraco = $circAntebraco;
    }

    function setCircCoxa($circCoxa)
    {
        $this->circCoxa = $circCoxa;
    }

    function setCircPanturrilha($circPanturrilha)
    {
        $this->circPanturrilha = $circPanturrilha;
    }

    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        return $vars;
    }

}
