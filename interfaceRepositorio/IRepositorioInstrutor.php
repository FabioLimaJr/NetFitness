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
    public function listar($fetchType);
    public function detalhar($instrutor, $fetchType);
    public function logar($instrutor);
}
