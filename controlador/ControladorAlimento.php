<?php
/**
 * Description of ControladorAlimento
 *
 * @author Daniele
 */
include ($serverPath.'repositorio/RepositorioAlimento.php');

class ControladorAlimento 
{
    private $repositorioAlimento;
    
    public function __construct() 
    {
        $this->setRepositorioAlimento(new RepositorioAlimento());
    }
    
    function getRepositorioAlimento() 
    {
        return $this->repositorioAlimento;
    }

    function setRepositorioAlimento($repositorioAlimento) 
    {
        $this->repositorioAlimento = $repositorioAlimento;
    }
    
    function listar()
    {
        return $this->getRepositorioAlimento()->listar();
    }


}
