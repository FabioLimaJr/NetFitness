<?php
/**
 * Description of RepositorioOpiniao
 *
 * @author Fábio
 */
include($serverPath.'interfaceRepositorio/IRepositorioOpiniao.php');
include_once($serverPath.'excecoes/Excecoes.php');
include_once($serverPath.'conexao/Conexao.php');

class RepositorioOpiniao extends RepositorioGenerico implements IRepositorioOpiniao {
    
    function __construct() {
       parent::__construct();  
    }
    
    public function inserir($opiniao){
        
        $sql = "USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){
            
            $sql = "INSERT INTO opiniao VALUES('";
            $sql.= NULL. "','";
            $sql.= $opiniao->getDescricao()."','";
            $sql.= $opiniao->getDataPostagem()."','";
            $sql.= $opiniao->getAluno()->getIdAluno(). "')";
            
            if(mysqli_query($this->getConexao(), $sql)){
               
                //$this->fecharConexao();
           
            }else{
                throw new Exception(Excecoes::inserirObjeto("Opiniao: ".  mysql_errno($this->getConexao())));
            }
            
        }  else {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->erro.")"));
        }      
    }
    
    public function alterar($opiniao){
        
        $sql = "USE " . $this->getNomeBanco();
        
        if (@$this->getConexao()->query($sql) === TRUE)
        {
            $sql = "UPDATE opiniao SET descricao = '".$opiniao->getDescricao()."' WHERE idOpiniao = ".$opiniao->getIdOpiniao();
            
            if (!mysqli_query($this->getConexao(), $sql)) 
                {
                    throw new Exception(Excecoes::alterarObjeto("Opiniao: " . mysqli_error($this->getConexao())));
                }
                else
                {
                    //$this->fecharConexao();
                }                                                      
        }
        
    }
    
    public function excluir($opiniao){
        
        $sql = "USE " . $this->getNomeBanco();
        
        if (@$this->getConexao()->query($sql) === TRUE) 
        {
            
            $id = $opiniao->getIdOpiniao();
            
            $sql = "DELETE FROM opiniao where idOpiniao = '".$id."'";
                if (!mysqli_query($this->getConexao(), $sql)) 
                {
                    throw new Exception(Excecoes::alterarObjeto("Opiniao: " . mysqli_error($this->getConexao())));
                }
                else
                {
                    //$this->fecharConexao();
                }   
            
        }
        else 
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
                
    }
    
    public function listar($fetchType)
    {
        
        $listaOpinioes = array();

        $sql = "USE " . $this->getNomeBanco();

        if($this->getConexao()->query($sql) === TRUE)
        {
            $sqlOpiniao = "SELECT * FROM opiniao";

            try
            {
                $resultOpiniao = mysqli_query($this->getConexao(), $sqlOpiniao);

                while ($rowOpiniao = mysqli_fetch_array($resultOpiniao)) 
                {      
                    $opiniaoRetornada = new Opiniao($rowOpiniao['idOpiniao']);

                    if($fetchType == EAGER)
                    {  
                        $opiniaoRetornada = $this->detalhar($opiniaoRetornada, EAGER);                  
                    }
                    else 
                    {
                        $opiniaoRetornada = $this->detalhar($opiniaoRetornada, LAZY);    
                    }            

                    array_push($listaOpinioes, $opiniaoRetornada);

                }
            }
            catch (Exception $exc)
            {
                throw new Exception($exc->getMessage());
            }           

            return($listaOpinioes);                    
        }
        else 
        {
           throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
        
    }
    
    public function detalhar($opiniao, $fetchType)
    {
        
        $sql = "USE " . $this->getNomeBanco();
 
        if($this->getConexao()->query($sql) === TRUE)
        {
            $sqlOpiniao = "SELECT * FROM opiniao WHERE idOpiniao = '".$opiniao->getIdOpiniao()."'";
         
            try
            {
                $resultOpiniao = mysqli_query($this->getConexao(), $sqlOpiniao);                
                $rowOpiniao = mysqli_fetch_assoc($resultOpiniao);
                $opiniaoRetornada = new Opiniao($rowOpiniao['idOpiniao'], $rowOpiniao['descricao'], 
                                                $rowOpiniao['dataPostagem'], null/*$aluno*/);
               
            }
            catch(Exception $exc)
            {
                throw new Exception($exc->getMessage());
            }
            
            if($fetchType === EAGER)
            {               
                $opiniaoRetornada->setAluno($this->detalharObjeto(new Aluno($rowOpiniao['idAluno']), LAZY));               
            }
        
            return $opiniaoRetornada;
       }
       else
       {
           throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
       }
    }
}
