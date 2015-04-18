<?php
/**
 * Description of RepositorioNoticia
 *
 * @author Marcelo
 */

include($serverPath.'interfaceRepositorio/IRepositorioNoticia.php');
include_once($serverPath.'repositorioGenerico/RepositorioGenerico.php');
include_once($serverPath.'excecoes/Excecoes.php');

class RepositorioNoticia extends RepositorioGenerico implements IRepositorioNoticia{
    

    public function inserir($noticia) {
        
        $sql = " USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){

            $sql = "INSERT INTO noticia VALUES('";
            $sql.= "NULL','";
            $sql.= $noticia->getTitulo(). "','";
            $sql.= $noticia->getDescricao(). "','";
            $sql.= $noticia->getSecretaria()->getIdPessoa(). "')";
            
            if(mysqli_query($this->getConexao(), $sql)){
                //$this->fecharConexao();
                return true;
            }else{
                throw new Exception(Excecoes::inserirObjeto("Noticia: ". mysqli_error($this->getConexao())));
            }
            
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->erro.")"));
        }
    }
    
    public function alterar($noticia) {
        
         $sql = " USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){

            $sql = "UPDATE noticia SET titulo = '".$noticia->getTitulo();
            $sql.= "', descricao = '".$noticia->getDescricao();
            $sql.= "'  WHERE IdNoticia = '".$noticia->getIdNoticia()." and ". "'idSecretaria= '".$noticia->getSecretaria()->getIdSecretaria();
            
            if(mysqli_query($this->getConexao(), $sql)){
                //$this->fecharConexao();
                return true;
            }else{
                throw new Exception(Excecoes::alterarObjeto("Noticia: ". mysqli_error($this->getConexao())));
            }
            
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->erro.")"));
        }
    }
    
    public function excluir($noticia) {
        
         $sql = "USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){
            
            $sql = "DELETE FROM noticia WHERE IdNoticia = '".$noticia->getIdNoticia()."'";
            
            if(mysqli_query($this->getConexao(), $sql)){
                //$this->fecharConexao();
                return true;
            }else {
                throw new Exception(Excecoes::excluirObjeto("Noticia: ". mysqli_error($this->getConexao())));
            }
            
        }  else {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->erro.")"));
        }
    }

    public function listar($secretaria,$fetchType) {
        
        $listaNoticiasRetornadas = array();       
        
        $sql = "USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === TRUE)
        {
            $sqlListaNoticias = "SELECT * FROM noticia";
            $sqlListaNoticias = "SELECT * FROM noticia WHERE idSecretaria = ".$secretaria->getIdSecretaria();  
            try
            {
                $resultListaNoticias = mysqli_query($this->getConexao(), $sqlListaNoticias);

                while ($rowListaNoticias = mysqli_fetch_array($resultListaNoticias)) 
                {
                    $noticiaRetornada = new Noticia($rowListaNoticias['idNoticia']);

                    if($fetchType == EAGER)
                    {
                        $noticiaRetornada = $this->detalhar($noticiaRetornada, EAGER);                       
                    }
                    else 
                    {
                        $noticiaRetornada = $this->detalhar($noticiaRetornada, LAZY);    
                    }

                    array_push($listaNoticiasRetornadas, $noticiaRetornada);

                }
            }
            catch (Exception $exc)
            {
                throw new Exception($exc->getMessage());
            }
            
            return $listaNoticiasRetornadas;
        }
        else
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->error.")"));
        }
    }

    public function detalhar($noticia, $fetchType) {
        
        $sqlNoticia = "USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sqlNoticia) === true)
        { 
            $sqlNoticia = "SELECT * FROM noticia WHERE idNoticia = '".$noticia->getIdNoticia()."'";             
            
            try
            {
                $resultNoticia = mysqli_query($this->getConexao(), $sqlNoticia);
                $rowNoticia = mysqli_fetch_assoc($resultNoticia);
                $noticiaRetornada = new Noticia($rowNoticia['idNoticia'], $rowNoticia['titulo'], 
                                                    $rowNoticia['descricao'],null/*$secretaria*/);
            }
            catch (Exception $exc)
            {
                throw new Exception($exc->getMessage());
            }
            
            if($fetchType === EAGER)
            {
               try
               {
                    //Secretaria            
                    $noticiaRetornada->setSecretaria($this->detalharObjeto(new Secretaria($rowNoticia['idSecretaria']), LAZY));
                                
                }
                catch (Exception $exc)
                {
                    throw new Exception($exc->getMessage());
                }
            }         
            
            return $noticiaRetornada;
        }  
        else 
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->error.")"));
        }
    }
    

}
