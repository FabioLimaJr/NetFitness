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
                                                                .$exercicio->getSeries().","
                                                                .$exercicio->getRepeticoes().")";
                    
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
    
    public function alterar($treino) {
        
        $sql = "USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){
            
            $sql = "UPDATE treino SET nome='".$treino->getNome().
                                  "', descricao='".$treino->getDescricao().
                                  "' WHERE idTreino=".$treino->getIdTreino();
            
            if(mysqli_query($this->getConexao(), $sql)){
                
                $sql = "DELETE FROM treinoexercicio WHERE idTreino=".$treino->getIdTreino();
                
                if(mysqli_query($this->getConexao(), $sql)){
                    
                    $listaExercicios = $treino->getListaExercicios();
                    //var_dump($listaExercicios);
                    foreach ($listaExercicios as $exercicio){

                        $sql = "INSERT INTO treinoexercicio VALUES(".$treino->getIdTreino().","
                                                                    .$exercicio->getIdExercicio().","
                                                                    .$exercicio->getSeries().","
                                                                    .$exercicio->getRepeticoes().")";

                        if(!mysqli_query($this->getConexao(), $sql)){

                            throw new Exception(Excecoes::inserirObjeto("Relação entre treino e exercicio: ".  mysqli_error($this->getConexao())));
                        }
                    }

                    $this->fecharConexao();
                    return true;
                }else{
                    throw new Exception(Excecoes::excluirObjetosRelacionados("treino e exercício ".  mysqli_error($this->getConexao())));
                }
            }else{
                throw new Exception(Excecoes::alterarObjeto("Treino: ".  mysqli_error($this->getConexao())));
            }
        }else{
            
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->error.")"));
        }    
    }

    public function excluir($treino) {
        
        $sql = "USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){
            
            $sql = "DELETE FROM treino WHERE idTreino=".$treino->getIdTreino();
            
            if(mysqli_query($this->getConexao(), $sql)){
                $this->fecharConexao();
                return true;
            }else{
                throw new Exception(Excecoes::excluirObjeto("Treino: ".  mysqli_error($this->getConexao())));
            }
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->error.")"));
        }
    }

    public function listar($instrutor, $fetchType) {
       
        $sql = "USE " . $this->getNomeBanco();
        $listaTreinos = array();
 
        if($this->getConexao()->query($sql) === TRUE)
        {
            $sqlListaTreinos = "SELECT * FROM treino WHERE idInstrutor = ".$instrutor->getIdInstrutor();      
            try
            {   
                $resultListaTreinos = mysqli_query($this->getConexao(), $sqlListaTreinos);
                
                while ($rowListaTreinos = mysqli_fetch_array($resultListaTreinos))
                {
                   
                    $treinoRetornado = new Treino($rowListaTreinos['idTreino']);
                    
                    if($fetchType == EAGER)
                    {
                        $treinoRetornado = $this->detalhar($treinoRetornado, EAGER);
                    }
                    else 
                    {
                        $treinoRetornado = $this->detalhar($treinoRetornado, LAZY);
                    }    
                    
                    array_push($listaTreinos, $treinoRetornado);
                }
                
                return $listaTreinos;
            }
            catch(Exception $exc)
            {
                throw new Exception($exc->getMessage());
            }
 
            return $listaTreinos;
        }
        else
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }

    public function detalhar($treino, $fetchType) {
        
        $sql = "USE " . $this->getNomeBanco();
 
        if($this->getConexao()->query($sql) === TRUE)
        {
            $sqlTreino = "SELECT * FROM treino WHERE idTreino = '".$treino->getIdTreino()."'";
         
            try
            {
                $resultTreino = mysqli_query($this->getConexao(), $sqlTreino);
                
                $rowTreino = mysqli_fetch_assoc($resultTreino);
                $treinoRetornado = new Treino($rowTreino['idTreino'], $rowTreino['nome'], 
                                              $rowTreino['descricao'], null/*$instrutor*/);
                
                $sqlDataTreino = "SELECT data FROM alunotreino WHERE idTreino = '".$treino->getIdTreino()."'";                
                $resultDataTreino =  mysqli_query($this->getConexao(), $sqlDataTreino);
                $rowDataTreino = mysqli_fetch_assoc($resultDataTreino);
                $treinoRetornado->setData($rowDataTreino['data']);
               
            }
            catch(Exception $exc)
            {
                throw new Exception($exc->getMessage());
            }
            
            if($fetchType === EAGER)
            {               
                $treinoRetornado->setInstrutor($this->detalharObjeto(new Instrutor($rowTreino['idInstrutor']), LAZY));               
            }
          
            return $treinoRetornado;
       }
       else
       {
           throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
       }
    }
    
    public function listarTodos($fetchType) {
       
        $sql = "USE " . $this->getNomeBanco();
        $listaTreinos = array();
 
        if($this->getConexao()->query($sql) === TRUE)
        {
            $sqlListaTreinos = "SELECT * FROM treino";      
            try
            {   
                $resultListaTreinos = mysqli_query($this->getConexao(), $sqlListaTreinos);
                
                while ($rowListaTreinos = mysqli_fetch_array($resultListaTreinos))
                {
                   
                    $treinoRetornado = new Treino($rowListaTreinos['idTreino']);
                    
                    if($fetchType == EAGER)
                    {
                        $treinoRetornado = $this->detalhar($treinoRetornado, EAGER);
                    }
                    else 
                    {
                        $treinoRetornado = $this->detalhar($treinoRetornado, LAZY);
                    }    
                    
                    array_push($listaTreinos, $treinoRetornado);
                }
                
                return $listaTreinos;
            }
            catch(Exception $exc)
            {
                throw new Exception($exc->getMessage());
            }
 
            return $listaTreinos;
        }
        else
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }

    
}
