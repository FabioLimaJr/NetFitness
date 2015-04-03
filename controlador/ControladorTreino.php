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
            throw Excecoes::inserirObjeto($treino->getNome());
        }else if(!ExpressoesRegulares::conferirDescricao($treino->getDescricao())){
            throw Excecoes::inserirObjeto($treino->getDescricao());
        }else if($treino->getSeries() <= 0){
            throw Excecoes::inserirObjeto("A qtd de Series tem que ser maior que zero!");
        }else if($treino->getRepeticoes() <= 0){
            throw Excecoes::inserirObjeto("A qtd de Repetições tem que ser maior que zero!");
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
            
            throw Excecoes::inserirObjeto($treino->getNome());
            
        }else if(!ExpressoesRegulares::conferirDescricao($treino->getDescricao())){
            
            throw Excecoes::inserirObjeto($treino->getDescricao());
            
        }else if($treino->getSeries() <= 0){
            
            throw Excecoes::inserirObjeto("A qtd de Series tem que ser maior que zero!");
            
        }else if($treino->getRepeticoes() <= 0){
            
            throw Excecoes::inserirObjeto("A qtd de Repetições tem que ser maior que zero!");
            
        }else{
            
            return $this->getRepositorioTreino()->alterar($treino);
            
        }
    }
    
    public function excluir($treino){
        
        return $this->getRepositorioTreino()->excluir($treino);
        
    }
    
    public function listar(){
        
        return $this->getRepositorioTreino()->listar();
        
    }
    
    public function detalhar($treino){
        
        return $this->getRepositorioTreino()->detalhar($treino);
        
    }
}
