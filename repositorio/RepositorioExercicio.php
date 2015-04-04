<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include($serverPath.'interfaceRepositorio/IRepositorioExercicio.php');
include_once($serverPath.'repositorioGenerico/RepositorioGenerico.php');
include_once($serverPath.'excecoes/Excecoes.php');

/**
 * Description of RepositorioExercicio
 *
 * @author Schmitz
 */
class RepositorioExercicio extends Conexao implements IRepositorioExercicio{
    //put your code here
    
    function __construct() {
       parent::__construct();  
    }
    
    public function inserir($exercicio) {
        
        $idReturn = -1;
        
        $sql = "USE " . $this->getNomeBanco();
        
        if(@$this->getConexao()->query($sql) === TRUE){
            
            $sql = "INSERT INTO exercicio VALUES (NULL, '".$exercicio->getNome()
                                                         ."','".$exercicio->getMusculo()
                                                         ."','".$exercicio->getDescricao()."')";
            
            if( mysqli_query($this->getConexao(), $sql)){
                
                $this->fecharConexao();
                return TRUE;
            }else{
                throw new Exception(Excecoes::inserirObjeto("Exercício: ".mysqli_error($this->getConexao())));
            }
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }

    public function alterar($exercicio) {
        
        $sql = "USE " . $this->getNomeBanco();
        
        if(@$this->getConexao()->query($sql) === TRUE){
            
            $sql = "UPDATE exercicio SET nome = '".$exercicio->getNome()
                                                 ."', musculo = '".$exercicio->getMusculo()
                                                 ."', descricao = '".$exercicio->getDescricao()
                                                 ."' WHERE idExercicio = ".$exercicio->getIdExercicio();
            
            if( mysqli_query($this->getConexao(), $sql)){
                
                $this->fecharConexao();
                return TRUE;
            }else{
                throw new Exception(Excecoes::alterarObjeto("Exercício: ".mysqli_error($this->getConexao())));
            }
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }

    public function excluir($exercicio) {
        
        $sql = "USE " . $this->getNomeBanco();
        
        if(@$this->getConexao()->query($sql) === TRUE){
            
            $sql = "DELETE FROM exercicio WHERE idExercicio = ".$exercicio->getIdExercicio();
            
            if( mysqli_query($this->getConexao(), $sql)){
                
                $this->fecharConexao();
                return TRUE;
            }else{
                throw new Exception(Excecoes::alterarObjeto("Exercício: ".mysqli_error($this->getConexao())));
            }
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }

    public function listar() {
        
        $listaExercicios = array();
        
        $sql = "USE " . $this->getNomeBanco();
        
        if(@$this->getConexao()->query($sql) === TRUE){
            
            $sql = "SELECT * FROM exercicio";
            $result = mysqli_query($this->getConexao(), $sql);
            
            while($row = mysqli_fetch_array($result)){
                
                $exercicio = new Exercicio($row['idExercicio'], $row['nome'], $row['musculo'], $row['descricao']);
                
                array_push($listaExercicios, $exercicio);
            }
            $this->fecharConexao();
            return $listaExercicios;
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }

    public function detalhar($exercicio) {
        
        $sql = "USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){
            
            $sql = "SELECT * FROM exercicio WHERE exercicio.idExercicio = " . $exercicio->getIdExercicio();
            $result = mysqli_query($this->getConexao(), $sql);
            
            while($row = mysqli_fetch_array($result)){
                
                $exercicioDetalhado = new Exercicio($row['idExercicio'], $row['nome'], $row['musculo'], $row['descricao']);
                
            }
            $this->fecharConexao();
            return $exercicioDetalhado;
            
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }
}
