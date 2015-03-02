<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

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
