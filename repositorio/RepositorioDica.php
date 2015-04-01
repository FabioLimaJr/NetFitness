<?php
/**
 * Description of RepositorioDica
 *
 * @author Marcelo
 */

include($serverPath.'interfaceRepositorio/IRepositorioDica.php');
include_once($serverPath.'excecoes/Excecoes.php');
include_once($serverPath.'conexao/Conexao.php');

class RepositorioDica extends Conexao implements IRepositorioDica{
   
    function __construct() {
        parent::__construct();
    }
    
    public function inserir($dica) {
        
        $sql = " USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){

            $sql = "INSERT INTO dica VALUES('";
            $sql.= "NULL','";
            $sql.= $dica->getDescricao(). "','";
            $sql.= $dica->getTitulo(). "')";
            
            if(mysqli_query($this->getConexao(), $sql)){
                $this->fecharConexao();
            }else{
                throw new Exception(Excecoes::inserirObjeto("Dica: ". mysqli_error($this->getConexao())));
            }
            
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->erro.")"));
        }
    }
    
    public function alterar($dica) {
        
        $sql = " USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){

            $sql = "UPDATE dica SET descricao = '".$dica->getDescricao();
            $sql.= "', titulo = '".$dica->getTitulo();
            $sql.= "'  WHERE IdDica = '".$dica->getIdDica()."'";
            
            if(mysqli_query($this->getConexao(), $sql)){
                $this->fecharConexao();
            }else{
                throw new Exception(Excecoes::alterarObjeto("Dica: ". mysqli_error($this->getConexao())));
            }
            
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->erro.")"));
        }
    }

    public function excluir($dica) {
        
        $sql = "USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){
            
            $sql = "DELETE FROM dica WHERE IdDica = '".$dica->getIdDica()."'";
            
            if(mysqli_query($this->getConexao(), $sql)){
                $this->fecharConexao();
            }else {
                throw new Exception(Excecoes::excluirObjeto("Dica: ". mysqli_error($this->getConexao())));
            }
            
        }  else {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->erro.")"));
        }
    }

    public function listar() {
        
        $listaDicas = array();
        
        $sql = "USE ". $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){
            
            $sql = "SELECT * FROM dica";
            $result =  mysqli_query($this->getConexao(), $sql);
            
             while ($row = mysqli_fetch_array($result)){
    
              $dica = new Dica($row['idDica'], $row['descricao'], $row['titulo']);                
                
                array_push($listaDicas, $dica);
                
            }
            return($listaDicas);
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error).")");
         }
    }
    
    public function detalhar($dica) {
        
    }

}
