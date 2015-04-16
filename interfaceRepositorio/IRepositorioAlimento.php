<?php


interface IRepositorioAlimento {
   
    public function inserir($alimento);
    public function alterar($alimento);
    public function excluir($alimento);
    public function listar($fetchType);
    public function detalhar($alimento,$fetchType);
}
?>