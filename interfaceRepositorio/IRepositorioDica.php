<?php
/**
 *
 * @author Marcelo
 */
interface IRepositorioDica {
   
    public function inserir($dica);
    public function alterar($dica);
    public function excluir($dica);
    public function listar();
    public function detalhar($dica);
    
}
