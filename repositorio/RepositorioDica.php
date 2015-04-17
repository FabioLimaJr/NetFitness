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
 
    public function inserir($dica, $pessoa) {
        
        $sql = " USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){

            $sql = "INSERT INTO dica VALUES('";
            $sql.= "NULL','";
            $sql.= $dica->getDescricao(). "','";
            $sql.= $dica->getTitulo(). "')";
            
            if(mysqli_query($this->getConexao(), $sql))
            {  
                $tabela = "";
                
              if(get_class($pessoa) == "Nutricionista")
              {
                  $tabela = "nutricionistadica";
              }else{
                  $tabela = "instrutordica";
              }
                $id = mysqli_insert_id($this->getConexao());
                
                    $sql = "INSERT INTO ".$tabela." VALUES('".$pessoa->getIdPessoa()."','".$id."')";
                                                                  
                    if(!mysqli_query($this->getConexao(), $sql)){
                        throw new Exception(Excecoes::inserirObjeto("Relação entre ".get_class($pessoa)." e Dica: ".  mysqli_error($this->getConexao())));
                    }
                
               
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
               // $this->fecharConexao();
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
                //$this->fecharConexao();
            }else {
                throw new Exception(Excecoes::excluirObjeto("Dica: ". mysqli_error($this->getConexao())));
            }
            
        }  else {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->erro.")"));
        }
    }

    public function listar($pessoa) 
    {
        $tipoUsuario = get_class($pessoa);
        $tabela = lcfirst($tipoUsuario)."dica";
        $sql = "USE " . $this->getNomeBanco();
        $listaDicas=array();
        
        if($this->getConexao()->query($sql) === TRUE)
        {
            $sqlPessoaDica = "SELECT * FROM ".$tabela." WHERE id".$tipoUsuario." = '".$pessoa->getIdPessoa()."'";
                      
            try
            {
                $resultPessoaDica = mysqli_query($this->getConexao(), $sqlPessoaDica);
            
                while ($rowPessoaDica = mysqli_fetch_array($resultPessoaDica)) 
                {
                    $sqlDica = "SELECT * FROM dica WHERE idDica = '".$rowPessoaDica['idDica']."'";
                    $resultDica = mysqli_query($this->getConexao(), $sqlDica);
                    $rowDica = mysqli_fetch_assoc($resultDica);
                    
                    $dica = new Dica($rowDica['idDica'], $rowDica['descricao'], $rowDica['titulo']);
                    
                    array_push($listaDicas, $dica);
                }    
            } 
            catch (Exception $exc) 
            {
                    throw new Exception($exc->getMessage());
            }
            return $listaDicas;
            
        }
        else
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
        
    }
    
    public function detalhar($dica) 
    {        
        $sql = "USE " . $this->getNomeBanco();
 
        if($this->getConexao()->query($sql) === TRUE)
        {
            $sqlDica = "SELECT * FROM dica WHERE idDica = '".$dica->getIdDica()."'";
         
            try
            {
                $resultDica = mysqli_query($this->getConexao(), $sqlDica);                
                $rowDica = mysqli_fetch_assoc($resultDica);
                $dicaRetornada = new Dica($rowDica['idDica'], $rowDica['descricao'], 
                                                  $rowDica['titulo']);
               
            }
            catch(Exception $exc)
            {
                throw new Exception($exc->getMessage());
            }
                 
            return $dicaRetornada;
       }
       else
       {
           throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
       }
        
    }

}
