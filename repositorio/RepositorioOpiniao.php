<?php
/**
 * Description of RepositorioOpiniao
 *
 * @author Fábio
 */
include($serverPath.'interfaceRepositorio/IRepositorioOpiniao.php');
include_once($serverPath.'excecoes/Excecoes.php');
include_once($serverPath.'conexao/Conexao.php');

class RepositorioOpiniao extends Conexao implements IRepositorioOpiniao {
    
    function __construct() {
       parent::__construct();  
    }
    
    public function inserir($opiniao){
        
        $sql = "USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){
            
            $sql = "INSERT INTO opiniao VALUES(null,'";
            //$sql.= NULL. "','";
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
            $sql = "UPDATE opiniao SET descricao = '".$opiniao->getDescricao();
            
            if (!mysqli_query($this->getConexao(), $sql)) 
                {
                    throw new Exception(Excecoes::alterarObjeto("Opiniao: " . mysqli_error($this->getConexao())));
                }
                else
                {
                    $this->fecharConexao();
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
                    $this->fecharConexao();
                }   
        }
        else 
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
                
    }
    
    public function listar(){
        
        $listaOpinioes = array();
        
        $sql = "USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === TRUE)
        {
            $sql = "SELECT * FROM opiniao,pessoa,aluno WHERE (opiniao.idAluno = pessoa.idPessoa) and "
                                                            ."(pessoa.idPessoa = aluno.idAluno)";
            $result = mysqli_query($this->getConexao(), $sql);
            
            while ($row = mysqli_fetch_array($result)) 
            {
                $aluno = new Aluno($row['idPessoa'], $row['nome'], $row['cpf'], $row['endereco'], $row['senha'], $row['telefone'], 
                                   $row['login'], $row['email'], $row['sexo'], $row['dataNascimento'], null/*secretaria*/, $row['idMusica'], 
                                   null/*$dieta*/, null/*$listaPagamentos*/, null/*$listaTreinos*/, $row['foto']);
                
                $opiniao = new Opiniao($row['idOpiniao'],
                                       $row['descricao'],
                                       $row['dataPostagem'],
                                       $aluno);
                
                array_push($listaOpinioes, $opiniao);
            }
            
            return $listaOpinioes;
              
        }
        
    }
    
    public function detalhar(){
        
    }
}
