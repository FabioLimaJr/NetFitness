<?php
/**
 * Description of RepositorioSecretaria
 *
 * @author Fábio
 */
class RepositorioSecretaria extends RepositorioGenerico implements IRepositorioSecretaria {
    //put your code here
    
    public function __construct() 
    {
       parent::__construct();
    }
    
    public function inserir($secretaria){
        
        $idReturn = -1;
        
        $sql = "USE " . $this->getNomeBanco();
        
        if(@$this->getConexao()->query($sql) === TRUE){
            
            if($this->inserirPessoa($secretaria)){
                
                $id = mysqli_insert_id($this->getConexao());
                $idReturn = $id;
                //echo $id . "\n";
                // INSERT INTO `secretaria`(`idSecretaria`, `idCoordenador`) VALUES ([value-1],[value-2])
                $sql = "INSERT INTO secretaria(idSecretaria, idCoordenador) VALUES(";
                $sql.= $id . ",";
                $sql.= $secretaria->getCoordenador()->getIdCoordenador() . ")";
                
                if( mysqli_query($this->getConexao(), $sql)){
                    
                    $this->fecharConexao();
                    return TRUE;
                    
                }else{
                    throw new Exception(Excecoes::inserirObjeto("Secretaria: ".mysqli_error($this->getConexao())));
                    
                }
                //echo $sql . "\n";
            }else 
                {
                    throw new Exception(Excecoes::inserirObjeto("Secretaria: ".mysqli_error($this->getConexao())));
                }
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
                    
                    $this->fecharConexao();
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
                $this->fecharConexao();
            }
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }
    
     public function listar(){
        $listaSecretarias = array();
        
        $sql = "USE " . $this->getNomeBanco();
        
        if(@$this->getConexao()->query($sql) === TRUE){
            
            $sql = "SELECT * FROM pessoa,secretaria WHERE pessoa.idPessoa = secretaria.idSecretaria";
            $result = mysqli_query($this->getConexao(), $sql);
            
            while ($row = mysqli_fetch_array($result)){
                
                $secretaria = new Secretaria($row['idPessoa'], $row['nome'], $row['cpf'], $row['endereco'], 
                                             $row['senha'], $row['telefone'],$row['login'], $row['email'], NULL);
                
                $sql2 = "SELECT * FROM  pessoa WHERE idPessoa = '".$row['idCoordenador']."'";
                $result2 = mysqli_query($this->getConexao(), $sql2); 
                $row2 = mysqli_fetch_assoc($result2);
                
                $coordenador = new Coordenador($row['idCoordenador'], null/*listaInstrutores*/, null/*listaSecretarias*/, 
                                               null/*listaNutricionistas*/, $row2['nome'], $row2['cpf'], 
                                               $row2['endereco'], $row2['senha'], $row2['telefone'], $row2['email'], 
                                               $row2['login']);
                                
                $secretaria->setCoordenador($coordenador);                
                
                array_push($listaSecretarias, $secretaria);
                
            }
            
            return $listaSecretarias;                  
        }
    }
    
    public function detalharSecretaria(){
        
    }
}
