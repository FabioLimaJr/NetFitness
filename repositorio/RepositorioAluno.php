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


}

?>
