<?php
/**
 * Description of Musica
 *
 * @author Daniele
 */
class Musica 
{
    private $idMusica;
    private $titulo;
    private $categoria;
    private $artista;
    private $secretaria;
        
    public function __construct() 
    {
        $get_arguments = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }
    
    function __construct1($idMusica) 
    {
        $this->setIdMusica($idMusica);
    }
    
    function __construct5($idMusica, $titulo, $categoria, $artista, $secretaria) {
        $this->setIdMusica($idMusica);
        $this->setTitulo($titulo);
        $this->setCategoria($categoria);
        $this->setArtista($artista);
        $this->setSecretaria($secretaria);
        
    }

    
    function getIdMusica() {
        return $this->idMusica;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getCategoria(){
        return $this->categoria;
    }
    
    function getArtista(){
        return $this->artista;
    }
    
    function getSecretaria() {
        return $this->secretaria;
    }
    
    function setIdMusica($idMusica) {
        $this->idMusica = $idMusica;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }
    
    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }
    
    function setArtista($artista) {
        $this->artista = $artista;
    }

    function setSecretaria($secretaria) {
        $this->secretaria = $secretaria;
    }
    
    


}
