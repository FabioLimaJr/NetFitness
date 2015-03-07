<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControladorSecretaria
 *
 * @author Schmitz
 */
class ControladorSecretaria {
    //put your code here
    
    private $repositorioSecretaria;
    
    function __construct() {
        $this->repositorioSecretaria = new RepositorioSecretaria();
    }
    
    function getRepositorioSecretaria() {
        return $this->repositorioSecretaria;
    }

    function setRepositorioSecretaria($repositorioSecretaria) {
        $this->repositorioSecretaria = $repositorioSecretaria;
    }

    public function inserir($secretaria){
        
        if(($secretaria != "") && ($secretaria != NULL))
        {
            
            if(!ExpressoesRegulares::conferirNome($secretaria->getNome()))
            {

                throw new Exception(Excecoes::nomeInvalido(""));
            }

            if(!ExpressoesRegulares::conferirCpf($secretaria->getCpf()))
            {

                throw new Exception(Excecoes::cpfInvalido(""));
            }

            if(!ExpressoesRegulares::conferirEmail($secretaria->getEmail()))
            {
                throw new Exception(Excecoes::emailInvalido(""));
            }

            /** 
             * <?php // VALIDAR TELEFONE NO SEGUINTE FORMATO: (DDD) 3333-3333 
             * $telefone = "(014) 3236-3810";   
             * if (!eregi("^\([0-9]{3}\) [0-9]{4}-[0-9]{4}$", $telefone)) 
             * { echo "Telefone inválido"; 
             * }
             * ?> 
             */

            if(!ExpressoesRegulares::conferirTelefone($secretaria->getTelefone()))
            {
                throw new Exception(Excecoes::telefoneInvalido(""));
            }

            if(!ExpressoesRegulares::conferirLogin($secretaria->getLogin()))
            {
                throw new Exception(Excecoes::loginInvalido(""));
            }

            if(!ExpressoesRegulares::conferirSenha($secretaria->getSenha()))
            {
                throw new Exception(Excecoes::senhaInvalida(""));
            }

            if(($secretaria->getEndereco() === null) && ($secretaria->getEndereco() === ""))
            {
                throw new Exception(Excecoes::enderecoInvalido(""));
            }

        }else
        {
            throw new Exception(Excecoes::objetoNulo(""));
        }
        
           
        return $this->repositorioSecretaria->inserir($secretaria);
    }
}
