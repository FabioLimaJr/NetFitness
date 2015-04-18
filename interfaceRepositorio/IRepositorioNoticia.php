<?php
/**
 *
 * @author Marcelo
 */
interface IRepositorioNoticia {
    
    public function inserir($noticia);
    public function alterar($noticia);
    public function excluir($noticia);
    public function listar($secretaria,$fetchType);
    public function detalhar($noticia,$fetchType);

}
