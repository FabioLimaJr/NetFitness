<?php

/**
 * Description of controladorExameFisico
 *
 * @author Daniele
 */

include ($serverPath.'repositorio/RepositorioExameFisico.php');


class controladorExameFisico
{
    private $repositorioExameFisico;
    
    public function __construct() 
    {
        $this->setRepositorioExameFisico(new RepositorioExameFisico());
    }

    
    function getRepositorioExameFisico()
    {
        return $this->repositorioExameFisico;
    }

    function setRepositorioExameFisico($repositorioExameFisico)
    {
        $this->repositorioExameFisico = $repositorioExameFisico;
    }
    
    public function inserir($exameFisico)
    {
        if(ExpressoesRegulares::validarExameFisico($exameFisico))
        {
            $this->getRepositorioExameFisico()->inserir($exameFisico);
        }
    }
    
    public function listar($fetchType)
    {
        //conferir obejto
        return $this->getRepositorioExameFisico()->listar($fetchType);
    }
    
    public function detalhar($exameFisico, $fetchType)
    {
        //conferir obejto e fetchType
        return $this->getRepositorioExameFisico()->detalhar($exameFisico, $fetchType);
    }


}
