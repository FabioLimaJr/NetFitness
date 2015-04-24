<?php
/**
 * Description of RepositorioAluno
 *
 * @author Daniele
 */

include($serverPath.'interfaceRepositorio/IRepositorioAluno.php');
include_once('RepositorioPessoa.php');
include_once($serverPath.'excecoes/Excecoes.php');

class RepositorioAluno extends RepositorioPessoa implements IRepositorioAluno
{
 
    
    function __construct() 
    {
       parent::__construct();
    }
   
     public function inserir($aluno)
     {       
        $sql = "USE " . $this->getNomeBanco();
        
        if (@$this->getConexao()->query($sql) === TRUE) 
        {
            $this->getConexao()->autocommit(FALSE); 
            
            if ($this->inserirPessoa($aluno)) 
            {
                $arrayData = explode("-", $aluno->getDataNascimento());
                $dataSqlFormat = $arrayData[2]."-".$arrayData[1]."-".$arrayData[0];
                
                $id = mysqli_insert_id($this->getConexao());
                $idReturn = $id;
                $sql = "INSERT INTO aluno values('";
                $sql.= $id ."','";
                $sql.= $aluno->getSexo()."','";
                $sql.= $dataSqlFormat."','";  
                $sql.= $aluno->getFoto()."','";
                $sql.= $aluno->getSecretaria()->getIdSecretaria()."',";  
                $sql.= "null)"; //musica
                
                if (mysqli_query($this->getConexao(), $sql)) 
                {
                    $this->getConexao()->commit();
                    $aluno->setIdAluno($idReturn);
                    return $aluno;
                } 
                else 
                {
                    $this->getConexao()->rollback();
                    throw new Exception(Excecoes::inserirObjeto("Aluno: ".mysqli_error($this->getConexao())));
                }
            } 
            else 
            {
                $this->getConexao()->rollback();
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
                $sql.= ", dataNascimento = '".ExpressoesRegulares::inverterData($aluno->getDataNascimento())."'";
                $sql.= " WHERE idAluno= '".$aluno->getIdAluno()."'";
                //falta alterar as demais listas atreladas se for preciso
                
                if (!mysqli_query($this->getConexao(), $sql)){
                    throw new Exception(Excecoes::alterarObjeto("Aluno: " . mysqli_error($this->getConexao())));
                }
                else{
                    //$this->fecharConexao();
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
            
            if (!$this->excluirPessoa($aluno)){
                throw new Exception(Excecoes::excluirObjeto("Aluno: " . mysqli_error($this->getConexao())));
            }  
        } 
        else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }
    
    public function detalhar($aluno,$fetchType) 
    {
        $sql = "USE " . $this->getNomeBanco();

        if($this->getConexao()->query($sql) === TRUE)
        {
            
            $sqlAluno = "SELECT * FROM pessoa,aluno WHERE pessoa.idPessoa = aluno.idAluno AND "
                    ."aluno.idAluno = '".$aluno->getIdPessoa()."'";
            
            try
            {
                $resultAluno = mysqli_query($this->getConexao(), $sqlAluno);
                $rowAluno = mysqli_fetch_assoc($resultAluno);
                $alunoRetornado = new Aluno($rowAluno['idAluno'], $rowAluno['nome'], $rowAluno['cpf'], $rowAluno['endereco'], 
                                   $rowAluno['senha'], $rowAluno['telefone'], $rowAluno['login'],$rowAluno['email'], 
                                   $rowAluno['sexo'], $rowAluno['dataNascimento'], null/*secretaria*/, null/*musica*/, 
                                   null/*$dieta*/, null/*$listaPagamentos*/, null/*$listaTreinos*/, $rowAluno['foto']);
             }
             catch(Exception $exc)
             {
                 throw new Exception($exc->getMessage());
             }
                
            if($fetchType === EAGER)
            {
                //Secretaria
                $alunoRetornado->setSecretaria($this->detalharObjeto(new Secretaria($rowAluno['idSecretaria']), LAZY));
               
                //Musica
                $alunoRetornado->setMusica($this->detalharObjeto(new Musica($rowAluno['idMusica']), LAZY)); 

                //Dieta  
                $alunoRetornado->setDieta($this->listarObjetos(new Dieta(), $alunoRetornado, LAZY)) ;
              
                //Pagamentos
                $alunoRetornado->setListaPagamentos($this->listarObjetos(new Pagamento(), $alunoRetornado, LAZY));

                
                $listaTreinos = Array();

                $sqlAlunoTreino = "SELECT * FROM alunotreino WHERE idAluno ='".$rowAluno['idAluno']."'";
                try
                {
                    $resultAlunoTreino = mysqli_query($this->getConexao(), $sqlAlunoTreino);
                    $repositorioTreino  = new RepositorioTreino();
                    
                    while ($rowAlunoTreino = mysqli_fetch_array($resultAlunoTreino)) 
                    {
                        $treino = $this->detalharObjeto(new Treino($rowAlunoTreino['idTreino']), LAZY);
                        $treino->setData($rowAlunoTreino['data']);
                        array_push($listaTreinos, $treino);
                    }

                    $alunoRetornado->setListaTreinos($listaTreinos); 
                }
                catch(Exception $ecx)
                {
                    throw new Exception($exc->getMessage());
                }
                
            }
            
            return $alunoRetornado;
        }
        else 
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }
    
    
    public function listar($fetchType) 
    {
        $listaAlunos = array();       
        $sql = "USE " . $this->getNomeBanco();
            
        if($this->getConexao()->query($sql) === TRUE)
        {      
            $sqlAluno = "SELECT * FROM pessoa,aluno WHERE pessoa.idPessoa = aluno.idAluno";           
            try
            {
                $resultAluno = mysqli_query($this->getConexao(), $sqlAluno);
                
                while ($rowAluno = mysqli_fetch_array($resultAluno)) 
                {      
                    $alunoRetornado = new Aluno($rowAluno['idPessoa']);

                    if($fetchType == EAGER)
                    {  
                        $alunoRetornado = $this->detalhar($alunoRetornado, EAGER);                  
                    }
                    else 
                    {
                        $alunoRetornado = $this->detalhar($alunoRetornado, LAZY);    
                    }            
                    array_push($listaAlunos, $alunoRetornado);
                }
            }
            catch (Exception $exc)
            {
                throw new Exception($exc->getMessage());
            }           
            
            return($listaAlunos);                    
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
                 //   $idAluno, $nome, $cpf, $endereco, $senha, $telefone, $login, $email, $sexo, $dataNascimento, $secretaria,
                              //  $musica, $dieta, $listaPagamentos, $listaTreinos, $foto) 
                   $alunoReturn = new Aluno($pessoa->getIdPessoa(),
                                            $pessoa->getNome(),
                                            $pessoa->getcpf(),
                                            $pessoa->getEndereco(),
                                            $pessoa->getSenha(),
                                            $pessoa->getTelefone(),
                                            $pessoa->getLogin(),
                                            $pessoa->getEmail(),
                                            $row['sexo'],
                                            $row['dataNascimento'],
                                            $row['idSecretaria'],
                                            $row['idMusica'],
                                            /*dieta*/null,
                                            /*listaPagamentos*/null,
                                            /*listaTreinos*/null,
                                            $row['foto']);
                                             
                 
                }
                
               // $this->fecharConexao();
                return $alunoReturn;
                
            }
            else
            {
              //  $this->fecharConexao();
                throw new Exception(Excecoes::usuarioInvalido(""));
            }
            
        }
        else
        {
            //$this->fecharConexao();
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }  
    }
    
}
?>
