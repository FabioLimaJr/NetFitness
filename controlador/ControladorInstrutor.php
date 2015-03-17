<?php
/**
 * Description of ControladorInstrutor
 *
 * @author Marcelo
 */

include ($serverPath.'repositorio/RepositorioInstrutor.php');

class ControladorInstrutor {
   
    private $repositorioInstrutor;
    
    function __construct() {
        $this->setRepositorioInstrutor(new RepositorioInstrutor());
    }
    
    function getRepositorioInstrutor() {
        return $this->repositorioInstrutor;
    }

    function setRepositorioInstrutor($repositorioInstrutor) {
        $this->repositorioInstrutor = $repositorioInstrutor;
    }

    public function inserir($instrutor){
         
        if(ExpressoesRegulares::validarTodosOsCampos($instrutor)){
            return $this->getRepositorioInstrutor()->inserir($instrutor);
        }else{
            throw Excecoes::inserirObjeto($instrutor);
        }
    }
    
    public function alterar($instrutor){
        
        if(ExpressoesRegulares::validarTodosOsCampos($instrutor)){
            return $this->getRepositorioInstrutor()->alterar($instrutor);
        }else{
            throw Excecoes::alterarObjeto($instrutor);
        }
    }


    public function excluir($instrutor){
                  
        return $this->getRepositorioInstrutor()->excluir($instrutor);
    }
    
    public function listar()
    {
        return $this->getRepositorioInstrutor()->listar();
    }
    
    public function detalhar($instrutor)
    {
        return $this->getRepositorioInstrutor()->detalhar($instrutor);
    }
    
    public function logar($instrutor)
    {
        return $this->getRepositorioInstrutor()->logar($instrutor);
    }
}
