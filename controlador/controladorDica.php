<?php
/**
 * Description of controladorDica
 *
 * @author Marcelo
 */

include ($serverPath.'repositorio/RepositorioDica.php');

class controladorDica {
    private $repositorioDica;
    
    public function __construct() 
    {
        $this->setRepositorioDica(new RepositorioDica());
    }
    
    function getRepositorioDica() {
        return $this->repositorioDica;
    }

    function setRepositorioDica($repositorioDica) {
        $this->repositorioDica = $repositorioDica;
    }

    public function inserir($dica) {
        if(!ExpressoesRegulares::conferirDescricao($dica->getDescricao())){
            throw new Exception(Excecoes::descricaoInvalida($dica->getDescricao()));
        }else if (!ExpressoesRegulares::conferirNome($dica->getTitulo())) {
            throw new Exception(Excecoes::tituloInvalida($dica->getTitulo()));
        }else{
             return $this->getRepositorioDica()->inserir($dica);
        }
    }
    
    public function alterar($dica) {
        if(!ExpressoesRegulares::conferirDescricao($dica->getDescricao())){
            throw new Exception(Excecoes::descricaoInvalida($dica->getDescricao()));
        }else if (!ExpressoesRegulares::conferirNome($dica->getTitulo())) {
            throw new Exception(Excecoes::tituloInvalida($dica->getTitulo()));
        }else{
             return $this->getRepositorioDica()->alterar($dica);
        }
    }
    
    public function excluir($dica) {
        return $this->getRepositorioDica()->excluir($dica);
    }
    
    public function listar() {
        return $this->getRepositorioDica()->listar();
    }
    
    public function detalhar($dica) {
        return $this->getRepositorioDica()->detalhar($dica);
    }
}
