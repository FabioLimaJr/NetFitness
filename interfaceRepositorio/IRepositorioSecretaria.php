<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IRepositorioSecretaria
 *
 * @author Fábio
 */
interface IRepositorioSecretaria {
    //put your code here
    
  public function inserir($secretaria);
  public function excluir($secretaria);
  public function alterar ($secretaria);
  public function listar();
  
}
