<?php
/**
 * Description of Dica
 *
 * @author Marcelo
 */
class Dica implements JsonSerializable
{
    private $idDica;
    private $descricao;
    private $titulo;
    
    public function __construct() 
    {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }
    
    function __construct1($idDica)
    {
        $this->setIdDica($idDica);
    }
            
    function __construct3($idDica, $descricao, $titulo) {
        $this->idDica = $idDica;
        $this->descricao = $descricao;
        $this->titulo = $titulo;
    }

    
    function getIdDica() {
        return $this->idDica;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function setIdDica($idDica) {
        $this->idDica = $idDica;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function jsonSerialize() {
        
        $vars = get_object_vars($this);
        return $vars;
    }

}
