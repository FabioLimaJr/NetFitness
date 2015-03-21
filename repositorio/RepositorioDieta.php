<?php

/**
 * Description of RepositorioDieta
 *
 * @author Daniele
 */

include($serverPath.'interfaceRepositorio/IRepositorioDieta.php');
include_once($serverPath.'excecoes/Excecoes.php');
include_once($serverPath.'conexao/Conexao.php');

class RepositorioDieta extends Conexao implements IRepositorioDieta
{
    function __construct()
    {
        parent::__construct(); 
    }

    
    public function alterar($dieta) 
    {
        
    }

    public function detalhar($dieta) 
    {
        
    }

    public function excluir($dieta) 
    {
        
    }

    public function inserir($dieta) 
    {
        //$this->getConexao()->autocommit(FALSE);
        
        $sql = "USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){
            
            $sql = "INSERT INTO dieta VALUES(NULL,'";
            $sql.= $dieta->getDescricao(). "','";
            $sql.= $dieta->getAluno()->getIdAluno(). "','";
            $sql.= $dieta->getNutricionista()->getIdNutricionista(). "')";
            
            if(mysqli_query($this->getConexao(), $sql))
            {
                $idDieta = $this->getConexao()->insert_id;
                
                foreach($dieta->getListaAlimentos() as $alimento)
                {
                    $sql2 = "INSERT INTO dietaalimento VALUES('";
                    $sql2.= $idDieta."','";
                    $sql2.= $alimento->getIdAlimento()."')";
                    
                    if(!mysqli_query($this->getConexao(), $sql2))
                    {
                        //remover dieta inserida e os elementos de deitaalimento jà inseridos 
                        //ou usar autocommit false(preferido) e fazer o commit final
                        
                        $this->fecharConexao();
                        throw new Exception(Excecoes::inserirObjeto("Dieta: ".  mysqli_error($this->getConexao())));
                    }
                }
                
                $this->fecharConexao();
               
            }
            else
            {
                throw new Exception(Excecoes::inserirObjeto("Dieta: ".  mysqli_error($this->getConexao())));
            }
            
        }  else {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->error.")"));
        }
    }

    public function listar() 
    {
        
    }

}
