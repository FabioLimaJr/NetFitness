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
        return "Impossível criar uma conexão com o banco de dados: ".$message."<br/>";
    }
    
    public static function loginSenhaInvalidos()
    {
        return "Login e senha inválidos";
    }

    public static function selecionarBanco($message)
    {
        return "Erro ao selecionar o banco de dados: ".$message."<br/>";
    }
    
    public static function inserirObjeto($message)
    {
        return "Impossível salvar o objeto ".$message."<br/>";
    }
    
    public static function excluirObjeto($message)
    {
        return "Impossível excluir o objeto ".$message."<br/>";
    }
    
    public static function excluirObjetosRelacionados($message)
    {
        return "Impossível excluir os objetos relacionados a ".$message."<br/>";
    }
    
    public static function alterarObjeto($message)
    {
        return "Impossível alterar o objeto ".$message."<br/>";
    }
    
    public static function detalharObjeto($message)
    {
        return "Impossível detalhar o objeto ".$message."<br/>";
    }
    
    public static function parentInvalido($message1,$message2)
    {
        return "Impossível alterar o objeto ".$message1.". O objeto ".$message2." não existe no banco<br/>";
    }
    
     public static function objetoNulo($message)
    {
        return $message.". O objeto é nulo<br/>";
    }
    
    //Metodos Referentes as Expressoes Regulares
    
    public static  function nomeInvalido($mensagem){
        return "Nome inválido, verifique o nome do ".$mensagem." antes da inclusão<br/>";
    }
    
    public static  function cpfInvalido($mensagem){
        return "Cpf inválido, verifique o cpf do ".$mensagem." antes da inclusão<br/>";
    }
    
    public static  function emailInvalido($mensagem){
        return "Email inválido, verifique o email do ".$mensagem." antes da inclusão<br/>";
    }
    
    public static  function telefoneInvalido($mensagem){
        return "Telefone inválido, verifique o telefone do ".$mensagem." antes da inclusão<br/>";
    }
    
    public static  function loginInvalido($mensagem){
        return "Login inválido, verifique o login do ".$mensagem." antes da inclusão<br/>";
    }
    
    public static  function senhaInvalida($mensagem){
        return "Senha inválida, verifique a senha do ".$mensagem." antes da inclusão<br/>";
    }
    
    public static  function enderecoInvalido($mensagem){
        return "Endereço inválido, verifique o endereço do ".$mensagem." antes da inclusão<br/>";
    }
    
    public static function usuarioInvalido(){
        return "Login e senha inválidos.";
    }
    
    public static  function descricaoInvalida($mensagem){
        return "Descrição inválida, verifique a descrição do ".$mensagem." antes da inclusão<br/>";
    }
    
    public static  function valorNumericoInvalido($mensagem){
        return "Valor mumérico inválido, verifique o valor numerico do ".$mensagem." antes da inclusão<br/>";
    }
    
    public static function dataInvalida($mensagem)
    {
        return "Data não válida no objeto: ".$mensagem;
    }
    
    public static  function tituloInvalida($mensagem){
        return "Titulo inválido, verifique o titulo da ".$mensagem." antes da inclusão<br/>";
    }
    
    public static  function arrayVazioInvalido($mensagem){
        return "Lista de ".$mensagem." vazia.<br/>";
    }
    
    public static function numeroNaoInteiro($mensagem)
    {
        return "O valor informado '".$mensagem."' não é um inteiro.";
    }
    
    public static function numeroMenorIgualZero($mensagem)
    {
        return "O valor informado '".$mensagem."' não pode ser negativo ou igual a 0.";
    }
}

