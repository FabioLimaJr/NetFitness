<?php

/**
 * Description of Noticia
 *
 * @author Marcelo
 */
class Noticia {
   
    private $idNoticia;
    private $titulo;
    private $descricao;
    private $secretaria;
    
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
    
    function __construct4($idNoticia,$titulo,$descricao,$secretaria) 
    {
        $this->idNoticia = $idNoticia;
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->secretaria = $secretaria;
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
}
