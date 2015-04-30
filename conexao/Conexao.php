<?php
/**
 * Description of Conexao
 *
 * @author Daniele
 */

include_once("../constants.php");

class Conexao {
 
 
 private $conexao;
 private $nomeBanco;
 
 public function __construct() 
 {
     
     $this->setNomeBanco();  
     try 
     {
          if($this->getConexao()==NULL)
          {
             $this->criarConexao();
          }
     } 
     catch (Exception $exc) 
     {
         echo $exc->getMessage();
     }
  }
  
  
 public function getNomeBanco() {
     return $this->nomeBanco;
 }
 
 public function setNomeBanco() {
     $this->nomeBanco = DB_NAME;
 }
 
 public function getConexao() {
     return $this->conexao;
 }
 
 public function setConexao($conexao) {
     $this->conexao = $conexao;
 }
 
 private function criarConexao()
 {
   @$this->setConexao(new mysqli(DB_SERVER_NAME, DB_USER_NAME, DB_USER_PASSWORD));
   
   if($this->getConexao()->connect_error)
   {
       throw  new Exception (Excecoes::conexaoInvalida(""));
   }
  
 }
 
 public function fecharConexao()
 {
     $this->getConexao()->close();
 }
}
?>
