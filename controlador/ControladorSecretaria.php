<?php
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
        
        // essas validações tbm servem para o alterar.
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
        
        // se for um novo registro o id vai ser nulo ou 0, se o id for maior que 0 então o registro esta sendo alterado.
        if($secretaria->getIdSecretaria() == null || $secretaria->getIdSecretaria() <= 0){
            return $this->repositorioSecretaria->inserir($secretaria);
        }else{
            return $this->repositorioSecretaria->alterar($secretaria);
        }
        
    }
    
    public function excluir($secretaria){ 
        $this->repositorioSecretaria->excluir($secretaria);    
    }
    
    public function listar(){
        return $this->getRepositorioSecretaria()->listar();
    }
}
