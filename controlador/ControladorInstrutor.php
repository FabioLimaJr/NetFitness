<?php
/**
 * Description of ControladorInstrutor
 *
 * @author Marcelo
 */
class ControladorInstrutor {
   
    private $repositorioInstrutor;
    
    function __construct() {
        $this->setRepositorioInstrutor(new RepositorioInstrutor());
    }
    
    function getRepositorioInstrutor() {
        return $this->repositorioInstrutor;
    }

    function setRepositorioInstrutor($repositorioInstrutor) {
        $this->repositorioInstrutor = $repositorioInstrutor;
    }
    
    public function inserir($instrutor){
       
        if(($instrutor != "") && ($instrutor != NULL))
        {
            
            if(!ExpressoesRegulares::conferirNome($instrutor->getNome()))
            {

                throw new Exception(Excecoes::nomeInvalido(""));
            }

            if(!ExpressoesRegulares::conferirCpf($instrutor->getCpf()))
            {

                throw new Exception(Excecoes::cpfInvalido(""));
            }

            if(!ExpressoesRegulares::conferirEmail($instrutor->getEmail()))
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

            if(!ExpressoesRegulares::conferirTelefone($instrutor->getTelefone()))
            {
                throw new Exception(Excecoes::telefoneInvalido(""));
            }

            if(!ExpressoesRegulares::conferirLogin($instrutor->getLogin()))
            {
                throw new Exception(Excecoes::loginInvalido(""));
            }

            if(!ExpressoesRegulares::conferirSenha($instrutor->getSenha()))
            {
                throw new Exception(Excecoes::senhaInvalida(""));
            }

            if(($instrutor->getEndereco() === null) && ($instrutor->getEndereco() === ""))
            {
                throw new Exception(Excecoes::enderecoInvalido(""));
            }

        }else
        {
            throw new Exception(Excecoes::objetoNulo(""));
        }
        
           
        return $this->repositorioInstrutor->inserir($instrutor);
    }
    
    public function excluir($instrutor){
       
        if(($instrutor != "") && ($instrutor != NULL))
        {
            
            if(!ExpressoesRegulares::conferirNome($instrutor->getNome()))
            {

                throw new Exception(Excecoes::nomeInvalido(""));
            }

            if(!ExpressoesRegulares::conferirCpf($instrutor->getCpf()))
            {

                throw new Exception(Excecoes::cpfInvalido(""));
            }

            if(!ExpressoesRegulares::conferirEmail($instrutor->getEmail()))
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

            if(!ExpressoesRegulares::conferirTelefone($instrutor->getTelefone()))
            {
                throw new Exception(Excecoes::telefoneInvalido(""));
            }

            if(!ExpressoesRegulares::conferirLogin($instrutor->getLogin()))
            {
                throw new Exception(Excecoes::loginInvalidoInvalido(""));
            }

            if(!ExpressoesRegulares::conferirSenha($instrutor->getSenha()))
            {
                throw new Exception(Excecoes::senhaInvalido(""));
            }

            if(($instrutor->getEndereco() === null) && ($instrutor->getEndereco() === ""))
            {
                throw new Exception(Excecoes::enderecoInvalido(""));
            }

        }else
        {
            throw new Exception(Excecoes::objetoNulo(""));
        }
        
           
        return $this->repositorioInstrutor->excluir($instrutor);
    }
    
    public function listar()
    {
        return $this->getRepositorioInstrutor()->listar();
    }
}
