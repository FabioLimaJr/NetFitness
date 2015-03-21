<?php

/**
 * Description of RepositorioAlimento
 *
 * @author Daniele
 */

include($serverPath.'interfaceRepositorio/IRepositorioAlimento.php');
include_once($serverPath.'excecoes/Excecoes.php');
include_once($serverPath.'conexao/Conexao.php');

class RepositorioAlimento extends Conexao implements IRepositorioAlimento 
{
    public function alterar($alimento) 
    {
        
    }

    public function detalhar($alimento) 
    {
        
    }

    public function excluir($alimento) 
    {
        
    }

    public function inserir($alimento) 
    {
        
    }

    public function listar() 
    {
        $listaAlimentos = array();
        
        $sql = "USE " . $this->getNomeBanco();
    
        
        if($this->getConexao()->query($sql) === TRUE)
        {
        
            
            $sql = "SELECT * FROM alimento";
            $result = mysqli_query($this->getConexao(), $sql);
            
            while ($row = mysqli_fetch_array($result)) 
            {
    
                $alimento = new Alimento($row['idAlimento'], $row['descricao'], $row['caloria'],
                                         $row['proteina'], $row['carboidrato'], $row['gordura'], 
                                         null/*nutricionista*/);
                //SELECT * FROM pessoa,instrutor WHERE pessoa.idPessoa = instrutor.idInstrutor;
                
                $sql2 = "SELECT * FROM  pessoa,nutricionista WHERE pessoa.idPessoa = nutricionista.idNutricionista AND idPessoa = '".$row['idNutricionista']."'";
                $result2 = mysqli_query($this->getConexao(), $sql2); 
                $row2 = mysqli_fetch_assoc($result2);
                
                $nutricionista = new Nutricionista($row['idNutricionista'], null/*$coordenador*/, $row2['crn'], 
                                                   null/*$listaDietas*/, null/*$listaDicas*/, $row2['nome'], $row2['cpf'], 
                                                   $row2['endereco'], $row2['senha'], $row2['telefone'], 
                                                   $row2['email'], $row2['login']);
                
               
                $alimento->setNutricionista($nutricionista);
               
                
                array_push($listaAlimentos, $alimento);
                
            }
            
            return($listaAlimentos);
            
                      
         }
         else 
         {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error).")");
         }
    }


}
