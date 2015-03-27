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


}
