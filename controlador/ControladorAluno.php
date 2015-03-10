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
                  
        return $this->getRepositorioInstrutor()->excluir($aluno);
    }
    
    public function listar()
    {
        return $this->getRepositorioInstrutor()->listar();
    }

    /*public function alterar($aluno) 
    {
        if($aluno!=NULL)
        {
            $this->getRepositorioAluno()->alterar($aluno);
        }
        else
        {
            throw new Exception(Excecoes::excecaoObjetoNulo("Impossível alterar o aluno"));
        }
    }

    public function excluir($aluno) 
    {
        if($aluno!=NULL)
        {
            $this->getRepositorioAluno()->excluir($aluno);
        }
        else
        {
            throw new Exception(Excecoes::excecaoObjetoNulo("Impossível excluir o aluno"));
        }
    }

    public function inserir($aluno) 
    {
        if($aluno!=NULL)
        {
           return $this->getRepositorioAluno()->inserir($aluno);
        }
        else
        {
            throw new Exception(Excecoes::excecaoObjetoNulo("Impossível inserir o aluno"));
        }
    }
    
    public function listar()
    {

        return $this->getRepositorioAluno()->listar();

    }*/
    //Completar com os demais controles
 
}

?>
