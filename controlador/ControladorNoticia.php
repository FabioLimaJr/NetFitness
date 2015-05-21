<?php
/**
 * Description of ControladorNoticia
 *
 * @author Marcelo
 */

include ($serverPath.'repositorio/RepositorioNoticia.php');

class ControladorNoticia {
    
    private $repositorioNoticia;
    
    public function __construct() 
    {
        $this->setRepositorioNoticia(new RepositorioNoticia());
    }
    function getRepositorioNoticia() {
        return $this->repositorioNoticia;
    }

    function setRepositorioNoticia($repositorioNoticia) {
        $this->repositorioNoticia = $repositorioNoticia;
    }

    public function inserir($noticia){
        
        if ($noticia->getTitulo() == null || $noticia->getTitulo() == "") {
            throw new Exception(Excecoes::tituloInvalida($noticia->getTitulo()));
        }else if ($noticia->getDescricao() == null || $noticia->getDescricao() == "") {
            throw new Exception(Excecoes::descricaoInvalida($noticia->getDescricao()));
        }else if(!ExpressoesRegulares::conferirDescricao($noticia->getDescricao())){
            throw new Exception(Excecoes::descricaoInvalida($noticia->getDescricao()));
        }else{
            return $this->getRepositorioNoticia()->inserir($noticia);
        }
    }
    
    public function alterar($noticia){              
        if ($noticia->getTitulo() == null || $noticia->getTitulo() == "") {
            throw new Exception(Excecoes::tituloInvalida($noticia->getTitulo()));
        }else if ($noticia->getDescricao() == null || $noticia->getDescricao() == "") {
            throw new Exception(Excecoes::descricaoInvalida($noticia->getDescricao()));
        }else if(!ExpressoesRegulares::conferirDescricao($noticia->getDescricao())){
            throw new Exception(Excecoes::descricaoInvalida($noticia->getDescricao()));
        }else{
            
            return $this->getRepositorioNoticia()->alterar($noticia);
            
        }
    }
    
    public function excluir($noticia){
        
        return $this->getRepositorioNoticia()->excluir($noticia);
        
    }
    
    public function listar($secretaria,$fetchType){
        
        return $this->getRepositorioNoticia()->listar($secretaria,$fetchType);
        
    }
    
    public function detalhar($noticia, $fetchType){
        
        return $this->getRepositorioNoticia()->detalhar($noticia, $fetchType);
        
    }
}
