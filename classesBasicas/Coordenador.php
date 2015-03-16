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
    
    //parent:: (Construtor que passa os valores dos atributos para a super classe Pessoa)
    function __construct($idCoordenador, $listaInstrutores, $listaSecretarias, $listaNutricionistas, 
                         $nome, $cpf, $endereco, $senha, $telefone, $email, $login) 
    {
        parent::__construct($idCoordenador, $nome, $cpf, $endereco, $senha, $telefone, $email, $login);
       
        $this->idCoordenador = $idCoordenador;
        $this->listaInstrutores = $listaInstrutores;
        $this->listaSecretarias = $listaSecretarias;
        $this->listaNutricionistas = $listaNutricionistas;
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
