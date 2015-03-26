<?php


interface IRepositorioAlimento {
   
    public function inserir($alimento);
    public function alterar($alimento);
    public function excluir($alimento);
    public function listar();
    public function detalhar($alimento);
}
?>