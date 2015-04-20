<?php
/**
 * Description of ControladorAluno
 *
 * @author Daniele
 */

include ($serverPath.'repositorio/RepositorioAluno.php');

class ControladorAluno 
{
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
            if(!ExpressoesRegulares::conferirDataNascimento($aluno->getDataNascimento()))
            {
                throw new Exception(Excecoes::dataInvalida("Aluno"));
            }
            else 
            {
                $this->getRepositorioAluno()->inserir($aluno);
            }
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
    
    public function listar($fetchType)
    {
        return $this->getRepositorioAluno()->listar($fetchType);
    }
    
    public function detalhar($aluno,$fetchType)
    {
        return $this->getRepositorioAluno()->detalhar($aluno,$fetchType);
    }
    
    public function logar($aluno)
    {
        return $this->getRepositorioAluno()->logar($aluno);
    }
 
}
?>