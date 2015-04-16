<?php
/**
 * Description of ControladorTreino
 *
 * @author Marcelo
 */

include ($serverPath.'repositorio/RepositorioTreino.php');

class ControladorTreino {
   
    private $repositorioTreino;
    
    function __construct() {  
        $this->setRepositorioTreino(new RepositorioTreino());
    }
    
    function getRepositorioTreino() {
        return $this->repositorioTreino;
    }

    function setRepositorioTreino($repositorioTreino) {
        $this->repositorioTreino = $repositorioTreino;
    }
    
    public function inserir($treino){        
        /*if((!ExpressoesRegulares::conferirNome($treino->getNome())) &&                
            (!ExpressoesRegulares::conferirDescricao($treino->getDescricao()))){
            throw Excecoes::inserirObjeto($treino);
        }else{
            return $this->getRepositorioTreino()->inserir($treino);
        }*/
        if((!ExpressoesRegulares::conferirNome($treino->getNome()))){
            throw new Exception(Excecoes::inserirObjeto($treino->getNome()));
        }else if(!ExpressoesRegulares::conferirDescricao($treino->getDescricao())){
            throw new Exception(Excecoes::inserirObjeto($treino->getDescricao()));
        }else{
            return $this->getRepositorioTreino()->inserir($treino);
        }
    }
    
    public function alterar($treino){        
         /*if((!ExpressoesRegulares::conferirNome($treino->getNome())) &&                
            (!ExpressoesRegulares::conferirDescricao($treino->getDescricao()))){
            throw Excecoes::inserirObjeto($treino);
        }else{
            return $this->getRepositorioTreino()->inserir($treino);
        }   */
        
        if((!ExpressoesRegulares::conferirNome($treino->getNome()))){
            
            throw new Exception(Excecoes::inserirObjeto($treino->getNome()));
            
        }else if(!ExpressoesRegulares::conferirDescricao($treino->getDescricao())){
            
            throw new Exception(Excecoes::inserirObjeto($treino->getDescricao()));
            
        }else{
            
            return $this->getRepositorioTreino()->alterar($treino);
            
        }
    }
    
    public function excluir($treino){
        
        return $this->getRepositorioTreino()->excluir($treino);
        
    }
    
    public function listar($instrutor, $fetchType){
        
        return $this->getRepositorioTreino()->listar($instrutor, $fetchType);
        
    }
    
    public function detalhar($treino, $fetchType){
        
        return $this->getRepositorioTreino()->detalhar($treino, $fetchType);
        
    }
    
    // Listar todos os treinos independente do instrutor logado.
    public function listarTodos($fetchType){
        
        return $this->getRepositorioTreino()->listarTodos($fetchType);
        
    }
    
    public function vincularTreinoAlunos($treino, $listaAlunos){
        
        return $this->getRepositorioTreino()->vincularTreinoAlunos($treino, $listaAlunos);
        
    }
}
