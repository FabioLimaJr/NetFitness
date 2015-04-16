<?php

/**
 *
 * @author Daniele
 */
interface IRepositorioMusica
{
    public function inserir($musica);
    public function alterar($musica);
    public function excluir($musica);
    public function listar($fetchType);
    public function detalhar($musica,$fetchType);
}
