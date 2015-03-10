<?php

/**
 *
 * @author Daniele
 */
interface IRepositorioGenerico 
{
  public function inserir($objeto);
  public function excluir($objeto);
  public function alterar ($objeto);
  
}

?>
