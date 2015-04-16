<?php
/**
 *
 * @author Fábio
 */
interface IRepositorioPagamento {
    
    public function inserir($pagamento);
    public function alterar($pagamento);
    public function excluir($pagamento);
    public function listar($fetchType);
    public function detalhar($pagamento, $fetchType);
}
