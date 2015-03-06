<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RepositorioProfessor
 *
 * @author Daniele
 */
class RepositorioProfessor extends RepositorioGenerico implements IRepositorioProfessor {
     function __construct() 
    {
       parent::__construct();
    }
    

    public function alterar($professor) 
    {

        $sql = "USE " . $this->getNomeBanco();

        if (@$this->getConexao()->query($sql) === TRUE) 
        {
            $id = $professor->getIdPessoa();

            $sql = "UPDATE Pessoa SET nome='" . $professor->getNome() . "',";
            $sql.= "cpf='" . $professor->getCpf();
            $sql.= "' WHERE idPessoa='" . $id . "'";

            if (!mysqli_query($this->getConexao(), $sql)) 
            {
                throw new Exception(Excecoes::excecaoAlterarObjeto("Professor: " . mysqli_error($this->getConexao())));
            } 
            else 
            {

                $sql = "UPDATE Professor SET salario='" . $professor->getSalario();
                $sql.= "' WHERE idProfessor='" . $id . "'";
                //falta alterar lista alunos


                if (!mysqli_query($this->getConexao(), $sql)) 
                {
                    throw new Exception(Excecoes::excecaoAlterarObjeto("Professor: " . mysqli_error($this->getConexao())));
                }
                else
                {
                    $this->fecharConexao();
                }
            }
        } 
        else 
        {
            throw new Exception(Excecoes::excecaoSelecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }

    public function excluir($professor) 
    {
        $sql = "USE " . $this->getNomeBanco();

        if (@$this->getConexao()->query($sql) === TRUE) 
        {
            $id = $professor->getIdPessoa();
            $sql = "DELETE FROM pessoa WHERE idPessoa IN (SELECT idAluno FROM aluno WHERE idProfessor = '" . $id . "')";

            if (!mysqli_query($this->getConexao(), $sql)) 
            {
                throw new Exception(Excecoes::excecaoExcluirObjetosRelacionados("Professor: " . mysqli_error($this->getConexao())));
            }

            $sql = "DELETE FROM pessoa WHERE idPessoa = '" . $id . "'";

            if (!mysqli_query($this->getConexao(), $sql)) 
            {
                throw new Exception(Excecoes::excecaoExcluirObjeto("Professor: " . mysqli_error($this->getConexao())));
            }
            else 
            {
                $this->fecharConexao();
            }
  
        } 
        else 
        {
            throw new Exception(Excecoes::excecaoSelecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }

    }
    

    public function inserir($professor) 
    {
        $idReturn = -1;

        $sql = "USE " . $this->getNomeBanco();

        if (@$this->getConexao()->query($sql) === TRUE) 
        {
            echo "Banco '" . $this->getNomeBanco() . "' foi selecionado\n";

            if ($this->inserirPessoa($professor)) 
            {
                $id = mysqli_insert_id($this->getConexao());
                $tableName = strtolower(get_class($professor));
                $idReturn = $id;

                $sql = "INSERT INTO " . $tableName . " values('";
                $sql.= $id . "','";
                $sql.= $professor->getSalario() . "')";


                if (mysqli_query($this->getConexao(), $sql)) 
                {
                    $this->fecharConexao();
                    return $idReturn;
                } 
                else 
                {
                    throw new Exception(Excecoes::excecaoSalvarObjeto("Professor: ".mysqli_error($this->getConexao())));
                }
            } 
            else 
            {
                throw new Exception(Excecoes::excecaoSalvarObjeto("Professor: ".mysqli_error($this->getConexao())));
            }
        } 
        else 
        {
            throw new Exception(Excecoes::excecaoSelecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error).")");
        }
    }
    
}
