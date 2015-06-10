<?php
/**
 * Description of RepositorioAlimento
 *
 * @author Marcelo
 */

include($serverPath.'interfaceRepositorio/IRepositorioAlimento.php');
include_once($serverPath.'excecoes/Excecoes.php');
include_once($serverPath.'conexao/Conexao.php');

class RepositorioAlimento extends RepositorioGenerico implements IRepositorioAlimento {
    
    function __construct() {
        parent::__construct();
    }
   
    public function inserir($alimento) {
        
        $sql = " USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){

            $sql = "INSERT INTO alimento VALUES(";
            $sql.= "NULL,'";
            $sql.= $alimento->getDescricao(). "','";
            $sql.= $alimento->getCaloria(). "','";
            $sql.= $alimento->getProteina(). "','";
            $sql.= $alimento->getCarboidrato(). "','";
            $sql.= $alimento->getGordura(). "','";
            $sql.= $alimento->getNutricionista()->getIdNutricionista(). "')";
            
            
            
            if(mysqli_query($this->getConexao(), $sql)){
                //$this->fecharConexao();
            }else{
                throw new Exception(Excecoes::inserirObjeto("Alimento: ". mysqli_error($this->getConexao())));
            }
            
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->erro.")"));
        }
    }
    
    public function alterar($alimento) {
        
        $sql = " USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){

            $sql = "UPDATE alimento SET descricao = '".$alimento->getDescricao();
            $sql.= "', caloria = '".$alimento->getCaloria();
            $sql.= "', proteina = '".$alimento->getProteina();
            $sql.= "', carboidrato = '".$alimento->getCarboidrato();
            $sql.= "', gordura = '".$alimento->getGordura();
            $sql.= "'  WHERE IdAlimento = '".$alimento->getIdAlimento()."'";
            
            if(mysqli_query($this->getConexao(), $sql)){
                //$this->fecharConexao();
            }else{
                throw new Exception(Excecoes::alterarObjeto("Alimento: ". mysqli_error($this->getConexao())));
            }
            
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->erro.")"));
        }
    }

    public function excluir($alimento) {
        
        $sql = "USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){
            
            $sql = "DELETE FROM alimento WHERE IdAlimento = '".$alimento->getIdAlimento()."'";
            
            if(mysqli_query($this->getConexao(), $sql)){
                //$this->fecharConexao();
            }else {
                throw new Exception(Excecoes::excluirObjeto("Alimento: ". mysqli_error($this->getConexao())));
            }
            
        }  else {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->erro.")"));
        }
    }

    public function listar($fetchType) {
        
        $listaAlimentos = array();
        
        $sql = "USE ". $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){
            
            $sqlListaAlimentos = "SELECT * FROM alimento";
            $resultListaAlimentos =  mysqli_query($this->getConexao(), $sqlListaAlimentos);
            try
            {
                while ($rowListaAlimentos = mysqli_fetch_array($resultListaAlimentos))
                {

                    $alimento = new Alimento($rowListaAlimentos['idAlimento']);   
                    
                    if($fetchType === EAGER)
                    {                      
                        $alimentoRetornado = $this->detalhar($alimento, EAGER);    
                    }
                    else 
                    {
                       $alimentoRetornado = $this->detalhar($alimento, LAZY);
                    }

                    array_push($listaAlimentos, $alimentoRetornado);            
                }
                
                return $listaAlimentos;
            }
            catch(Exception $exc)
            {
                throw new Exception($exc->getMessage());
            }
            
            return($listaAlimentos);          
        }
        else
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error).")");
        }
    }
    
    public function detalhar($alimento,$fetchType) 
    {
      
        $sql = "USE " . $this->getNomeBanco();
 
        if($this->getConexao()->query($sql) === TRUE)
        {
            $sqlAlimento = "SELECT * FROM alimento WHERE idAlimento = '".$alimento->getIdAlimento()."'";
         
            try
            {
                $resultAlimento = mysqli_query($this->getConexao(), $sqlAlimento);
                
                $rowAlimento = mysqli_fetch_assoc($resultAlimento);
                $alimentoRetornado = new Alimento($rowAlimento['idAlimento'], $rowAlimento['descricao'], 
                                                  $rowAlimento['caloria'], $rowAlimento['proteina'],
                                                  $rowAlimento['carboidrato'], $rowAlimento['gordura'],
                                                  null/*nutricionista*/);             
            }
            catch(Exception $exc)
            {
                throw new Exception($exc->getMessage());
            }
            
            if($fetchType === EAGER)
            {
                //Nutricionista
                $alimentoRetornado->setNutricionista($this->detalharObjeto(new Nutricionista($rowAlimento['idNutricionista']), LAZY));
               
            }
          
            return $alimentoRetornado;
       }
       else
       {
           throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
       }
   }
}
