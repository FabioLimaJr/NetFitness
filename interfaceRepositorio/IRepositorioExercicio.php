<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Schmitz
 */
interface IRepositorioExercicio {
    //put your code here
    
    public function inserir($exercicio);
    
    public function alterar($exercicio);
    
    public function excluir($exercicio);
    
    public function listar();
    
    public function detalhar($exercicio);
}
