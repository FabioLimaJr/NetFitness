<?php

/**
 * Description of RepositorioDieta
 *
 * @author Daniele
 */

include($serverPath.'interfaceRepositorio/IRepositorioDieta.php');
include_once($serverPath.'excecoes/Excecoes.php');
include_once($serverPath.'conexao/Conexao.php');

class RepositorioDieta extends RepositorioGenerico implements IRepositorioDieta
{
    function __construct()
    {
        parent::__construct(); 
    }
      
    public function alterar($dieta) 
    {
        $sql = "USE " . $this->getNomeBanco();
        $idDieta = $dieta->getIdDieta();
        $descricaoDieta = $dieta->getDescricao();
        
        if($this->getConexao()->query($sql) === true)
        {
            
            $sql = "UPDATE dieta SET descricao='".$descricaoDieta."' WHERE idDieta ='".$idDieta."'";;        
            
            if(mysqli_query($this->getConexao(), $sql))
            {
                
                $sql2 = "DELETE FROM dietaalimento WHERE idDieta ='".$idDieta."'";
                
                if(mysqli_query($this->getConexao(), $sql2))
                {
                
                    foreach($dieta->getListaAlimentos() as $alimento)
                    {
                        $sql3 = "INSERT INTO dietaalimento VALUES('";
                        $sql3.= $idDieta."','";
                        $sql3.= $alimento->getIdAlimento()."','";
                        $sql3.= $alimento->getQtdAlimento()."')";

                        if(!mysqli_query($this->getConexao(), $sql3))
                        {
                            //remover dieta inserida e os elementos de deitaalimento jà inseridos 
                            //ou usar autocommit false(preferido) e fazer o commit final

                            //$this->fecharConexao();
                            throw new Exception(Excecoes::inserirObjeto("Dieta: ".  mysqli_error($this->getConexao())));
                        }
                    }
                }
                else
                {
                   // $this->fecharConexao();
                   throw new Exception(Excecoes::alterarObjeto("Dieta: ".  mysqli_error($this->getConexao()))); 
                }
                
               // $this->fecharConexao();
               
            }
            else
            {
                //$this->fecharConexao();
                throw new Exception(Excecoes::inserirObjeto("Dieta: ".  mysqli_error($this->getConexao())));
            }
            
        }  else {
           // $this->fecharConexao();
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->error.")"));
        }
    }

    public function detalhar($dieta,$fetchType) 
    {
        $sqlDieta = "USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sqlDieta) === true)
        { 
            $sqlDieta = "SELECT * FROM dieta WHERE idDieta = '".$dieta->getIdDieta()."'";             
            
            try
            {
                $resultDieta = mysqli_query($this->getConexao(), $sqlDieta);
                $rowDieta = mysqli_fetch_assoc($resultDieta);

                $dietaRetornada = new Dieta($rowDieta['idDieta'], $rowDieta['descricao'], 
                                            null/*$listaAlimentos*/, null/*$nutricionista*/, null/*$aluno*/);
            }
            catch (Exception $exc)
            {
                throw new Exception($exc->getMessage());
            }
          
            if($fetchType === EAGER)
            {
               try
               {              
                    $listaAlimentosRetornados = array();

                    $sqlDietaAlimento = "SELECT * FROM dietaalimento WHERE idDieta = '".$dieta->getIdDieta()."'";
                    $resultDietaAlimento = mysqli_query($this->getConexao(), $sqlDietaAlimento);
                    
                    while ($rowDietaAlimento = mysqli_fetch_array($resultDietaAlimento)) 
                    {                     
                        $alimento = $this->detalharObjeto(new Alimento($rowDietaAlimento['idAlimento']), LAZY);
                        $alimento->setQtdAlimento($rowDietaAlimento['qtdAlimento']);
                        array_push($listaAlimentosRetornados, $alimento);
                    }
                    $dietaRetornada->setListaAlimentos($listaAlimentosRetornados);

                    //NUTRICIONISTA
                    $dietaRetornada->setNutricionista($this->detalharObjeto(new Nutricionista($rowDieta['idNutricionista']), LAZY));
 
                    //ALUNO
                    $dietaRetornada->setAluno($this->detalharObjeto(new Aluno($rowDieta['idAluno']), LAZY));
                 
                
                }
                catch (Exception $exc)
                {
                    throw new Exception($exc->getMessage());
                }
            }
            
          
            return $dietaRetornada;
        }  
        else 
        {
          
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->error.")"));
        }
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
                //$this->fecharConexao();
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
                    $sql2.= $alimento->getIdAlimento()."','";
                    $sql2.= $alimento->getQtdAlimento()."')";
                    
                    if(!mysqli_query($this->getConexao(), $sql2))
                    {
                        //remover dieta inserida e os elementos de deitaalimento jà inseridos 
                        //ou usar autocommit false(preferido) e fazer o commit final
                        
                        //$this->fecharConexao();
                        throw new Exception(Excecoes::inserirObjeto("Dieta: ".  mysqli_error($this->getConexao())));
                    }
                }
                
                //$this->fecharConexao();
               
            }
            else
            {
                throw new Exception(Excecoes::inserirObjeto("Dieta: ".  mysqli_error($this->getConexao())));
            }
            
        }  else {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->error.")"));
        }
    }

    public function listar($pessoa, $fetchType) 
    {
        $tipoUsuario = get_class($pessoa);
        $listaDietas = array();
        
        $sql = "USE " . $this->getNomeBanco();   
        
        if($this->getConexao()->query($sql) === TRUE)
        {
            
            $sql = "SELECT * FROM dieta WHERE id".$tipoUsuario." ='".$pessoa->getIdPessoa()."'";
            
            try
            {
                $result = mysqli_query($this->getConexao(), $sql);

                while ($row = mysqli_fetch_array($result)) 
                {
                    $dietaRetornada = new Dieta($row['idDieta']);               

                    if($fetchType === EAGER)
                    {                
                        $dietaRetornada = $this->detalhar($dietaRetornada, EAGER);
                    }
                    else
                    {
                        $dietaRetornada = $this->detalhar($dietaRetornada, LAZY);
                    }

                    array_push($listaDietas, $dietaRetornada);

                }
            }
            catch (Exception $exc)
            {
                throw new Exception($exc->getMessage());
            }
            
            return($listaDietas);        
          
         }
         else 
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }

}
