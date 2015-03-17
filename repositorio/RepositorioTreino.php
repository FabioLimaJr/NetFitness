<?php
/**
 * Description of RepositorioTreino
 *
 * @author Marcelo
 */
include($serverPath.'interfaceRepositorio/IRepositorioTreino.php');
include_once($serverPath.'excecoes/Excecoes.php');
include_once($serverPath.'conexao/Conexao.php');


class RepositorioTreino extends Conexao implements IRepositorioTreino{
    
    function __construct() {
       parent::__construct();  
    }
    
    public function inserir($treino) {
        
        $sql = "USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){
            
            $sql = "INSERT INTO treino VALUES('";
            $sql.= NULL. "','";
            $sql.= $treino->getNome(). "','";
            $sql.= $treino->getDescricao(). "','";
            $sql.= $treino->getInstrutor()->getIdInstrutor(). "')";
            
            if(mysqli_query($this->getConexao(), $sql)){
                $this->fecharConexao();
            }else{
                throw new Exception(Excecoes::inserirObjeto("Treino: ".  mysql_errno($this->getConexao())));
            }
            
        }  else {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->erro.")"));
        }
    }
    
    public function alterar($treino) {
        
    }

    public function excluir($treino) {
        
    }

    public function listar() {
        
    }

    public function detalhar($treino) {
        
    }

}
