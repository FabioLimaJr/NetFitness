<?php
/**
 * Description of controladorDica
 *
 * @author Marcelo
 */

include ($serverPath.'repositorio/RepositorioDica.php');

class ControladorDica {
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

    public function inserir($dica, $pessoa) {
        if(!ExpressoesRegulares::conferirDescricao($dica->getDescricao())){
            throw new Exception(Excecoes::descricaoInvalida($dica->getDescricao()));
        }else if ($dica->getTitulo() == null && $dica->getTitulo() == "") {
            throw new Exception(Excecoes::tituloInvalida($dica->getTitulo()));
        }else if ($dica->getDescricao() == null && $dica->getDescricao() == "") {
            throw new Exception(Excecoes::descricaoInvalida($dica->getDescricao()));
        }else{
             return $this->getRepositorioDica()->inserir($dica, $pessoa);
        }
    }
    
    public function alterar($dica) {
        if(!ExpressoesRegulares::conferirDescricao($dica->getDescricao())){
            throw new Exception(Excecoes::descricaoInvalida($dica->getDescricao()));
        }else if (($dica->getTitulo() == null) && ($dica->getTitulo() == "")) {
            throw new Exception(Excecoes::tituloInvalida($dica->getTitulo()));
        }else if ($dica->getDescricao() == null && $dica->getDescricao() == "") {
            throw new Exception(Excecoes::descricaoInvalida($dica->getDescricao()));
        }else{
             return $this->getRepositorioDica()->alterar($dica);
        }
    }
    
    public function excluir($dica) {
        return $this->getRepositorioDica()->excluir($dica);
    }
    
    public function listar($pessoa) {
        return $this->getRepositorioDica($pessoa)->listar($pessoa);
    }
    
    public function detalhar($dica) {
        return $this->getRepositorioDica()->detalhar($dica);
    }
}
