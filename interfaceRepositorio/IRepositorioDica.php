<?php
/**
 *
 * @author Marcelo
 */
interface IRepositorioDica {
   
    public function inserir($dica, $pessoa);
    public function alterar($dica);
    public function excluir($dica);
    public function listar($pessoa);
    public function detalhar($dica);
    
}
