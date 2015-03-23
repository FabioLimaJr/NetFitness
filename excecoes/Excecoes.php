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
    
    public static function detalharObjeto($message)
    {
        return "Impossível detalhar o objeto ".$message."\n";
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
        return "Nome Invalido,Favor Verifique o Nome do ".$mensagem." antes da inclusão\n";
    }
    
    public static  function cpfInvalido($mensagem){
        return "Cpf Invalido,Favor Verifique o Cpf do ".$mensagem." antes da inclusão\n";
    }
    
    public static  function emailInvalido($mensagem){
        return "Email Invalido,Favor Verifique o Email do ".$mensagem." antes da inclusão\n";
    }
    
    public static  function telefoneInvalido($mensagem){
        return "Telefone Invalido,Favor Verifique o Telefone do ".$mensagem." antes da inclusão\n";
    }
    
    public static  function loginInvalido($mensagem){
        return "Login Invalido,Favor Verifique o Login do ".$mensagem." antes da inclusão\n";
    }
    
    public static  function senhaInvalida($mensagem){
        return "Senha Invalido,Favor Verifique a Senha do ".$mensagem." antes da inclusão\n";
    }
    
    public static  function enderecoInvalido($mensagem){
        return "Endereço Invalido,Favor Verifique o Endereço do ".$mensagem." antes da inclusão\n";
    }
    
    public static function usuarioInvalido(){
        return "Login e Senha inválidos.";
    }
    
    public static  function descricaoInvalida($mensagem){
        return "Descrição Invalida,Favor Verifique a Descrição do ".$mensagem." antes da inclusão\n";
    }
}

?>
