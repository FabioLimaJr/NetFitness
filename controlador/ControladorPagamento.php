<?php
/**
 * Description of ControladorPagamento
 *
 * @author Fábio
 */
include ($serverPath.'repositorio/RepositorioPagamento.php');

class ControladorPagamento {
    
    private $repositorioPagamento;
    
    function __construct() {
        $this->setRepositorioPagamento(new RepositorioPagamento());
    }
    
    function getRepositorioPagamento() {
        return $this->repositorioPagamento;
    }

    function setRepositorioPagamento($repositorioPagamento) {
        $this->repositorioPagamento = $repositorioPagamento;
    }
    
    public function inserir($pagamento){
        return $this->getRepositorioPagamento()->inserir($pagamento);
    }
    
    public function alterar($pagamento){
        return $this->getRepositorioPagamento()->alterar($pagamento);
    }
    
    public function excluir($pagamento){
        return $this->getRepositorioPagamento()->excluir($pagamento);
    }
    
    public function listar(){
        return $this->getRepositorioPagamento()->listar();
    }
    
}
