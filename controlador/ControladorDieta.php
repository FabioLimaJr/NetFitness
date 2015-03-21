<?php
/**
 * Description of ControladorAlimento
 *
 * @author Daniele
 */
include ($serverPath.'repositorio/RepositorioDieta.php');

class ControladorDieta
{
    private $repositorioDieta;
    
    public function __construct() 
    {
        $this->setRepositorioDieta(new RepositorioDieta());
    }
    
    function getRepositorioDieta() 
    {
        return $this->repositorioDieta;
    }

    function setRepositorioDieta($repositorioDieta) 
    {
        $this->repositorioDieta = $repositorioDieta;
    }
    
    function listar()
    {
        return $this->getRepositorioDieta()->listar();
    }
    
    function inserir($dieta)
    {
        
        if(ExpressoesRegulares::validarDieta($dieta))
        {
            $this->getRepositorioDieta()->inserir($dieta);
        }
    }


}
