<?php
/**
 * Description of RepositorioAlimento
 *
 * @author Marcelo
 */

include($serverPath.'interfaceRepositorio/IRepositorioAlimento.php');
include_once($serverPath.'excecoes/Excecoes.php');
include_once($serverPath.'conexao/Conexao.php');

class RepositorioAlimento extends Conexao implements IRepositorioAlimento {
    
    function __construct() {
        parent::__construct();
    }
    
    public function inserir($alimento) {
        
        $sql = " USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){

            $sql = "INSERT INTO alimento VALUES('";
            $sql.= "NULL','";
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

    public function listar() {
        
        $listaAlimentos = array();
        
        $sql = "USE ". $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){
            
            $sql = "SELECT * FROM alimento";
            $result =  mysqli_query($this->getConexao(), $sql);
            
             while ($row = mysqli_fetch_array($result)){
    
              $alimento = new Alimento($row['idAlimento'], $row['descricao'], $row['caloria'],
                                       $row['proteina'], $row['carboidrato'], $row['gordura'], 
                                       null/*nutricionista*/);                
                
                $sql2 = "SELECT * FROM  pessoa,nutricionista WHERE pessoa.idPessoa = nutricionista.idNutricionista AND idPessoa = '".$row['idNutricionista']."'";
                $result2 = mysqli_query($this->getConexao(), $sql2); 
                $row2 = mysqli_fetch_assoc($result2);
                
                $nutricionista = new Nutricionista($row['idNutricionista'], null/*$coordenador*/, $row2['crn'], 
                                                   null/*$listaDietas*/, null/*$listaDicas*/, $row2['nome'], $row2['cpf'], 
                                                   $row2['endereco'], $row2['senha'], $row2['telefone'], 
                                                   $row2['email'], $row2['login']);
                
                $alimento->setNutricionista($nutricionista);
                
                array_push($listaAlimentos, $alimento);
                
            }
            return($listaAlimentos);
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error).")");
         }
    }
    
   public function detalhar($alimento) {
      
       $sql = "USE " . $this->getNomeBanco();
 
       if($this->getConexao()->query($sql) === TRUE)
       {
           $sql = "SELECT * FROM alimento WHERE idAlimento = '".$alimento->getIdAlimento().
                   "' AND idNutricionista = '".$alimento->getNutricionista()->getIdPessoa()."'";
          
           $result = mysqli_query($this->getConexao(), $sql);
          
           while ($row = mysqli_fetch_array($result))
           {
            
               $alimentoRetornado = new Alimento($row['idAlimento'], $row['descricao'], $row['caloria'], $row['proteina'],
                       $row['carboidrato'], $row['gordura'], null);
           }
          
             $repositorioNutricionista = new RepositorioNutricionista();
             $nutricionista = $repositorioNutricionista->detalhar(new Nutricionista($alimento->getNutricionista()->getIdPessoa()));
          
            
             $alimentoRetornado->setNutricionista($nutricionista);
            
            //$this->fecharConexao();
          
           return $alimentoRetornado;
       }
       else
       {
           throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
       }
   }
}
