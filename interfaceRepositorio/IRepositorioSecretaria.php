<?php

/**
 * Description of IRepositorioSecretaria
 *
 * @author Fábio
 */
interface IRepositorioSecretaria {
    //put your code here
    
  public function inserir($secretaria);
  public function excluir($secretaria);
  public function alterar($secretaria);
  public function listar();
  
}
