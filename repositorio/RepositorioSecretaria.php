<?php
/**
 * Description of RepositorioSecretaria
 *
 * @author Fábio
 */
class RepositorioSecretaria extends RepositorioGenerico implements IRepositorioSecretaria {
    //put your code here
    
    public function __construct() 
    {
       parent::__construct();
    }
    
    public function inserir($secretaria){
        
        $idReturn = -1;
        
        $sql = "USE " . $this->getNomeBanco();
        
        if(@$this->getConexao()->query($sql) === TRUE){
            
            if($this->inserirPessoa($secretaria)){
                
                $id = mysqli_insert_id($this->getConexao());
                $idReturn = $id;
                
                $sql = "INSERT INTO secretaria values('";
                $sql.= $id . "','";
                $sql.= $secretaria->getCoordenador()->getIdCoordenador() . "')";
            }
        }
    }
    
    public function alterar($secretaria){
        
    }
    
    public function excluir($secretaria){
        
    }
    
    public function listar(){
        $listaSecretarias = array();
        
        $sql = "USE " . $this->getNomeBanco();
        
        /*
         * $loop = mysql_query("SELECT * FROM members")
         or die (mysql_error());

        while ($row = mysql_fetch_array($loop))
        {
             echo $row['id'] . " " . $row['name'] . " " . $row['email'] . " "  . $row['logged_on'] . "<br/>";
}
         */
        
        if(@$this->getConexao()->query($sql) === TRUE){
            
            $sql = "SELECT * FROM pessoa,secretaria WHERE pessoa.idPessoa = secretaria.idSecretaria";
            $result = mysqli_query($this->getConexao(), $sql);
            
            while ($row = mysqli_fetch_array($result)) {
                $secretaria = new Secretaria($row['idSecretaria'], $row['nome'],
                        $row['cpf'], $row['endereco'], $row['senha'], $row['telefone'],
                        $row['login'], $row['email'], NULL);
                
                array_push($listaSecretarias, $secretaria);
                
            }
            var_dump($listaSecretarias);
            
          //(mysqli_num_rows($result) > 0 )
                    
                                 
                
            
            
            
        }
    }
}
