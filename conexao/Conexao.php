<?php
/**
 * Description of Conexao
 *
 * @author Daniele
 */



class Conexao {
 
 const nomeBanco = 'netfitness';   
 const nomeServidor = 'localhost';
 const nomeUsuario = 'root';
 //const senhaUsuario = '';
 const senhaUsuario = '123456';

 
 public $conexao;
 public $nomeBanco;

 
 public function __construct() 
 {
     
     $this->setNomeBanco();  
     try 
     {
         $this->criarConexao();
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
     $this->nomeBanco = self::nomeBanco;
 }

 
 public function getConexao() {
     return $this->conexao;
 }

 public function setConexao($conexao) {
     $this->conexao = $conexao;
 }


 private function criarConexao()
 {
   @$this->setConexao(new mysqli(self::nomeServidor, self::nomeUsuario, self::senhaUsuario));
   
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
