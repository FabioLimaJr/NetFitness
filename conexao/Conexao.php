<?php
/**
 * Description of Conexao
 *
 * @author Daniele
 */

include_once("../constants.php");

class Conexao{
 
 private static $conexao;
 private static $nomeBanco;
 
 function __construct() 
 {
    self::$conexao = new mysqli(DB_SERVER_NAME, DB_USER_NAME, DB_USER_PASSWORD);
    self::$nomeBanco = DB_NAME;
  }
  
public static function getConexao()
{
    if (self::$conexao == null)
    {
        self::$conexao = new mysqli(DB_SERVER_NAME, DB_USER_NAME, DB_USER_PASSWORD);
        self::$nomeBanco = DB_NAME;
    }
    return self::$conexao;
}
  
 public function getNomeBanco() {
     return self::$nomeBanco;
 }
 
 public function fecharConexao()
 {
     $this->getConexao()->close();
 }
}
?>