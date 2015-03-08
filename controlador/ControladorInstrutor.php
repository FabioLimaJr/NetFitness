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
    
    
    private function validarInstrutor($instrutor){
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
    }


    public function inserir($instrutor){
         
        $this->validarInstrutor($instrutor);
        return $this->getRepositorioInstrutor()->inserir($instrutor);
    }
    
    public function alterar($instrutor){
        
        $this->validarInstrutor($instrutor);
        return $this->getRepositorioInstrutor()->alterar($instrutor);
    }


    public function excluir($instrutor){
       
        $this->validarInstrutor($instrutor);           
        return $this->getRepositorioInstrutor()->excluir($instrutor);
    }
    
    public function listar()
    {
        return $this->getRepositorioInstrutor()->listar();
    }
}
