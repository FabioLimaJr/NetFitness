<?php
/**
 * Description of ConexaoBanco
 *
 * @author Daniele
 */
class ConexaoBanco 
{
    private $nomeServidor;
    private $nomeUsuario;
    private $senhaUsuario;
    private $conexao;
    
    public function getNomeServidor() {
        return $this->nomeServidor;
    }

    public function setNomeServidor($nomeServidor) {
        $this->nomeServidor = $nomeServidor;
    }

    public function getNomeUsuario() {
        return $this->nomeUsuario;
    }

    public function setNomeUsuario($nomeUsuario) {
        $this->nomeUsuario = $nomeUsuario;
    }

    public function getSenhaUsuario() {
        return $this->senhaUsuario;
    }

    public function setSenhaUsuario($senhaUsuario) {
        $this->senhaUsuario = $senhaUsuario;
    }

    public function getConexao() {
        return $this->conexao;
    }

    public function setConexao($conexao) {
        $this->conexao = $conexao;
    }

    
    public function __construct($nomeServidor, $nomeUsuario, $senhaUsuario) 
    {
        $this->setNomeServidor($nomeServidor);
        $this->setSenhaUsuario($senhaUsuario);
        $this->setNomeUsuario($nomeUsuario);
    }

    public function criarConexao()
    {
       $this->setConexao(new mysqli($this->getNomeServidor(), $this->getNomeUsuario(), $this->getSenhaUsuario()));
       if($this->getConexao()->connect_error)
       {
           return FALSE;
       }
       else 
       {
           return TRUE;    
       }
    }
}

?>
