<?php
/**
 * Description of ControladorAluno
 *
 * @author Daniele
 */
class ControladorAluno 
{
    //put your code here
    private $repositorioAluno;
    
    public function __construct() 
    {
        $this->setRepositorioAluno(new RepositorioAluno());
    }
    
    public function getRepositorioAluno() 
    {
        return $this->repositorioAluno;
    }
    public function setRepositorioAluno($repositorioAluno) 
    {
        $this->repositorioAluno = $repositorioAluno;
    }
    
    public function inserir($aluno){
         
        if(ExpressoesRegulares::validarTodosOsCampos($aluno)){
            return $this->getRepositorioAluno()->inserir($aluno);
        }else{
            throw Excecoes::inserirObjeto($aluno);
        }
    }
    
    public function alterar($aluno){
        
        if(ExpressoesRegulares::validarTodosOsCampos($aluno)){
            return $this->getRepositorioAluno()->alterar($aluno);
        }else{
            throw Excecoes::alterarObjeto($aluno);
        }
    }
    
    public function excluir($aluno){
                  
        return $this->getRepositorioAluno()->excluir($aluno);
    }
    
    public function listar()
    {
        return $this->getRepositorioAluno()->listar();
    }
    
    public function detalhar($aluno)
    {
        return $this->getRepositorioAluno()->detalhar($aluno);
    }
    
    public function logar($aluno)
    {
        return $this->getRepositorioAluno()->logar($aluno);
    }
 
}
?>