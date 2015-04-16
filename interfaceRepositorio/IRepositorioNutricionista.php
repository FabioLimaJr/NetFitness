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
    public function listar($fetchType);
    public function detalhar($nutricionista,$fetchType);
    public function logar($nutricionista);
}