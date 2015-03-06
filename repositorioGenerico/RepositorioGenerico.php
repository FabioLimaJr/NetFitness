<?php
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
        $sql .= $pessoa->getCpf()."','";
        $sql .= $pessoa->getEndereco()."','";
        $sql .= $pessoa->getSenha()."','";
        $sql .= $pessoa->getTelefone()."','";
        $sql .= $pessoa->getLogin()."','";
        $sql .= $pessoa->getEmail()."')";

        if( mysqli_query($this->getConexao(), $sql))
        {return TRUE;}
        else
        {return FALSE;}
    }
 
    
}

?>
