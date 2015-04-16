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

class RepositorioCoordenador extends RepositorioPessoa implements IRepositorioCoordenador{
   
 
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
                }    
            }
            else
            {
               // $this->fecharConexao();
                throw new Exception(Excecoes::usuarioInvalido(""));
            }
            
            //$this->fecharConexao();
            return $coordenadorReturn;
        }
        else
        {
           // $this->fecharConexao();
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }

    public function detalhar($coordenador, $fetchType)
    {
        $sql = "USE " . $this->getNomeBanco();

        if($this->getConexao()->query($sql) === TRUE)
        {
            try
            {
                $sqlCoordenador = "SELECT * FROM pessoa,coordenador WHERE pessoa.idPessoa = "
                                 .$coordenador->getIdPessoa()." AND "."coordenador.idCoordenador = '"
                                 .$coordenador->getIdCoordenador()."'";

                $resultCoordenador = mysqli_query($this->getConexao(), $sqlCoordenador);
                $rowCoordenador = mysqli_fetch_assoc($resultCoordenador);
                
                $coordenadorRetornado = new Coordenador($rowCoordenador['idCoordenador'], null/*listaInsturtores*/, 
                                                        null/*listaSecretarias*/, null/*listaNutricionistas*/, 
                                                        $rowCoordenador['nome'], $rowCoordenador['cpf'],
                                                        $rowCoordenador['endereco'], $rowCoordenador['senha'], 
                                                        $rowCoordenador['telefone'], $rowCoordenador['email'],
                                                        $rowCoordenador['login']);
            }                             
            catch (Exception $exc)
            {
                throw new Exception($exc->getMessage());
            }
            if($fetchType === EAGER)
            {
                //nesse caso, sendo que o coordenador é único, as entidadse relacionadas com ele
                //são todas aquelas que ele pode cadastrar e que são retornadas com os métodos listar             
                
                $coordenadorRetornado->setListaInstrutores($this->listarObjetos(new Instrutor(), $coordenadorRetornado, LAZY));  
                $coordenadorRetornado->setListaNutricionistas($this->listarObjetos(new Nutricionista(), $coordenadorRetornado, LAZY));
                $coordenadorRetornado->setListaSecretarias($this->listarObjetos(new Secretaria(), $coordenadorRetornado, LAZY));
                
            }    
            
            return $coordenadorRetornado;          
        }
        else 
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }
}
