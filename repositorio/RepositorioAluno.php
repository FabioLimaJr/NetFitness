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
                
                $sql = "UPDATE aluno SET sexo = '".$aluno->getSexo()."'";
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
                    ."aluno.idAluno = '".$aluno->getIdPessoa()."'";
            
            $result = mysqli_query($this->getConexao(), $sql);
            
            while ($row = mysqli_fetch_array($result)) 
            {
                 $aluno = new Aluno($row['idPessoa'], $row['nome'], $row['cpf'], $row['endereco'], $row['senha'], $row['telefone'], 
                                   $row['login'], $row['email'], $row['sexo'], $row['opiniao'], null/*secretaria*/, null/*musica*/, 
                                   null/*$dieta*/, null/*$listaPagamentos*/, null/*$listaTreinos*/);
                
                  
                
                
                $sql2 = "SELECT * FROM  pessoa WHERE idPessoa = '".$row['idSecretaria']."'";
                $result2 = mysqli_query($this->getConexao(), $sql2); 
                $row2 = mysqli_fetch_assoc($result2);
                
                $secretaria = new Secretaria($row['idSecretaria'], $row2['nome'], $row2['cpf'], $row2['endereco'], $row2['senha'], $row2['telefone'], $row2['login'], $row2['email'], null/*$coordenador*/);
                
                $aluno->setSecretaria($secretaria);
                
                
                $sql3 = "SELECT * FROM musica WHERE idMusica ='".$row['idMusica']."'";
                $result3 = mysqli_query($this->getConexao(), $sql3); 
                $row3 = mysqli_fetch_assoc($result3);
                
                $musica = new Musica($row['idMusica'], $row3['titulo'], null/*$secretaria*/);
                
                $aluno->setMusica($musica);
                
                
                $sql4 = "SELECT * FROM dieta WHERE idAluno ='".$row['idAluno']."'";
                $result4 = mysqli_query($this->getConexao(), $sql4); 
                $row4 = mysqli_fetch_assoc($result4);
                
                $dieta = new Dieta($row4['idDieta'], $row4['descricao'], null/*$nutricionista*/, null/*aluno*/);
                
                $aluno->setDieta($dieta);
                
                
                
                
                $listaPagamentos = Array();
                
                $sql5 = "SELECT * FROM pagamento WHERE idAluno ='".$row['idAluno']."'";
                $result5 = mysqli_query($this->getConexao(), $sql5); 
                while ($row5 = mysqli_fetch_array($result5)) 
                {
                    $pagamento = new Pagamento($row5['idPagamento'], $row5['valor'], 
                                               $row5['dataVencimento'], $row5['dataPagamento'], 
                                               null/*$secretaria*/, null/*$aluno*/);
                    array_push($listaPagamentos, $pagamento);
                }
                
                $aluno->setListaPagamentos($listaPagamentos);
                

                
                $listaTreinos = Array();
                
                $sql6 = "SELECT * FROM alunotreino WHERE idAluno ='".$row['idAluno']."'";
                $result6 = mysqli_query($this->getConexao(), $sql6); 
                while ($row6 = mysqli_fetch_array($result6)) 
                {
                    $idTreino = $row6['idTreino'];
                    
                    $sql6B = "SELECT * FROM treino WHERE idTreino = '".$idTreino."'";
                    $result6B = mysqli_query($this->getConexao(), $sql6B);
                    
                    while ($row6B = mysqli_fetch_array($result6B))
                    {
                         $treino = new Treino($idTreino, $row6B['nome'], $row6B['descricao'], null/*$instrutor*/);
                         array_push($listaTreinos, $treino);
                    }
                    
                    $aluno->setListaTreinos($listaTreinos);
                    
                }
           
               
            }
            
            $this->fecharConexao();
            return $aluno;
        }
        else 
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
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
              
                
                $aluno = new Aluno($row['idPessoa'], $row['nome'], $row['cpf'], $row['endereco'], $row['senha'], $row['telefone'], 
                                   $row['login'], $row['email'], $row['sexo'], $row['opiniao'], null/*secretaria*/, $row['idMusica'], 
                                   null/*$dieta*/, null/*$listaPagamentos*/, null/*$listaTreinos*/);
                
                
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
         else 
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }
    
    public function logar($aluno)
    {
        
        $sql = "USE " . $this->getNomeBanco();
        
        $alunoReturn = null;
        
        if($this->getConexao()->query($sql) === TRUE)
        {
            $pessoa = $this->logarPessoa($aluno);
            
            if($pessoa != NULL)
            {
                $query = "SELECT * FROM aluno WHERE idAluno = '".$pessoa->getIdPessoa()."' LIMIT 0,1";
                
                $result = mysqli_query($this->getConexao(), $query);                
                                
                while ($row = mysqli_fetch_array($result))
                {    
                   $alunoReturn = new Aluno($pessoa->getIdPessoa(),
                                            $pessoa->getNome(),
                                            $pessoa->getcpf(),
                                            $pessoa->getEndereco(),
                                            $pessoa->getSenha(),
                                            $pessoa->getTelefone(),
                                            $pessoa->getLogin(),
                                            $pessoa->getEmail(),
                                            $row['sexo'],
                                            $row['opiniao'],
                                            $row['idSecretaria'],
                                            NULL,
                                            NULL,
                                            array(),
                                            array());
                                             
                    
                }
                
                return $alunoReturn;
                
            }
            
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }  
    }
    
}
?>
