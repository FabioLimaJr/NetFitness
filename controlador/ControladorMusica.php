<?php

/**
 * Description of ControloadorMusica
 *
 * @author Daniele
 */

include ($serverPath.'repositorio/RepositorioMusica.php');

class ControladorMusica
{
    private $repositorioMusica;
    
    public function __construct() 
    {
        $this->setRepositorioMusica(new RepositorioMusica());
    }
    
    function getRepositorioMusica() {
        return $this->repositorioMusica;
    }

    function setRepositorioMusica($repositorioMusica) {
        $this->repositorioMusica = $repositorioMusica;
    }
    
    public function listar($fetchType) {
        return $this->getRepositorioMusica($fetchType)->listar($fetchType);
    }
    
    public function detalhar($musica, $fetchType) {
        return $this->getRepositorioMusica()->detalhar($musica, $fetchType);
    }
    
    public function inserir($musica){
        if ($musica->getTitulo() == null && $musica->getTitulo() == "") {
            throw new Exception(Excecoes::tituloInvalida($musica->getTitulo()));
        }else{
            return $this->getRepositorioMusica()->inserir($musica);
        }
    }
    
    public function alterar($musica){
        if ($musica->getTitulo() == null && $musica->getTitulo() == "") {
            throw new Exception(Excecoes::tituloInvalida($musica->getTitulo()));
        }else{
            return $this->getRepositorioMusica()->alterar($musica);
        }    
    }
    
    public function excluir($musica){
        return $this->getRepositorioMusica()->excluir($musica);
    }
}
