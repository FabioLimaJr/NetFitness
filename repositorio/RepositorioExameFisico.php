<?php

/**
 * Description of RepositorioExameFisico
 *
 * @author Daniele
 */

include($serverPath.'interfaceRepositorio/IRepositorioExameFisico.php');
include_once($serverPath.'excecoes/Excecoes.php');
include_once($serverPath.'conexao/Conexao.php');


class RepositorioExameFisico extends Conexao implements IRepositorioExameFisico
{
    
    function __construct()
    {
        parent::__construct(); 
    }
       
    public function inserir($exameFisico)
    {
        $sql = "USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){
            
            $arrayData = explode("-", $exameFisico->getData());
            $dataSqlFormat = $arrayData[2]."-".$arrayData[1]."-".$arrayData[0];
            
            $sql = "INSERT INTO examefisico VALUES(NULL,'";
            $sql.= $dataSqlFormat."','";
            $sql.= $exameFisico->getDescricao(). "','";
            $sql.= $exameFisico->getAluno()->getIdPessoa(). "','";
            $sql.= $exameFisico->getInstrutor()->getIdPessoa(). "')";
            
            if(mysqli_query($this->getConexao(), $sql))
            {
                
                $this->fecharConexao();
               
            }
            else
            {
                throw new Exception(Excecoes::inserirObjeto("ExameFisico: ".  mysqli_error($this->getConexao())));
            }
            
        }  else {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->error.")"));
        }
    }
 
    public function alterar($exameFisico)
    {
        
    }

    public function detalhar($exameFisico)
    {
        
    }

    public function excluir($exameFisico)
    {
        
    }

    public function listar()
    {
        
    }
    
}
