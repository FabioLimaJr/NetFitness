<?php

/**
 * Description of RepositorioInstrutor
 *
 * @author Marcelo
 */
class RepositorioInstrutor extends RepositorioGenerico implements IRepositorioInstrutor{
    
    public function __construct() 
    {
       parent::__construct();
    } 

    /** 
     * Futuramente podem ser inclusas tres listas para incluir de uma unica vez são elas:
     * $listaTreinos, $listaExamesFisicos e $listaDicas
     * 
     * @param type $instrutor
     * @return type
     * @throws Exception
     */
    public function inserir($instrutor) 
    {
        $idReturn = -1;

        $sql = "USE " . $this->getNomeBanco();

        if (@$this->getConexao()->query($sql) === TRUE) 
        {
            if ($this->inserirPessoa($instrutor)) 
            {
                $id = mysqli_insert_id($this->getConexao());
                $idReturn = $id;

                $sql = "INSERT INTO instrutor values('";
                $sql.= $id . "','";
                $sql.= $instrutor->getCoordenador()->getIdCoordenador() . "')";


                if (mysqli_query($this->getConexao(), $sql)) 
                {
                    $this->fecharConexao();
                    $instrutor->setIdInstrutor($idReturn);
                    return $instrutor;
                    //return $idReturn;
                } 
                else 
                {
                    throw new Exception(Excecoes::inserirObjeto("Instrutor: ".mysqli_error($this->getConexao())));
                }
            } 
            else 
            {
                throw new Exception(Excecoes::inserirObjeto("Instrutor: ".mysqli_error($this->getConexao())));
            }
        } 
        else 
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error).")");
        }

}
    
    public function alterar($instrutor) 
    {

        $sql = "USE " . $this->getNomeBanco();

        if (@$this->getConexao()->query($sql) === TRUE) 
        {
            $id = $instrutor->getIdPessoa();

            $sql = "UPDATE Pessoa SET nome='" . $instrutor->getNome() . "',";
            $sql.= "cpf='" . $instrutor->getCpf();
            $sql.= "' WHERE idPessoa='" . $id . "'";

            if (!mysqli_query($this->getConexao(), $sql)) 
            {
                throw new Exception(Excecoes::excecaoAlterarObjeto("Instrutor: " . mysqli_error($this->getConexao())));
            } 
            else 
            {

                $sql = "UPDATE instrutor SET salario='" . $instrutor->getSalario();
                $sql.= "' WHERE idInstrutor='" . $id . "'";
                //falta alterar lista alunos


                if (!mysqli_query($this->getConexao(), $sql)) 
                {
                    throw new Exception(Excecoes::excecaoAlterarObjeto("Instrutor: " . mysqli_error($this->getConexao())));
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

    public function detalhar($instrutor) {
        
    }
    
    public function listar($instrutor) {
        
    }
}
?>    