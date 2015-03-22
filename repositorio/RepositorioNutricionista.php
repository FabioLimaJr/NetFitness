<?php
/**
 * Description of RepositorioNutricionista
 *
 * @author Erick
 */

include($serverPath.'interfaceRepositorio/IRepositorioNutricionista.php');
include_once($serverPath.'repositorioGenerico/RepositorioGenerico.php');
include_once($serverPath.'excecoes/Excecoes.php');

class RepositorioNutricionista extends RepositorioGenerico implements IRepositorioNutricionista{
    
    public function __construct() 
    {
       parent::__construct();
    } 

    /** 
     * @param type $nutricionista
     * @return type
     * @throws Exception
     */
    public function inserir($nutricionista) 
    {
        $idReturn = -1;
        $sql = "USE " . $this->getNomeBanco();
        if (@$this->getConexao()->query($sql) === TRUE) 
        {
            if ($this->inserirPessoa($nutricionista)) 
            {
                $id = mysqli_insert_id($this->getConexao());
                $idReturn = $id;
                $sql = "INSERT INTO nutricionista values('";
                $sql.= $id . "','";
                $sql.= $nutricionista->getCrn(). "','";
                $sql.= $nutricionista->getCoordenador()->getIdCoordenador() . "')";
                if (mysqli_query($this->getConexao(), $sql)) 
                {
                    $this->fecharConexao();
                    $nutricionista->setIdNutricionista($idReturn);
                    return $nutricionista;
                    //return $idReturn;
                } 
                else 
                {
                    throw new Exception(Excecoes::inserirObjeto("Nutricionista: ".mysqli_error($this->getConexao())));
                }
            } 
            else 
            {
                throw new Exception(Excecoes::inserirObjeto("Nutricionista: ".mysqli_error($this->getConexao())));
            }
        } 
        else 
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error).")");
        }
    } 
    
    public function alterar($nutricionista) 
    {
        $sql = "USE " . $this->getNomeBanco();
        if (@$this->getConexao()->query($sql) === TRUE) 
        {
            if (!$this->alterarPessoa($nutricionista)) 
            {
                throw new Exception(Excecoes::alterarObjeto("Nutricionista: " . mysqli_error($this->getConexao())));
            } 
            else 
            {
                $sql = "UPDATE nutricionista SET idCoordenador='" . $nutricionista->getCoordenador()->getIdCoordenador();
                $sql.= "' WHERE idNutricionista='" . $nutricionista->getIdNutricionista() . "'";
                //falta alterar as demais listas atreladas se for preciso
                if (!mysqli_query($this->getConexao(), $sql)) 
                {
                    throw new Exception(Excecoes::alterarObjeto("Nutricionista: " . mysqli_error($this->getConexao())));
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
    public function excluir($nutricionista) 
    {
        $sql = "USE " . $this->getNomeBanco();
        if (@$this->getConexao()->query($sql) === TRUE) 
        {
            $id = $nutricionista->getIdNutricionista();
            
            $sql = "DELETE FROM nutricionista where idNutricionista = '".$id."'";
            
            if (!mysqli_query($this->getConexao(), $sql)) 
            {
                throw new Exception(Excecoes::excluirObjetosRelacionados("Nutricionista: " . mysqli_error($this->getConexao())));
            }
            $sql = "DELETE FROM pessoa WHERE idPessoa = '" . $id . "'";
            if (!mysqli_query($this->getConexao(), $sql)) 
            {
                throw new Exception(Excecoes::excluirObjeto("Nutricionista: " . mysqli_error($this->getConexao())));
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
    public function detalhar($nutricionista) 
    {
         $sql = "USE " . $this->getNomeBanco();
        if($this->getConexao()->query($sql) === TRUE)
        {

            $sql = "SELECT * FROM pessoa,nutricionista WHERE pessoa.idPessoa = nutricionista.idNutricionista AND "
                    ."nutricionista.idNutricionista = '".$nutricionista->getIdPessoa()."'";
            
            $result = mysqli_query($this->getConexao(), $sql);
            
            while ($row = mysqli_fetch_array($result)) 
            {

                 //function __construct($idNutricionista, $coordenador, $crn, $listaDietas, $listaDicas, 
                         //$nome, $cpf, $endereco, $senha, $telefone, $email, $login){ 



                $nutricionista = new Nutricionista($row['idPessoa'], null/*$coordenador*/, $row['crn'], null/*$listaDietas*/, null/*$listaDicas*/, $row['nome'], $row['cpf'], 
                                           $row['endereco'], $row['senha'], $row['telefone'], $row['email'], $row['login']);
                
                $sql2 = "SELECT * FROM  pessoa WHERE idPessoa = '".$row['idCoordenador']."'";
                $result2 = mysqli_query($this->getConexao(), $sql2); 
                $row2 = mysqli_fetch_assoc($result2);
                
                $coordenador = new Coordenador($row['idCoordenador'], null/*listaNutricionistas*/, null/*listaSecretarias*/, null/*listaNutricionistas*/, $row2['nome'], $row2['cpf'], 
                                               $row2['endereco'], $row2['senha'], $row2['telefone'], $row2['email'], $row2['login']);
                
                $nutricionista->setCoordenador($coordenador);
                
                
                
                //listaDietas
                $listaDietas = Array();
                
                $sql3 = "SELECT * FROM dieta WHERE idNutricionista ='".$row['idPessoa']."'";
                $result3 = mysqli_query($this->getConexao(), $sql3); 
                while ($row3 = mysqli_fetch_array($result3)) 
                {
                    $dieta = new Dieta($row3['idDieta'], $row3['descricao'], null/*listaAlimentos*/,null/*$aluno*/, null/*$nutricionista*/);                
                    array_push($listaDietas, $dieta); 
                    
                }
                $nutricionista->setListaDietas($listaDietas);
                
                          
                //listaDicas
                $listaDicas = Array();
                
                $sql5 = "SELECT * FROM nutricionistadica WHERE idNutricionista ='".$row['idPessoa']."'";
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
                
                $nutricionista->setListaDicas($listaDicas);
                
            }
            return $nutricionista;
        
        }
        else 
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }
    
    public function listar() 
    {
        $listaNutricionistas = array();
        
        $sql = "USE " . $this->getNomeBanco();
    
        
        if($this->getConexao()->query($sql) === TRUE)
        {
        
            
            $sql = "SELECT * FROM pessoa,nutricionista WHERE pessoa.idPessoa = nutricionista.idNutricionista";
            $result = mysqli_query($this->getConexao(), $sql);
            
            while ($row = mysqli_fetch_array($result)) 
            {
                
                $nutricionista = new Nutricionista($row['idPessoa'], null/*coordenador*/, $row['crn'],null/*listaDietas*/,null/*listaDicas*/,
                $row['nome'], $row['cpf'], $row['endereco'], $row['senha'], $row['telefone'],
                $row['email'], $row['login']);
                
                //echo ($row['idCoordenador']);
                
                $sql2 = "SELECT * FROM  pessoa WHERE idPessoa = '".$row['idCoordenador']."'";
                $result2 = mysqli_query($this->getConexao(), $sql2); 
                $row2 = mysqli_fetch_assoc($result2);
                
                $coordenador = new Coordenador($row['idCoordenador'], null/*listaNutricionistas*/, null/*listaSecretarias*/, null/*listaNutricionistas*/, $row2['nome'], $row2['cpf'], 
                                               $row2['endereco'], $row2['senha'], $row2['telefone'], $row2['email'], $row2['login']);
                
                $nutricionista->setCoordenador($coordenador);
                
                array_push($listaNutricionistas, $nutricionista);
                
            }
            
            return($listaNutricionistas);
            
           //Falta incluir as listas: listaTreinos, listaExamesFisicos, ListaDicas                
         }
    }
    
    public function logar($nutricionista)
    {
        $sql = "USE " . $this->getNomeBanco();
        
        $nutricionistaReturn = null;
        
        if($this->getConexao()->query($sql) === TRUE)
        {
            $pessoa = $this->logarPessoa($nutricionista);
            
            if($pessoa != NULL)
            {
                $query = "SELECT * FROM nutricionista WHERE nutricionista.idNutricionista = '".$pessoa->getIdPessoa()."' LIMIT 0,1";
                
                $result = mysqli_query($this->getConexao(), $query);
                
                while($row = mysqli_fetch_array($result))
                    { 
               
                    $nutricionistaReturn = new Nutricionista($pessoa->getIdPessoa(), 
                                                             $row['idCoordenador'],
                                                             $row['crn'], 
                                                             array(),//$listaDietas
                                                             array(),//$listaDicas
                                                             $pessoa->getNome(),
                                                             $pessoa->getCpf(),
                                                             $pessoa->getEndereco(),
                                                             $pessoa->getSenha(),
                                                             $pessoa->getTelefone(),
                                                             $pessoa->getEmail(),
                                                             $pessoa->getLogin());
                }
                
                return $nutricionistaReturn;
            }
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }       
    }
}
?>    