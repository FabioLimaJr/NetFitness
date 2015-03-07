<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

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

    
    public function alterar($aluno) 
    {
        $sql = "USE " . $this->getNomeBanco();

        if (@$this->getConexao()->query($sql) === TRUE)
        {
            $id = $aluno->getIdPessoa();

            $sql = "UPDATE Pessoa SET nome='" . $aluno->getNome() . "',";
            $sql.= "cpf='" . $aluno->getCpf();
            $sql.= "' WHERE idPessoa='" . $id . "'";

            if (!mysqli_query($this->getConexao(), $sql)) 
            {
                throw new Exception("Impossível alterar o objeto " . get_class($aluno) . ": " . mysqli_error($this->getConexao()));
            } 
            else 
            {

                $sql = "UPDATE Professor SET opiniao='" . $aluno->getOpiniao();
                $sql.= "' WHERE idAluno='" . $id . "'";

                if (!mysqli_query($this->getConexao(), $sql)) 
                {
                    throw new Exception(Excecoes::excecaoAlterarObjeto("Aluno: " . mysqli_error($this->getConexao())));
                }
            }
        } 
        else 
        {
            throw new Exception(Excecoes::excecaoSelecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error).")");
        }
    }

    public function excluir($aluno) 
    {

        $sql = "USE " . $this->getNomeBanco();

        if (@$this->getConexao()->query($sql) === TRUE) 
        {

            $id = $aluno->getIdPessoa();
            $sql = "DELETE FROM pessoa WHERE idPessoa = '" . $id . "'";

            if (!mysqli_query($this->getConexao(), $sql)) 
            {
                throw new Exception(Excecoes::excecaoExcluirObjeto("Aluno: " . mysqli_error($this->getConexao())));
            } 
            else 
            {
                $this->fecharConexao();
            }
        } 
        else 
        {
            throw new Exception(Excecoes::excecaoSelecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error).")");
        }
    }

    public function inserir($aluno) 
    {
        
        $idReturn = -1;
        $sql = "USE " . $this->getNomeBanco();

        if (@$this->getConexao()->query($sql) === TRUE) 
        {
            echo "Banco '" . $this->getNomeBanco() . "' foi selecionado\n";

            $id = $aluno->getProfessor()->getIdPessoa();
            $sql = "SELECT idProfessor FROM professor WHERE idProfessor = '$id'";
            $result = mysqli_query($this->getConexao(), $sql);

            if (mysqli_num_rows($result) > 0) 
            {

                if ($this->inserirPessoa($aluno)) 
                {
                    $id = mysqli_insert_id($this->getConexao());

                    $idReturn = $id;
                    $sql = "INSERT INTO aluno values('";
                    $sql.= $id . "','";
                    $sql.= $aluno->getProfessor()->getIdPessoa() . "','";
                    $sql.= $aluno->getOpiniao() . "')";


                    if (mysqli_query($this->getConexao(), $sql)) 
                    {
                        $this->fecharConexao();
                        return $idReturn;
                    } 
                    else 
                    {
                        throw new Exception(Excecoes::excecaoSalvarObjeto("Aluno: " . mysqli_error($this->getConexao())));
                        //todo: delete parent rollback;
                    }
                } 
                else 
                {
                    throw new Exception(Excecoes::excecaoSalvarObjeto("Aluno: " . mysqli_error($this->getConexao())));
                }
            } 
            else 
            {
                throw new Exception(Excecoes::excecaoParent("Aluno", "Professor"));
            }
        } 
        else 
        {
            throw new Exception(Excecoes::excecaoSelecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error).")");
        }
    }

    public function detalhar($aluno) {
        
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
