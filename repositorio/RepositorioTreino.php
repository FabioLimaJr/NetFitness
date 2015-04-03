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
            
            $sql = "INSERT INTO treino VALUES(null,'";
            $sql.= $treino->getNome()."','";
            $sql.= $treino->getDescricao()."',";
            $sql.= $treino->getInstrutor()->getIdInstrutor().")";
            
            if(mysqli_query($this->getConexao(), $sql)){
                
                $id = mysqli_insert_id($this->getConexao());
                
                $listaExercicios = $treino->getListaExercicios();
                //var_dump($listaExercicios);
                foreach ($listaExercicios as $exercicio){
                    
                    $sql = "INSERT INTO treinoexercicio VALUES(".$id.","
                                                                .$exercicio->getIdExercicio().","
                                                                .$treino->getSeries().","
                                                                .$treino->getRepeticoes().")";
                    
                    if(!mysqli_query($this->getConexao(), $sql)){
                        
                        throw new Exception(Excecoes::inserirObjeto("Relação entre treino e exercicio: ".  mysqli_error($this->getConexao())));
                    }
                }
                
                $this->fecharConexao();
                return true;
            }else{
                throw new Exception(Excecoes::inserirObjeto("Treino: ".  mysqli_error($this->getConexao())));
            }
            
        }  else {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->error.")"));
        }
    }
    
    private function inserirTreinoExercicio($treino){
        
        
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
