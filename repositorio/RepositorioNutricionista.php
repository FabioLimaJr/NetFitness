<?php
/**
 * Description of RepositorioNutricionista
 *
 * @author Erick
 */

include($serverPath.'interfaceRepositorio/IRepositorioNutricionista.php');
include_once($serverPath.'repositorioGenerico/RepositorioGenerico.php');
include_once($serverPath.'excecoes/Excecoes.php');

class RepositorioNutricionista extends RepositorioPessoa implements IRepositorioNutricionista{
    
    public function __construct() 
    {
       parent::__construct();
    } 

    public function inserir($nutricionista) 
    {
        $idReturn = -1;
        $sql = "USE " . $this->getNomeBanco();
        if (@$this->getConexao()->query($sql) === TRUE) 
        {
            $this->getConexao()->autocommit(FALSE); 
            
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
                    $this->getConexao()->commit();
                    $nutricionista->setIdNutricionista($idReturn);
                    return $nutricionista;
                    //return $idReturn;
                } 
                else 
                {
                    $this->getConexao()->rollback();
                    throw new Exception(Excecoes::inserirObjeto("Nutricionista: ".mysqli_error($this->getConexao())));
                }
            } 
            else 
            {
                $this->getConexao()->rollback();
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

            $this->getConexao()->autocommit(FALSE); 
            
            if (!$this->alterarPessoa($nutricionista)) 
            {
                $this->getConexao()->rollback();
                throw new Exception(Excecoes::alterarObjeto("Nutricionsta " . mysqli_error($this->getConexao())));
            } 
            else 
            {

                $this->getConexao()->commit();
                
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
        if (@$this->getConexao()->query($sql) === TRUE){
            
            if (!$this->excluirPessoa($nutricionista)){
                throw new Exception(Excecoes::excluirObjeto("Nutricionista: " . mysqli_error($this->getConexao())));
            }  
        } 
        else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }
    
    
    public function detalhar($nutricionista,$fetchType) 
    {
        $sql = "USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === TRUE)
        {

            $sqlNutricionista = "SELECT * FROM pessoa,nutricionista WHERE pessoa.idPessoa = "
                                . "nutricionista.idNutricionista AND "
                                ."nutricionista.idNutricionista = '".$nutricionista->getIdPessoa()."'";
            
            try
            {
                $resultNutricionista = mysqli_query($this->getConexao(), $sqlNutricionista);
                $rowNutricionista = mysqli_fetch_assoc($resultNutricionista);
                $nutricionistaRetornada = new Nutricionista($rowNutricionista['idPessoa'], null/*$coordenador*/, 
                                                            $rowNutricionista['crn'], null/*$listaDietas*/, 
                                                            null/*$listaDicas*/, $rowNutricionista['nome'], 
                                                            $rowNutricionista['cpf'], $rowNutricionista['endereco'], 
                                                            $rowNutricionista['senha'], $rowNutricionista['telefone'], 
                                                            $rowNutricionista['email'], $rowNutricionista['login']);
            }
            catch(Exception $exc)
            {
                throw new Exception($exc->getMessage());
            }
            
            if($fetchType === EAGER)
            {
                
                //Coordenador
                $nutricionistaRetornada->setCoordenador($this->detalharObjeto(new Coordenador($rowNutricionista['idCoordenador']), LAZY));
          
                //Dieta
                $nutricionistaRetornada->setListaDietas($this->listarObjetos(new Dieta(), $nutricionistaRetornada, LAZY));
                      
                //Lista Dicas
                $listaDicas = Array();
                $sqlNutricionistaDica = "SELECT * FROM nutricionistadica WHERE idNutricionista ='".$rowNutricionista['idNutricionista']."'";
                try
                {
                    $resultNutricionistaDica = mysqli_query($this->getConexao(), $sqlNutricionistaDica);
                    $repositorioDica  = new RepositorioDica();
                    
                    while ($rowNutricionistaDica = mysqli_fetch_array($resultNutricionistaDica)) 
                    {
                        $dica = $this->detalharObjeto(new Dica($rowNutricionistaDica['idDica']), LAZY);
                        array_push($listaDicas, $dica);
                    }

                    $nutricionistaRetornada->setListaDicas($listaDicas);
                }
                catch(Exception $ecx)
                {
                    throw new Exception($exc->getMessage());
                }

            }
            
            return $nutricionistaRetornada;
        
        }
        else 
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }
    
    public function listar($fetchType) 
    {
        $listaNutricionistas = array();
        
        $sql = "USE " . $this->getNomeBanco();
            
        if($this->getConexao()->query($sql) === TRUE)
        {
         
            $sqlNutricionista = "SELECT * FROM pessoa,nutricionista WHERE pessoa.idPessoa = nutricionista.idNutricionista";
            
            try
            {
                $resultNutricionista = mysqli_query($this->getConexao(), $sqlNutricionista);

                while ($rowNutricionista = mysqli_fetch_array($resultNutricionista)) 
                {      
                    $nutricionistaRetornada = new Nutricionista($rowNutricionista['idNutricionista']);

                    if($fetchType == EAGER)
                    {  
                        $nutricionistaRetornada = $this->detalhar($nutricionistaRetornada, EAGER);                  
                    }
                    else 
                    {
                        $nutricionistaRetornada = $this->detalhar($nutricionistaRetornada, LAZY);    
                    }            

                    array_push($listaNutricionistas, $nutricionistaRetornada);

                }
            }
            catch (Exception $exc)
            {
                throw new Exception($exc->getMessage());
            }           
            
            return($listaNutricionistas);                    
         }
         else 
         {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
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