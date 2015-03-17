<?php
/**
 * Description of IRepositorioNutricionista
 *
 * @author Erick
 */
interface IRepositorioNutricionista {
   
    public function inserir($nutricionista);
    public function alterar($nutricionista);
    public function excluir($nutricionista);
    public function listar();
    public function detalhar($nutricionista);
    public function logar($nutricionista);
}