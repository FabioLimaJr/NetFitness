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
interface IRepositorioDieta 
{
    public function inserir($dieta);
    public function alterar($dieta);
    public function excluir($dieta);
    public function listar($pessoa, $fetchType);
    public function detalhar($dieta,$fetchType);
}
