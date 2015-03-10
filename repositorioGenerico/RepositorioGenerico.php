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
 
    public function alterarPessoa($pessoa)
    {
        $sql = "UPDATE pessoa SET nome='" . $pessoa->getNome() . "',";
        $sql.= "cpf='" . $pessoa->getCpf(). "',";
        $sql.= "endereco='" . $pessoa->getEndereco(). "',";
        $sql.= "senha='" . $pessoa->getSenha().  "',";
        $sql.= "telefone='" . $pessoa->getTelefone().  "',";
        $sql.= "login='" . $pessoa->getLogin().  "',";
        $sql.= "email='" . $pessoa->getEmail().  "' ";
        $sql.= "WHERE idPessoa='" . $pessoa->getIdPessoa() . "'";

        if (mysqli_query($this->getConexao(), $sql)) 
        {return TRUE;}
        else
        {return FALSE;}
    }
    
    public function logar($pessoa)
    {
        //$query = "SELECT * FROM pessoa WHERE login = '".$pessoa->getLogin."' AND senha = '".$pessoa->getSenha."' LIMIT 0,1";
        
      
        $query = "SELECT * FROM pessoa WHERE login = '".$pessoa->getLogin()."' AND senha = '".$pessoa->getSenha()."' LIMIT 0,1";
        
        echo $query."<br>";
        
        $result = mysql_query($query);
        $row = mysql_fetch_assoc( $result );
        
        if($row=="")
        {
            echo ('ok');
        }
        else
        {
            echo('nope');
        }
        
    }
}

?>
