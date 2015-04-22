<?php
/**
 * Description of RepositorioSecretaria
 *
 * @author Fábio
 */
include($serverPath.'interfaceRepositorio/IRepositorioSecretaria.php');
include_once($serverPath.'repositorioGenerico/RepositorioGenerico.php');
include_once($serverPath.'excecoes/Excecoes.php');

class RepositorioSecretaria extends RepositorioPessoa implements IRepositorioSecretaria {
    //put your code here
    
    public function __construct() 
    {
       parent::__construct();
    }

        public function inserir($secretaria){
        
        $idReturn = -1;
        
        $sql = "USE " . $this->getNomeBanco();
        
        if(@$this->getConexao()->query($sql) === TRUE){
             
            $this->getConexao()->autocommit(FALSE); 
            
            if($this->inserirPessoa($secretaria)){
                
                $id = mysqli_insert_id($this->getConexao());
                $idReturn = $id;
                //echo $id . "\n";
                // INSERT INTO `secretaria`(`idSecretaria`, `idCoordenador`) VALUES ([value-1],[value-2])
                $sql = "INSERT INTO secretaria(idSecretaria, idCoordenador) VALUES(";
                $sql.= $id . ",";
                $sql.= $secretaria->getCoordenador()->getIdCoordenador() . ")";
                
                if( mysqli_query($this->getConexao(), $sql)){
                    
                    $this->getConexao()->commit();
                     $secretaria->setIdSecretaria($idReturn);
                    return $secretaria;
                    
                }else{
                    $this->getConexao()->rollback();
                    throw new Exception(Excecoes::inserirObjeto("Secretaria: ".mysqli_error($this->getConexao())));
                    
                }
            }else 
                {
                    $this->getConexao()->rollback();
                    throw new Exception(Excecoes::inserirObjeto("Secretaria: ".mysqli_error($this->getConexao())));
                }
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }
    
    public function alterar($secretaria){
        
        $sql = "USE " . $this->getNomeBanco();
        
        if(@$this->getConexao()->query($sql) === TRUE){
            
            if(!$this->alterarPessoa($secretaria)){
                
                throw new Exception(Excecoes::alterarObjeto("Secretaria: " . mysqli_error($this->getConexao())));
                
            }else{
                
                $sql = "UPDATE secretaria SET idCoordenador=" . $secretaria->getCoordenador()->getIdCoordenador();
                $sql.= " WHERE idSecretaria=" . $secretaria->getIdSecretaria();
                
                if(!mysqli_query($this->getConexao(), $sql)){
                    
                    throw new Exception(Excecoes::alterarObjeto("Secretaria: " . mysqli_error($this->getConexao())));
                }else{
                    
                    //$this->fecharConexao();
                }
            }
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }
    
    public function excluir($secretaria){
        
        $sql = "USE " . $this->getNomeBanco();
        
        if(@$this->getConexao()->query($sql) === TRUE){
            
            $sql = "DELETE FROM pessoa WHERE pessoa.idPessoa = " . $secretaria->getIdSecretaria();
            
            if(!mysqli_query($this->getConexao(), $sql)){
                throw new Exception(Excecoes::excluirObjeto("Secretaria: " . mysqli_error($this->getConexao())));
            }else{
                //$this->fecharConexao();
            }
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }
    
     public function listar($fetchType){
        $listaSecretarias = array();
        
        $sql = "USE " . $this->getNomeBanco();
        
        if(@$this->getConexao()->query($sql) === TRUE)
        {
            
            $sqlListaScretarias = "SELECT * FROM pessoa,secretaria WHERE pessoa.idPessoa = secretaria.idSecretaria";
            
            try
            {
                $resultListaSecretarias = mysqli_query($this->getConexao(), $sqlListaScretarias);

                while ($rowListaSecretarias = mysqli_fetch_array($resultListaSecretarias))
                {

                    $secretariaRetornada = new Secretaria($rowListaSecretarias['idSecretaria']);

                    if($fetchType === EAGER)
                    {
                        $secretariaRetornada = $this->detalharObjeto($secretariaRetornada, EAGER);
                    }
                    else 
                    {
                        $secretariaRetornada = $this->detalharObjeto($secretariaRetornada, LAZY);
                    }

                    array_push($listaSecretarias, $secretariaRetornada);

                }
            }
            catch (Exception $exc)
            {
                throw new Exception($exc->getMessage());
            }
            
            return $listaSecretarias;                  
        }
        else
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }
    
    public function detalhar($secretaria,$fetchType)
    { 

        $sql = "USE " . $this->getNomeBanco();

        if($this->getConexao()->query($sql) === TRUE)
        {
            
            $sqlSecretaria = "SELECT * FROM pessoa,secretaria WHERE pessoa.idPessoa = secretaria.idSecretaria AND "
                    ."secretaria.idSecretaria = '".$secretaria->getIdSecretaria()."'";
            
            try
            {
                $resultSecretaria = mysqli_query($this->getConexao(), $sqlSecretaria);
                $rowSecretaria = mysqli_fetch_assoc($resultSecretaria);
                $secretariaRetornada = new Secretaria($rowSecretaria['idSecretaria'], $rowSecretaria['nome'], 
                                                      $rowSecretaria['cpf'], $rowSecretaria['endereco'], 
                                                      $rowSecretaria['senha'], $rowSecretaria['telefone'], 
                                                      $rowSecretaria['login'], $rowSecretaria['email'], 
                                                      null/*$coordenador*/);
             }
             catch(Exception $exc)
             {
                 throw new Exception($exc->getMessage());
             }
                
            if($fetchType === EAGER)
            {  
                //Coordenador
                $secretariaRetornada->setCoordenador($this->detalharObjeto(new Coordenador($rowSecretaria['idCoordenador']), LAZY));
            }
            
            return $secretariaRetornada;
        }
        else 
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
        
    }
    
    
    
    
    // esse metodo retorna nulo caso o usuario encontrado em pessoa n seja uma secretaria
    public function logar($secretaria){
        
        $secretariaReturn = null;
        
        $sql = "USE " . $this->getNomeBanco();
        
        if(@$this->getConexao()->query($sql) === TRUE){
        
            $pessoa = $this->logarPessoa($secretaria);
            
            if($pessoa == NULL){
                
                throw new Exception(Excecoes::usuarioInvalido());
                
            }else{
                /*
                * por enquanto coloquei apenas os campos da secretaria, se for preciso dps coloca para puxar o coordenador tbm.
                */
                
                $sql = "SELECT * FROM secretaria WHERE secretaria.idSecretaria = ".$pessoa->getIdPessoa();
                $result = mysqli_query($this->getConexao(), $sql);

                while($row = mysqli_fetch_array($result)){
                    
                    $secretariaReturn = new Secretaria($pessoa->getIdPessoa()
                                                        ,$pessoa->getNome()
                                                        ,$pessoa->getCpf()
                                                        ,$pessoa->getEndereco()
                                                        ,$pessoa->getSenha()
                                                        ,$pessoa->getTelefone()
                                                        ,$pessoa->getLogin()
                                                        ,$pessoa->getEmail()
                                                        ,$row['idCoordenador']);

                }

                return $secretariaReturn;
                
            }
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }
}
