<?php
/**
 * Description of Excecoes
 *
 * @author Daniele
 */
class Excecoes 
{
    public static function conexaoInvalida($message)
    {
        return "Impossível criar uma conexão com o banco de dados: ".$message."\n";
    }
    
    public static function selecionarBanco($message)
    {
        return "Erro em selecionar o banco de dados: ".$message."\n";
    }
    
    public static function inserirObjeto($message)
    {
        return "Impossível salvar o objeto ".$message."\n";
    }
    
    public static function excluirObjeto($message)
    {
        return "Impossível excluir o objeto ".$message."\n";
    }
    
    public static function excluirObjetosRelacionados($message)
    {
        return "Impossível excluir os objetos relacionados a ".$message."\n";
    }
    
    public static function alterarObjeto($message)
    {
        return "Impossível alterar o objeto ".$message."\n";
    }
    
    public static function parentInvalido($message1,$message2)
    {
        return "Impossível alterar o objeto ".$message1.". O objeto ".$message2." não existe no banco\n";
    }
    
     public static function objetoNulo($message)
    {
        return $message.". O objeto é nulo\n";
    }
    
    //Metodos Referentes as Expressoes Regulares
    
    public static  function nomeInvalido($mensagem){
        return $mensagem."Nome Invalido,Favor Verifique o Nome do Instrutor antes da inclusão\n";
    }
    
    public static  function cpfInvalido($mensagem){
        return $mensagem."Cpf Invalido,Favor Verifique o Cpf do Instrutor antes da inclusão\n";
    }
    
    public static  function emailInvalido($mensagem){
        return $mensagem."Email Invalido,Favor Verifique o Email do Instrutor antes da inclusão\n";
    }
    
    public static  function telefoneInvalido($mensagem){
        return $mensagem."Telefone Invalido,Favor Verifique o Telefone do Instrutor antes da inclusão\n";
    }
    
    public static  function loginInvalido($mensagem){
        return $mensagem."Login Invalido,Favor Verifique o Login do Instrutor antes da inclusão\n";
    }
    
    public static  function senhaInvalida($mensagem){
        return $mensagem."Senha Invalido,Favor Verifique a Senha do Instrutor antes da inclusão\n";
    }
    
    public static  function enderecoInvalido($mensagem){
        return $mensagem."Endereço Invalido,Favor Verifique o Endereço do Instrutor antes da inclusão\n";
    }
}

?>
