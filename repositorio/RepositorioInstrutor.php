<?php

/**
 * Description of RepositorioInstrutor
 *
 * @author Marcelo
 */

include($serverPath.'interfaceRepositorio/IRepositorioInstrutor.php');
include_once($serverPath.'repositorioGenerico/RepositorioGenerico.php');
include_once($serverPath.'excecoes/Excecoes.php');

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
                    $this->fecharConexao();
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
                $this->fecharConexao();
            }
  
        } 
        else 
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }

    }

    public function detalhar($instrutor) 
    {
         $sql = "USE " . $this->getNomeBanco();

        if($this->getConexao()->query($sql) === TRUE)
        {
            $sql = "SELECT * FROM pessoa,instrutor WHERE pessoa.idPessoa = instrutor.idInstrutor AND "
                    ."instrutor.idInstrutor = '".$instrutor->getIdPessoa()."'";
            
            $result = mysqli_query($this->getConexao(), $sql);
            
            while ($row = mysqli_fetch_array($result)) 
            {

                $instrutor = new Instrutor($row['idPessoa'], null/*$coordenador*/, null/*$listaTreinos*/, 
                                           null/*$listaExamesFisicos*/, null/*$listaDicas*/, $row['nome'], $row['cpf'], 
                                           $row['endereco'], $row['senha'], $row['telefone'], $row['email'], $row['login']);
                
                $sql2 = "SELECT * FROM  pessoa WHERE idPessoa = '".$row['idCoordenador']."'";
                $result2 = mysqli_query($this->getConexao(), $sql2); 
                $row2 = mysqli_fetch_assoc($result2);
                
                $coordenador = new Coordenador($row['idCoordenador'], null/*listaInstrutores*/, null/*listaSecretarias*/, null/*listaNutricionistas*/, $row2['nome'], $row2['cpf'], 
                                               $row2['endereco'], $row2['senha'], $row2['telefone'], $row2['email'], $row2['login']);
                
                $instrutor->setCoordenador($coordenador);
                
                
                
                //listaTreinos
                $listaTreinos = Array();
                
                $sql3 = "SELECT * FROM treino WHERE idInstrutor ='".$row['idPessoa']."'";
                $result3 = mysqli_query($this->getConexao(), $sql3); 
                while ($row3 = mysqli_fetch_array($result3)) 
                {
                    $treino = new Treino($row3['idTreino'], $row3['nome'], $row3['descricao'], null/*$instrutor*/);                
                    array_push($listaTreinos, $treino); 
                    
                }
                $instrutor->setListaTreinos($listaTreinos);
                
                
                //listaExamesFisicos
                $listaExamesFisicos = Array();
                
                $sql4 = "SELECT * FROM examefisico WHERE idInstrutor ='".$row['idPessoa']."'";
                $result4 = mysqli_query($this->getConexao(), $sql4); 
                while ($row4 = mysqli_fetch_array($result4)) 
                {
                                
                    
                    $exameFisico = new ExameFisico($row4['idExame'], $row4['data'], $row4['descricao'], null/*$aluno*/, null/*$instrutor*/);
                    
                    array_push($listaExamesFisicos, $exameFisico); 
                    //completar com o aluno
                    
                }
                $instrutor->setListaExamesFisicos($listaExamesFisicos);
                
                
                
                
                
                //listaDicas
                $listaDicas = Array();
                
                $sql5 = "SELECT * FROM instrutordica WHERE idInstrutor ='".$row['idPessoa']."'";
                $result5 = mysqli_query($this->getConexao(), $sql5); 
                while ($row5 = mysqli_fetch_array($result5)) 
                {
                      $idDica = $row5['idDica'];
                      
                      $sql5B = "SELECT * FROM dica WHERE idDica='".$idDica."'";  
                      $result5B = mysqli_query($this->getConexao(), $sql5B); 
                      while ($row5B = mysqli_fetch_array($result5B)) 
                      {
                          $dica = new Dica($row5B['idDica'], $row5B['descricao'], $row5B['titulo']);
                          array_push($listaDicas, $dica);
                      }
                    
                }
                
                $instrutor->setListaDicas($listaDicas);
                
            }
            return $instrutor;
        }
        else 
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }
    
    public function listar() 
    {
        $listaInstrutores = array();
        
        $sql = "USE " . $this->getNomeBanco();
    
        
        if($this->getConexao()->query($sql) === TRUE)
        {
        
            
            $sql = "SELECT * FROM pessoa,instrutor WHERE pessoa.idPessoa = instrutor.idInstrutor";
            $result = mysqli_query($this->getConexao(), $sql);
            
            while ($row = mysqli_fetch_array($result)) 
            {
                
                $instrutor = new Instrutor($row['idPessoa'], null/*coordenador*/,null/*listaTreinos*/,null/*listaExamesFisicos*/,null/*listaDicas*/,
                $row['nome'], $row['cpf'], $row['endereco'], $row['senha'], $row['telefone'],
                $row['email'], $row['login']);
                
                //echo ($row['idCoordenador']);
                
                $sql2 = "SELECT * FROM  pessoa WHERE idPessoa = '".$row['idCoordenador']."'";
                $result2 = mysqli_query($this->getConexao(), $sql2); 
                $row2 = mysqli_fetch_assoc($result2);
                
                $coordenador = new Coordenador($row['idCoordenador'], null/*listaInstrutores*/, null/*listaSecretarias*/, null/*listaNutricionistas*/, $row2['nome'], $row2['cpf'], 
                                               $row2['endereco'], $row2['senha'], $row2['telefone'], $row2['email'], $row2['login']);
                
                $instrutor->setCoordenador($coordenador);
                
                array_push($listaInstrutores, $instrutor);
                
            }
            
            return($listaInstrutores);
            
           //Falta incluir as listas: listaTreinos, listaExamesFisicos, ListaDicas                
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
