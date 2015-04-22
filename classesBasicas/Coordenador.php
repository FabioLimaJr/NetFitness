<?php
/**
 * Description of Coordenador
 *
 * @author Marcelo
 */
include_once('Pessoa.php');

class Coordenador extends Pessoa {

    private $idCoordenador;
    private $listaInstrutores;
    private $listaSecretarias;
    private $listaNutricionistas;
    
    
    public function __construct() 
    {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }
    
    function __construct1($idCoordenador)
    {
        parent::__construct($idCoordenador);
        $this->setIdCoordenador($idCoordenador);
    }
    
    //parent:: (Construtor que passa os valores dos atributos para a super classe Pessoa)
    function __construct11($idCoordenador, $listaInstrutores, $listaSecretarias, $listaNutricionistas, 
                         $nome, $cpf, $endereco, $senha, $telefone, $email, $login) 
    {
        // $idPessoa, $nome, $cpf, $endereco, $senha, $telefone, $login,$email
        parent::__construct($idCoordenador, $nome, $cpf, $endereco, $senha, $telefone, $login, $email);
       
        $this->setIdCoordenador($idCoordenador);
        $this->setListaInstrutores($listaInstrutores);
        $this->setListaSecretarias($listaSecretarias);
        $this->setListaNutricionistas($listaNutricionistas);
    }
    
    function getIdCoordenador() {
        return $this->idCoordenador;
    }

    function setIdCoordenador($idCoordenador) {
        $this->idCoordenador = $idCoordenador;
    }

    function getListaInstrutores() {
        return $this->listaInstrutores;
    }

    function getListaSecretarias() {
        return $this->listaSecretarias;
    }

    function getListaNutricionistas() {
        return $this->listaNutricionistas;
    }

    function setListaInstrutores($listaInstrutores) {
        $this->listaInstrutores = $listaInstrutores;
    }

    function setListaSecretarias($listaSecretarias) {
        $this->listaSecretarias = $listaSecretarias;
    }

    function setListaNutricionistas($listaNutricionistas) {
        $this->listaNutricionistas = $listaNutricionistas;
    }
}
