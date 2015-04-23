<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IRepositorioPessoa
 *
 * @author Daniele
 */
interface IRepositorioPessoa
{
    public function inserirPessoa($pessoa);
    public function excluirPessoa($pessoa);
    public function alterarPessoa($pessoa);
    public function conferirLoginSenha($pessoa);
}
