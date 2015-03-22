<?php
/**
 *
 * @author Fábio
 */

interface IRepositorioOpiniao {
    
    public function inserir($opiniao);
    public function alterar($opiniao);
    public function excluir($opiniao);
    public function listar();
}
