<?php
/**
 * Description of ControladorNutricionista
 *
 * @author Erick
 */

include ($serverPath.'repositorio/RepositorioNutricionista.php');
//include ($serverPath.'interfaceRepositorio/IRepositorioNutricionista.php');

class ControladorNutricionista {
   
    private $repositorioNutricionista;
    
    function __construct() {
        $this->repositorioNutricionista = new RepositorioNutricionista();
    }
    
    function getRepositorioNutricionista() {
        return $this->repositorioNutricionista;
    }
    function setRepositorioNutricionista($repositorioNutricionista) {
        $this->repositorioNutricionista = $repositorioNutricionista;
    }
    public function inserir($nutricionista){
         /*
        if(ExpressoesRegulares::validarTodosOsCampos($nutricionista)){
            return $this->getRepositorioNutricionista()->inserir($nutricionista);
        }else{
            throw Excecoes::inserirObjeto($nutricionista);
        }
           */
          $this->getRepositorioNutricionista()->inserir($nutricionista);
        
        
    }
    
    public function alterar($nutricionista){
        /*
        if(ExpressoesRegulares::validarTodosOsCampos($nutricionista)){
            return $this->getRepositorioNutricionista()->alterar($nutricionista);
        }else{
            throw Excecoes::alterarObjeto($nutricionista);
        }
         */
        
        $this->getRepositorioNutricionista()->alterar($nutricionista);
    }
    public function excluir($nutricionista){
                  
        return $this->getRepositorioNutricionista()->excluir($nutricionista);
    }
    
    public function listar()
    {
        return $this->getRepositorioNutricionista()->listar();
    }
    
    public function detalhar($nutricionista)
    {
        return $this->getRepositorioNutricionista()->detalhar($nutricionista);
    }
    
    public function logar($nutricionista)
    {
        return $this->getRepositorioNutricionista()->logar($nutricionista);
    }
}