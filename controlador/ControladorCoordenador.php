<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controladorCoordenador
 *
 * @author aluno
 */

include ($serverPath.'repositorio/RepositorioCoordenador.php');

class controladorCoordenador 
{
   private $repositorioCoordenador;
    
    public function __construct() 
    {
        $this->setRepositorioCoordenador(new RepositorioCoordenador());
    }
    
    public function getRepositorioCoordenador() 
    {
        return $this->repositorioCoordenador;
    }

    public function setRepositorioCoordenador($repositorioCoordenador) 
    {
        $this->repositorioCoordenador = $repositorioCoordenador;
    }
    
    public function logar($coordenador)
    {
       return $this->getRepositorioCoordenador()->logar($coordenador);
    }
    
    public function detalhar($coordenador, $fetchType)
    {
        return $this->getRepositorioCoordenador()->detalhar($coordenador, $fetchType);
    }
}
