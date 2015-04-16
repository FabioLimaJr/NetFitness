<?php

/**
 * Description of RepositorioInstrutor
 *
 * @author Marcelo
 */

include($serverPath.'interfaceRepositorio/IRepositorioInstrutor.php');
include_once($serverPath.'repositorioGenerico/RepositorioGenerico.php');
include_once($serverPath.'excecoes/Excecoes.php');

class RepositorioInstrutor extends RepositorioPessoa implements IRepositorioInstrutor{
    
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
                   // $this->fecharConexao();
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

            if (!$this->alterarPessoa($instrutor)) 
            {
                throw new Exception(Excecoes::alterarObjeto("Instrutor: " . mysqli_error($this->getConexao())));
            } 
            else 
            {

                $sql = "UPDATE instrutor SET idCoordenador='" . $instrutor->getCoordenador()->getIdCoordenador();
                $sql.= "' WHERE idInstrutor='" . $instrutor->getIdInstrutor() . "'";
                //falta alterar as demais listas atreladas se for preciso


                if (!mysqli_query($this->getConexao(), $sql)) 
                {
                    throw new Exception(Excecoes::alterarObjeto("Instrutor: " . mysqli_error($this->getConexao())));
                }
                else
                {
                    //$this->fecharConexao();
                }
            }
        } 
        else 
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }

    public function excluir($instrutor) 
    {
        $sql = "USE " . $this->getNomeBanco();

        if (@$this->getConexao()->query($sql) === TRUE) 
        {
            $id = $instrutor->getIdInstrutor();
            
            $sql = "DELETE FROM instrutor where idInstrutor = '".$id."'";
            
            if (!mysqli_query($this->getConexao(), $sql)) 
            {
                throw new Exception(Excecoes::excluirObjetosRelacionados("Instrutor: " . mysqli_error($this->getConexao())));
            }

            $sql = "DELETE FROM pessoa WHERE idPessoa = '" . $id . "'";

            if (!mysqli_query($this->getConexao(), $sql)) 
            {
                throw new Exception(Excecoes::excluirObjeto("Instrutor: " . mysqli_error($this->getConexao())));
            }
            else 
            {
                //$this->fecharConexao();
            }
  
        } 
        else 
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }

    }

    public function detalhar($instrutor, $fetchType) 
    {
         $sql = "USE " . $this->getNomeBanco();

        if($this->getConexao()->query($sql) === TRUE)
        {
            $sqlInstrutor = "SELECT * FROM pessoa,instrutor WHERE pessoa.idPessoa = instrutor.idInstrutor AND "
                    ."instrutor.idInstrutor = '".$instrutor->getIdInstrutor()."'";
            
            try
            {
                $resultInstrutor = mysqli_query($this->getConexao(), $sqlInstrutor);
                $rowInstrutor = mysqli_fetch_assoc($resultInstrutor);
                $instrutorRetornado = new Instrutor($rowInstrutor['idInstrutor'], null/*$coordenador*/,
                                                    null/*$listaTreinos*/, null/*$listaExamesFisicos*/, 
                                                    null/*$listaDicas*/, $rowInstrutor['nome'], 
                                                    $rowInstrutor['cpf'], $rowInstrutor['endereco'], 
                                                    $rowInstrutor['senha'], $rowInstrutor['telefone'], 
                                                    $rowInstrutor['email'], $rowInstrutor['login']);
            }
            catch (Exception $exc)
            {
                throw new Exception($exc->getMessage());
            }
            
            if($fetchType === EAGER)
            {
                //Coordenador
                $instrutorRetornado->setCoordenador($this->detalharObjeto(new Coordenador($rowInstrutor['idCoordenador']), LAZY));
                
                //Lista Treinos
                $listaTreinos = $this->listarObjetos(new Treino(), $instrutorRetornado, LAZY);
                $instrutorRetornado->setListaTreinos($listaTreinos);
                
                //Lista Exames Fisicos
                $listaExamesFisicos = $this->listarObjetos(new ExameFisico(), $instrutorRetornado, LAZY);
                $instrutorRetornado->setListaExamesFisicos($listaExamesFisicos);
                
                //Lista Dicas
                $listaDicas = Array();
                $sqlInstrutorDica = "SELECT * FROM instrutorDica WHERE idInstrutor ='".$rowInstrutor['idInstrutor']."'";
                try
                {
                    $resultInstrutorDica = mysqli_query($this->getConexao(), $sqlInstrutorDica);
                    $repositorioDica  = new RepositorioDica();
                    
                    while ($rowInstrutorDica = mysqli_fetch_array($resultInstrutorDica)) 
                    {
                        $dica = $this->detalharObjeto(new Dica($rowInstrutorDica['idDica']), LAZY);
                        array_push($listaDicas, $dica);
                    }

                    $instrutorRetornado->setListaDicas($listaDicas);
                }
                catch(Exception $ecx)
                {
                    throw new Exception($exc->getMessage());
                }           
                
            }       
            
            return $instrutorRetornado;
        }
        else 
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }
    
    public function listar($fetchType) 
    {
        $listaInstrutores = array();
        
        $sql = "USE " . $this->getNomeBanco();
            
        if($this->getConexao()->query($sql) === TRUE)
        {         
            $sqlInstrutor = "SELECT * FROM pessoa,instrutor WHERE pessoa.idPessoa = instrutor.idInstrutor";
            
            try
            {
                $resultInstrutor = mysqli_query($this->getConexao(), $sqlInstrutor);

                while ($rowInstrutor = mysqli_fetch_array($resultInstrutor)) 
                {      
                    $instrutorRetornado = new Instrutor($rowInstrutor['idPessoa']);

                    if($fetchType == EAGER)
                    {  
                        $instrutorRetornado = $this->detalhar($instrutorRetornado, EAGER);                  
                    }
                    else 
                    {
                        $instrutorRetornado = $this->detalhar($instrutorRetornado, LAZY);    
                    }            

                    array_push($listaInstrutores, $instrutorRetornado);

                }
            }
            catch (Exception $exc)
            {
                throw new Exception($exc->getMessage());
            }                       
            return($listaInstrutores);                    
         }
         else 
         {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
         }
    }
    
    public function logar($instrutor)
    {    
        $sql = "USE " . $this->getNomeBanco();
        
        $instrutorReturn = null;
        
        if($this->getConexao()->query($sql) === TRUE)
        {
            $pessoa = $this->logarPessoa($instrutor);
        
            if($pessoa != NULL)
            {
                $query = "SELECT * FROM instrutor WHERE instrutor.idInstrutor = '".$pessoa->getIdPessoa()."' LIMIT 0,1";
               
                $result = mysqli_query($this->getConexao(), $query);
                
                    while($row = mysqli_fetch_array($result))
                    {                  
                                              
                        $instrutorReturn = new Instrutor($pessoa->getIdPessoa(),
                                                         $row['idCoordenador'],
                                                         array(),//listaTreinos
                                                         array(),//listaExamesFisicos
                                                         array(),//listaDicas
                                                         $pessoa->getNome(),
                                                         $pessoa->getCpf(),
                                                         $pessoa->getEndereco(),
                                                         $pessoa->getSenha(),
                                                         $pessoa->getTelefone(),
                                                         $pessoa->getEmail(),
                                                         $pessoa->getLogin());
                    }
                
                return $instrutorReturn;
            }
            
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }           
    }
}
?>    
