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
    
    function listar($pessoa, $fetchType)
    {   
        //falta conferir pessoa nulo
        return $this->getRepositorioDieta()->listar($pessoa, $fetchType);
    }
    
    function inserir($dieta)
    {
        
        if(ExpressoesRegulares::validarDieta($dieta))
        {
            $this->getRepositorioDieta()->inserir($dieta);
        }
    }
    
    function excluir($dieta)
    {
        if($dieta!=null || $dieta!="")
        {
            $this->getRepositorioDieta()->excluir($dieta);
        }
        else
        {
            throw Excecoes::excluirObjeto("Dieta");
        }
    }
    
    function detalhar($dieta,$fetchType)
    {
        if($dieta == null || $dieta == "")
        {
            throw new Exception(Excecoes::detalharObjeto("Dieta"));
        }
        else
        {
            return $this->getRepositorioDieta()->detalhar($dieta,$fetchType);
        }
    }
    
    function alterar($dieta)
    {
        if($dieta == null || $dieta == "")
        {
            throw Excecoes::alterarObjeto("Dieta");
        }
        else
        {
            $this->getRepositorioDieta()->alterar($dieta);
        }
    }


}
