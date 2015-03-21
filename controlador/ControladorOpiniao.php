<?php
/**
 * Description of ControladorOpiniao
 *
 * @author Fábio
 */
include ($serverPath.'repositorio/RepositorioOpiniao.php');

class ControladorOpiniao {
    
    private $repositorioOpiniao;
    
    function __construct() {  
        $this->setRepositorioOpiniao(new RepositorioOpiniao());
    }
    
    function getRepositorioOpiniao() {
        return $this->repositorioOpiniao;
    }
    
    function setRepositorioOpiniao($repositorioOpiniao) {
        $this->repositorioOpiniao = $repositorioOpiniao;
    }
    
    public function listar(){
        return $this->repositorioOpiniao->listar(); 
    }
}
