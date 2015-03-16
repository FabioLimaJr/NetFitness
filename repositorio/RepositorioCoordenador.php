<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RepositorioCoordenador
 *
 * @author aluno
 */

include($serverPath.'interfaceRepositorio/IRepositorioCoordenador.php');
include_once($serverPath.'repositorioGenerico/RepositorioGenerico.php');
include_once($serverPath.'excecoes/Excecoes.php');

class RepositorioCoordenador extends RepositorioGenerico implements IRepositorioCoordenador{
   
 
    function __construct() 
    {
       parent::__construct();
    }

    public function logar($coordenador) {
         
        $sql = "USE " . $this->getNomeBanco();
        
        $coordenadorReturn = null;
        
        if($this->getConexao()->query($sql) === TRUE)
        {
            $pessoa = $this->logarPessoa($coordenador);
            
            if($pessoa!=null)
            {
                $query = "SELECT * FROM coordenador WHERE idCoordenador = '".$pessoa->getIdPessoa()."' LIMIT 0,1";

                $result = mysqli_query($this->getConexao(), $query);
        
                while ($row = mysqli_fetch_array($result)) 
                {
                    $coordenadorReturn = new Coordenador($pessoa->getIdPessoa(), null/*$listaInstrutores*/, 
                            null/*$listaSecretarias*/, null/*$listaNutricionistas*/, $pessoa->getNome(), 
                            $pessoa->getCpf(), $pessoa->getEndereco(), $pessoa->getSenha(), $pessoa->getTelefone(),
                            $pessoa->getEmail(), $pessoa->getLogin());
                    
                    //falta incluir as demais listas. Vai ser feito depois que será implementado o métod detalharCoordenador
                }    
            }
            else
            {
                $this->fecharConexao();
                throw new Exception(Excecoes::usuarioInvalido(""));
            }
            
            $this->fecharConexao();
            return $coordenadorReturn;
        }
        else
        {
            $this->fecharConexao();
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }

//put your code here
}
