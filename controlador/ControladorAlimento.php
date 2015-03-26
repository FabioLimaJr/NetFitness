<?php
/**
 * Description of ControladorAlimento
 *
 * @author Marcelo
 */

include ($serverPath.'repositorio/RepositorioAlimento.php');

class ControladorAlimento {
    
    private $repositorioAlimento;
    
    function __construct() {
        $this->setRepositorioAlimento(new RepositorioAlimento());
    }
    function getRepositorioAlimento() {
        return $this->repositorioAlimento;
    }

    function setRepositorioAlimento($repositorioAlimento) {
        $this->repositorioAlimento = $repositorioAlimento;
    }

    public function inserir($alimento) {
        
        if(!ExpressoesRegulares::conferirDescricao($alimento->getDescricao())){
            throw new Exception(Excecoes::descricaoInvalida($alimento->getDescricao()));
        }else if (($alimento->getCaloria() == NULL) && ($alimento->getCaloria() == "") && 
                ($alimento->getCaloria() == 0)){
            throw new Exception(Excecoes::valorNumericoInvalido($alimento->getCaloria()));
        }else if (($alimento->getProteina() == NULL) && ($alimento->getProteina() == "") && 
                ($alimento->getProteina() == 0)){
            throw new Exception(Excecoes::valorNumericoInvalido($alimento->getProteina()));
        }else if (($alimento->getCarboidrato() == NULL) && ($alimento->getCarboidrato() == "") && 
                ($alimento->getCarboidrato() == 0)){
            throw new Exception(Excecoes::valorNumericoInvalido($alimento->getCarboidrato()));
        }else if (($alimento->getGordura() == NULL) && ($alimento->getGordura() == "") && 
                ($alimento->getGordura() == 0)){
            throw new Exception(Excecoes::valorNumericoInvalido($alimento->getGordura()));
        }else{
            return $this->getRepositorioAlimento()->inserir($alimento);
        }
    }
    
    public function alterar($alimento) {
        
        if(!ExpressoesRegulares::conferirDescricao($alimento->getDescricao())){
            throw new Exception(Excecoes::descricaoInvalida($alimento->getDescricao()));
        }else if (($alimento->getCaloria() == NULL) && ($alimento->getCaloria() == "") && 
                ($alimento->getCaloria() == 0)){
            throw new Exception(Excecoes::valorNumericoInvalido($alimento->getCaloria()));
        }else if (($alimento->getProteina() == NULL) && ($alimento->getProteina() == "") && 
                ($alimento->getProteina() == 0)){
            throw new Exception(Excecoes::valorNumericoInvalido($alimento->getProteina()));
        }else if (($alimento->getCarboidrato() == NULL) && ($alimento->getCarboidrato() == "") && 
                ($alimento->getCarboidrato() == 0)){
            throw new Exception(Excecoes::valorNumericoInvalido($alimento->getCarboidrato()));
        }else if (($alimento->getGordura() == NULL) && ($alimento->getGordura() == "") && 
                ($alimento->getGordura() == 0)){
            throw new Exception(Excecoes::valorNumericoInvalido($alimento->getGordura()));
        }else{
            return $this->getRepositorioAlimento()->alterar($alimento);
        }
    }
    
    public function excluir($alimento) {
        return $this->getRepositorioAlimento()->excluir($alimento);
    }
    
    public function listar() {
        return $this->getRepositorioAlimento()->listar();
    }
    
    public function detalhar($alimento) {
        return $this->getRepositorioAlimento()->detalhar($alimento);
    }
}
