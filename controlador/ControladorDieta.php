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
    
    function listar($nutricionista)
    {   
        //falta conferir nutricionista nulo
        return $this->getRepositorioDieta()->listar($nutricionista);
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
    
    function detalhar($dieta)
    {
        if($dieta == null || $dieta == "")
        {
            throw Excecoes::detalharObjeto("Dieta");
        }
        else
        {
            return $this->getRepositorioDieta()->detalhar($dieta);
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
