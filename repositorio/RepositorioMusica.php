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
    
    public function inserir($musica)
    {
        
    }
    
    public function alterar($musica)
    {
        
    }

    public function excluir($musica)
    {
        
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
