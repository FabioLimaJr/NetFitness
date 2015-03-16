<?php

/**
 * Description of IRepositorioInstrutor
 *
 * @author Marcelo
 */
interface IRepositorioInstrutor {
   
    public function inserir($instrutor);
    public function alterar($instrutor);
    public function excluir($instrutor);
    public function listar();
    public function detalhar($instrutor);
    public function logar($instrutor);
}
