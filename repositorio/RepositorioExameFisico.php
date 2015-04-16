<?php

/**
 * Description of RepositorioExameFisico
 *
 * @author Daniele
 */

include($serverPath.'interfaceRepositorio/IRepositorioExameFisico.php');
include_once($serverPath.'excecoes/Excecoes.php');
include_once($serverPath.'conexao/Conexao.php');


class RepositorioExameFisico extends RepositorioGenerico implements IRepositorioExameFisico
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
                
                //$this->fecharConexao();
               
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

    public function excluir($exameFisico)
    {
        
    }
    
    public function detalhar($exameFisico, $fetchType)
    {
        $sqlExameFisico = "USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sqlExameFisico) === true)
        { 
            $sqlExameFisico = "SELECT * FROM examefisico WHERE idExameFisico = '".$exameFisico->getIdExameFisico()."'";             
            
            try
            {
                $resultExameFisico = mysqli_query($this->getConexao(), $sqlExameFisico);
                $rowExameFisico = mysqli_fetch_assoc($resultExameFisico);

                $exameFisicoRetornado = new ExameFisico($rowExameFisico['idExameFisico'],$rowExameFisico['data'],
                                                        $rowExameFisico['descricao'], null/*aluno*/,  null/*instrutor*/);
                                                        
            }
            catch (Exception $exc)
            {
                throw new Exception($exc->getMessage());
            }
          
            if($fetchType === EAGER)
            {
               try
               {    
                    //Instrutor
                    $exameFisicoRetornado->setInstrutor($this->detalharObjeto(new Instrutor($rowExameFisico['idInstrutor']), LAZY));
 
                    //Aluno
                    $exameFisicoRetornado->setAluno($this->detalharObjeto(new Aluno($rowExameFisico['idAluno']), LAZY));
                             
                }
                catch (Exception $exc)
                {
                    throw new Exception($exc->getMessage());
                }
            }    
          
            return $exameFisicoRetornado;
        }
        else 
        {
          
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->error.")"));
        }
    }

    public function listar($fetchType)
    {
        $sql = "USE " . $this->getNomeBanco();   
        $listaExamesFisicos = array();
        
        if($this->getConexao()->query($sql) === TRUE)
        {         
            $sqlListaExamesFisicos = "SELECT * FROM examefisico";
            
            try
            {
                $resultListaExamesFisicos = mysqli_query($this->getConexao(), $sqlListaExamesFisicos);

                while ($rowListaExamesFisicos = mysqli_fetch_array($resultListaExamesFisicos)) 
                {

                    $exameFisicoRetornado = new ExameFisico($rowListaExamesFisicos['idExameFisico']);               

                    if($fetchType === EAGER)
                    {                
                        $exameFisicoRetornado = $this->detalhar($exameFisicoRetornado, EAGER);
                    }
                    else
                    {
                        $exameFisicoRetornado = $this->detalhar($exameFisicoRetornado, LAZY);
                    }

                    array_push($listaExamesFisicos, $exameFisicoRetornado);

                }
            }
            catch (Exception $exc)
            {
                throw new Exception($exc->getMessage());
            }
            
            return($listaExamesFisicos);        
          
         }
         else 
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }
    
}
