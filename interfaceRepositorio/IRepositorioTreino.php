<?php
/**
 *
 * @author Marcelo
 */
interface IRepositorioTreino {

    public function inserir($treino);
    public function alterar($treino);
    public function excluir($treino);
    public function listar($fetchType);
    public function detalhar($treino, $fetchType);
    
}
