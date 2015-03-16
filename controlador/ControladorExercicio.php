<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControladorExercicio
 *
 * @author Schmitz
 */

include ($serverPath.'repositorio/RepositorioExercicio.php');

class ControladorExercicio {
    //put your code here
    
    private $repositorioExercicio;
    
    function __construct() {
        $this->repositorioExercicio = new RepositorioExercicio();
    }

    function getRepositorioExercicio() {
        return $this->repositorioExercicio;
    }

    function setRepositorioExercicio($repositorioExercicio) {
        $this->repositorioExercicio = $repositorioExercicio;
    }

    public function inserir($exercicio){
        
        if(!ExpressoesRegulares::conferirNome($exercicio->getNome())){
            
            throw new Exception(Excecoes::nomeInvalido($exercicio->getNome()));
            
        }else if(!ExpressoesRegulares::conferirDescricao($exercicio->getDescricao())){
            
            throw new Exception(Excecoes::descricaoInvalida($exercicio->getDescricao()));
            
        }else{
            return $this->repositorioExercicio->inserir($exercicio);
        }
    }
}
