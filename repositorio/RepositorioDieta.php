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
        $sql = "USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true)
        {
            
            $id = $dieta->getIdDieta();
            
            $sql = "DELETE FROM dieta where idDieta = '".$id."'";
            
            if(mysqli_query($this->getConexao(), $sql))
            {               
                $this->fecharConexao();
            }
            else
            {
                throw new Exception(Excecoes::inserirObjeto("Dieta: ".  mysqli_error($this->getConexao())));
            }
            
        }  
        else 
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->error.")"));
        }
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

    public function listar($nutricionista) 
    {
        $listaDietas = array();
        
        $sql = "USE " . $this->getNomeBanco();
    
        
        if($this->getConexao()->query($sql) === TRUE)
        {
        
            
            $sql = "SELECT * FROM dieta WHERE idNutricionista ='".$nutricionista->getIdNutricionista()."'";
            //$sql = "SELECT * FROM dieta";
            $result = mysqli_query($this->getConexao(), $sql);
            
            while ($row = mysqli_fetch_array($result)) 
            {
              
                $dieta = new Dieta($row['idDieta'], $row['descricao'], null/*$listaAlimentos*/, null/*$nutricionista*/, null/*$aluno*/);
                
                $repositorioNutricionista = new RepositorioNutricionista;
                $nutricionista = new Nutricionista($row['idNutricionista']);
                $nutricionistaRetornado = $repositorioNutricionista->detalhar($nutricionista);
                
                $repositorioAluno = new RepositorioAluno;
                $aluno = new Aluno($row['idAluno']);
                $alunoRetornado = $repositorioAluno->detalhar($aluno);
                
                $dieta->setAluno($alunoRetornado);
                $dieta->setNutricionista($nutricionistaRetornado);
                
                //falta incluir a lista de alimentos (esperando que seja implementada detalharAlimento)
                //ler de alimentodieta os alimentos incluidos e, por cada um chamar o detalharAlimento
                
                array_push($listaDietas, $dieta);
                
            }
            
            return($listaDietas);        
          
         }
         else 
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }

}
