<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RepositorioGenerico
 *
 * @author Daniele
 */


class RepositorioGenerico extends Conexao 
{
       
    public function __construct() 
    {
        parent::__construct();
    }
  
    public function inserirPessoa($pessoa)
    {
        $sql = "INSERT INTO pessoa values(null,'";
        $sql .= $pessoa->getNome()."','";
        $sql .= $pessoa->getCpf()."')";

        if( mysqli_query($this->getConexao(), $sql))
        {return TRUE;}
            else
        {return FALSE;}
    }
 
    
}

?>
