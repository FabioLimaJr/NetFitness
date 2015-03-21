<?php

/**
 * Description of Pessoa
 *
 * @author Marcelo
 */
class Pessoa {
    
    private $idPessoa;
    private $nome;
    private $cpf;
    private $endereco;
    private $senha;
    private $telefone;
    private $login;
    private $email;
    
    
    public function __construct() 
    {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__constructPai'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }
    
    function __constructPai1($idPessoa)
    {
        $this->idPessoa = $idPessoa;
    }
    
    function __constructPai8($idPessoa, $nome, $cpf, $endereco, $senha, $telefone, $login,$email) {
        $this->idPessoa = $idPessoa;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->endereco = $endereco;
        $this->senha = $senha;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->login = $login;
    }
    
    function getIdPessoa() {
        return $this->idPessoa;
    }

    function getNome() {
        return $this->nome;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getSenha() {
        return $this->senha;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getEmail() {
        return $this->email;
    }

    function getLogin() {
        return $this->login;
    }

    function setIdPessoa($idPessoa) {
        $this->idPessoa = $idPessoa;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setLogin($login) {
        $this->login = $login;
    }
}
?>
