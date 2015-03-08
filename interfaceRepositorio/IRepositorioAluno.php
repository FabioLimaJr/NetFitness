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
interface IRepositorioAluno 
{
    public function inserir($aluno);
    public function alterar($aluno);
    public function excluir($aluno);
    public function listar();
    public function detalhar($aluno);
}
