<?php
/**
 * Description of RepositorioAluno
 *
 * @author Daniele
 */
class RepositorioAluno extends RepositorioGenerico implements IRepositorioAluno
{
    
    function __construct() 
    {
       parent::__construct();
    }
    public function inserir($aluno){
        
        $idReturn = -1;
        $sql = "USE " . $this->getNomeBanco();
        if (@$this->getConexao()->query($sql) === TRUE) 
        {
            if ($this->inserirPessoa($aluno)) 
            {
                $id = mysqli_insert_id($this->getConexao());
                $idReturn = $id;
                $sql = "INSERT INTO aluno values('";
                $sql.= $id ."','";
                $sql.= $aluno->getSexo()."','";
                $sql.= $aluno->getOpiniao()."','";                
                $sql.= $aluno->getSecretaria()->getIdSecretaria()."')";
                
                if (mysqli_query($this->getConexao(), $sql)) 
                {
                    $this->fecharConexao();
                    $aluno->setIdAluno($idReturn);
                    return $aluno;
                    //return $idReturn;
                } 
                else 
                {
                    throw new Exception(Excecoes::inserirObjeto("Aluno: ".mysqli_error($this->getConexao())));
                }
            } 
            else 
            {
                throw new Exception(Excecoes::inserirObjeto("Aluno: ".mysqli_error($this->getConexao())));
            }
        } 
        else 
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error).")");
        }
    }
    
    public function alterar($aluno){
        
        $sql = "USE " . $this->getNomeBanco();
        if (@$this->getConexao()->query($sql) === TRUE){
            if (!$this->alterarPessoa($aluno)){
                throw new Exception(Excecoes::alterarObjeto("Aluno: " . mysqli_error($this->getConexao())));
            } 
            else{
                /*$sql = "UPDATE aluno SET idSecretaria= '".$aluno->getSecretaria()->getIdSecretaria() . "'";
                $sql.= ", sexo = '".$aluno->getSexo();
                $sql.= ", opiniao = '".$aluno->getOpiniao();
                $sql.= "' WHERE idAluno= '".$aluno->getIdAluno();*/
                
                $sql = "UPDATE aluno SETsexo = '".$aluno->getSexo()."'";
                $sql.= ", opiniao = '".$aluno->getOpiniao()."'";
                $sql.= "' WHERE idAluno= '".$aluno->getIdAluno()." and ". "'idSecretaria= '".$aluno->getSecretaria()->getIdSecretaria();
                //falta alterar as demais listas atreladas se for preciso
                
                if (!mysqli_query($this->getConexao(), $sql)){
                    throw new Exception(Excecoes::alterarObjeto("Aluno: " . mysqli_error($this->getConexao())));
                }
                else{
                    $this->fecharConexao();
                }
            }
        } 
        else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }
    
    public function excluir($aluno){
        
        $sql = "USE " . $this->getNomeBanco();
        if (@$this->getConexao()->query($sql) === TRUE){
            
            $id = $aluno->getIdAluno();
            //$sql = "DELETE FROM pessoa WHERE idPessoa IN (SELECT idAluno FROM aluno WHERE idInstrutor = '" . $id . "')";
            $sql = "DELETE FROM aluno where idAluno = '".$id."'";
            
            if (!mysqli_query($this->getConexao(), $sql)){
                throw new Exception(Excecoes::excluirObjetosRelacionados("Aluno: " . mysqli_error($this->getConexao())));
            }
            $sql = "DELETE FROM pessoa WHERE idPessoa = '" . $id . "'";
            if (!mysqli_query($this->getConexao(), $sql)){
                throw new Exception(Excecoes::excluirObjeto("Aluno: " . mysqli_error($this->getConexao())));
            }
            else{
                $this->fecharConexao();
            }  
        } 
        else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }
    
    public function detalhar($aluno) 
    {
        $sql = "USE " . $this->getNomeBanco();

        if($this->getConexao()->query($sql) === TRUE)
        {
            $sql = "SELECT * FROM pessoa,aluno WHERE pessoa.idPessoa = aluno.idAluno AND "
                    ."aluno.idAluno = '".$aluno->getIdAluno."'";
            
            $result = mysqli_query($this->getConexao(), $sql);
            
            while ($row = mysqli_fetch_array($result)) 
            {
                 $aluno = new Aluno($row['idPessoa'], $row['nome'], $row['cpf'], $row['endereco'], $row['senha'], $row['telefone'], $row['login'], $row['email'], 
                        $row['sexo'], $row['opiniao'], null/*secretaria*/);
                
                
                $sql2 = "SELECT * FROM  pessoa WHERE idPessoa = '".$row['idSecretaria']."'";
                $result2 = mysqli_query($this->getConexao(), $sql2); 
                $row2 = mysqli_fetch_assoc($result2);
                
                $secretaria = new Secretaria($row['idSecretaria'], $row2['nome'], $row2['cpf'], $row2['endereco'], $row2['senha'], $row2['telefone'], $row2['login'], $row2['email'], null/*$coordenador*/);
                
                $aluno->setSecretaria($secretaria);
            }
        }
    }
    
    
    public function listar() 
    {
        $listaAlunos = array();
        
        $sql = "USE " . $this->getNomeBanco();
    
        
        if($this->getConexao()->query($sql) === TRUE)
        {
        
            
            $sql = "SELECT * FROM pessoa,aluno WHERE pessoa.idPessoa = aluno.idAluno";
            $result = mysqli_query($this->getConexao(), $sql);
            
            while ($row = mysqli_fetch_array($result)) 
            {
                
                $aluno = new Aluno($row['idPessoa'], $row['nome'], $row['cpf'], $row['endereco'], $row['senha'], $row['telefone'], $row['login'], $row['email'], 
                        $row['sexo'], $row['opiniao'], null/*secretaria*/);
                
                
                $sql2 = "SELECT * FROM  pessoa WHERE idPessoa = '".$row['idSecretaria']."'";
                $result2 = mysqli_query($this->getConexao(), $sql2); 
                $row2 = mysqli_fetch_assoc($result2);
                
                $secretaria = new Secretaria($row['idSecretaria'], $row2['nome'], $row2['cpf'], $row2['endereco'], $row2['senha'], $row2['telefone'], $row2['login'], $row2['email'], null/*$coordenador*/);
                
                $aluno->setSecretaria($secretaria);
                
                array_push($listaAlunos, $aluno);
                
            }
            
            return($listaAlunos);
            
           //Falta incluir as listas: listaTreinos, mas é preciso ligar no banco a tabela aluno com a tabela treino           
         }
    }
}
?>