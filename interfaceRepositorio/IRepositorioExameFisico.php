<?php
/*
 *
 * @author Daniele
 */

interface IRepositorioExameFisico
{
    public function inserir($exameFisico);   
    public function alterar($exameFisico);   
    public function excluir($exameFisico);   
    public function listar($pessoa, $fetchType);   
    public function detalhar($exameFisico, $fetchType);
}
