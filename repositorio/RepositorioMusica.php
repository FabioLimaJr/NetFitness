<?php

/**
 * Description of RepositorioMusica
 *
 * @author Daniele
 */

include($serverPath.'interfaceRepositorio/IRepositorioMusica.php');
include_once($serverPath.'excecoes/Excecoes.php');
include_once($serverPath.'conexao/Conexao.php');

class RepositorioMusica extends RepositorioGenerico implements IRepositorioMusica
{
    function __construct() {
        parent::__construct();
    }
    
    public function inserir($musica)
    {
        $sql = " USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){
            
            $sql = "INSERT INTO musica VALUES(NULL,'";
            $sql.= $musica->getTitulo(). "','";
            $sql.= $musica->getSecretaria()->getIdSecretaria(). "')"; 
            
            if(mysqli_query($this->getConexao(), $sql)){
                //$this->fecharConexao();
            }else{
                throw new Exception(Excecoes::inserirObjeto("Musica: ". mysqli_error($this->getConexao())));
            }
            
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->erro.")"));
        }        
    }
    
    public function alterar($musica)
    {
        $sql = " USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){
            
            $sql = "UPDATE musica SET titulo = '".$musica->getTitulo();
            $sql.= "'  WHERE idMusica = '".$musica->getIdmusica()."'";
            
            if(mysqli_query($this->getConexao(), $sql)){
               // $this->fecharConexao();
            }else{
                throw new Exception(Excecoes::alterarObjeto("Musica: ". mysqli_error($this->getConexao())));
            }
        
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->erro.")"));
        }       
    }

    public function excluir($musica)
    {
        $sql = "USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){
            
            $sql = "DELETE FROM musica WHERE idMusica = '".$musica->getIdMusica()."'";
            
            if(mysqli_query($this->getConexao(), $sql)){
                //$this->fecharConexao();
            }else {
                throw new Exception(Excecoes::excluirObjeto("musica: ". mysqli_error($this->getConexao())));
            }
        
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->erro.")"));
        }
    }  

    public function listar($fetchType)
    {
        $listaMusicas = array();        
        $sql = "USE " . $this->getNomeBanco();
            
        if($this->getConexao()->query($sql) === TRUE)
        {         
            $sqlMusica = "SELECT * FROM musica";
            
            try
            {
                $resultMusica = mysqli_query($this->getConexao(), $sqlMusica);

                while ($rowMusica = mysqli_fetch_array($resultMusica)) 
                {      
                    $musicaRetornada = new Musica($rowMusica['idMusica']);

                    if($fetchType == EAGER)
                    {  
                        $musicaRetornada = $this->detalhar($musicaRetornada, EAGER);                  
                    }
                    else 
                    {
                        $musicaRetornada = $this->detalhar($musicaRetornada, LAZY);    
                    }            

                    array_push($listaMusicas, $musicaRetornada);

                }
            }
            catch (Exception $exc)
            {
                throw new Exception($exc->getMessage());
            }           
            
            return($listaMusicas);                    
         }
         else 
         {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
         }
    }
    
    
    public function detalhar($musica, $fetchType)
    {
        
        $sql = "USE " . $this->getNomeBanco();
 
        if($this->getConexao()->query($sql) === TRUE)
        {
            $sqlMusica = "SELECT * FROM musica WHERE idMusica = '".$musica->getIdMusica()."'";
         
            try
            {
                $resultMusica = mysqli_query($this->getConexao(), $sqlMusica);              
                $rowMusica = mysqli_fetch_assoc($resultMusica);
                $musicaRetornada = new Musica($rowMusica['idMusica'], $rowMusica['titulo'], null/*$secretaria*/);
               
            }
            catch(Exception $exc)
            {
                throw new Exception($exc->getMessage());
            }
            
            if($fetchType === EAGER)
            {               
                $musicaRetornada->setSecretaria($this->detalharObjeto(new Secretaria($rowMusica['idSecretaria']), LAZY));               
            }
        
            return $musicaRetornada;
       }
       else
       {
           throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
       }
    }

}
