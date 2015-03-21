<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Daniele
 */
interface IRepositorioAlimento 
{
    public function inserir($alimento);
    public function alterar($alimento);
    public function excluir($alimento);
    public function listar();
    public function detalhar($alimento);
}
