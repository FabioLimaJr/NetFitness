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
        }else if(!$this->validarSeriesRepeticoes($treino->getListaExercicios())){
            throw new Exception(Excecoes::valorNumericoInvalido("Series e Repetições"));
        }else{
            return $this->getRepositorioTreino()->inserir($treino);
        }
    }
    
    public function validarSeriesRepeticoes($listaExercicios){
        
        foreach ($listaExercicios as $exercicio){
            
            if($exercicio->getSeries() == null || $exercicio->getSeries() <= 0){
                return false;
            }
            if($exercicio->getRepeticoes() == null || $exercicio->getRepeticoes() <= 0){
                return false;
            }
        }
        
        return true;
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
    
    public function vincularTreinoAlunos($treino, $listaAlunos, $qtdTreinos){
        foreach ($qtdTreinos as $qtd)
        {
            if(!is_numeric($qtd) || !is_int((int)$qtd))
            {
                throw new Exception(Excecoes::numeroNaoInteiro("quantidade de treinos"));
            }
            else
            {
                if((int)$qtd<=0)
                {
                    throw new Exception(Excecoes::numeroMenorIgualZero("quantidade de treinos"));
                }
            }

        }
        
        if(!ExpressoesRegulares::conferirData($treino->getData()))
        {
            throw new Exception(Excecoes::dataInvalida("Treino"));
        }
    
        return $this->getRepositorioTreino()->vincularTreinoAlunos($treino, $listaAlunos, $qtdTreinos);
        
    }
    
     public function listarTreinoPorAluno($aluno, $fetchType){
         return $this->getRepositorioTreino()->listarTreinoPorAluno($aluno, $fetchType);
     }
     
     public function listarTreinosRealizados($aluno, $treino)
     {
         return $this->getRepositorioTreino()->listarTreinosRealizados($aluno, $treino);
     }
     
     public function atualizarDatasTreinosRealizados($aluno, $treino, $qtdTreinos)
     {
         $this->getRepositorioTreino()->atualizarDatasTreinosRealizados($aluno, $treino, $qtdTreinos);
     }
}
