<?php

/**
 * Description of Noticia
 *
 * @author Marcelo
 */
class Noticia implements JsonSerializable
{
   
    private $idNoticia;
    private $titulo;
    private $descricao;
    private $secretaria;
    private $data;
    
    public function __construct() 
    {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }
    
    function __construct1($idNoticia) 
    {
        $this->setIdNoticia($idNoticia);
    }
    
    function __construct5($idNoticia,$titulo,$descricao,$secretaria,$data) 
    {
        $this->idNoticia = $idNoticia;
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->secretaria = $secretaria;
        $this->data = $data;
    }
        
    function getIdNoticia() {
        return $this->idNoticia;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getSecretaria() {
        return $this->secretaria;
    }
    
    function getData() {
        return $this->data;
    }

    function setIdNoticia($idNoticia) {
        $this->idNoticia = $idNoticia;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setSecretaria($secretaria) {
        $this->secretaria = $secretaria;
    }
    
    function setData($data) {
        $this->data = $data;
    }

    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        return $vars;
    }

}
