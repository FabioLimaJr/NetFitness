<?php
/**
 * Description of RepositorioPagamento
 *
 * @author Fábio
 */
include($serverPath.'interfaceRepositorio/IRepositorioPagamento.php');
include_once($serverPath.'excecoes/Excecoes.php');
include_once($serverPath.'conexao/Conexao.php');

class RepositorioPagamento extends RepositorioGenerico implements IRepositorioPagamento {
    
    function __construct() {
       parent::__construct();  
    }
    
    public function inserir($pagamento){
        
        $sql = "USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){
            
            /*$sql = "INSERT INTO pagamento VALUES( null,";
            //$sql.= NULL. ",";
            $sql.= $pagamento->getValor().",'";
            //$sql.= "null, '";
            $sql.= $pagamento->getDataPagamento()."','";
            $sql.= $pagamento->getDataVencimento()."',";
            $sql.= $pagamento->getSecretaria()->getIdSecretaria().",";
            $sql.= $pagamento->getAluno()->getIdAluno().")";*/
            
            $sql = "INSERT INTO pagamento VALUES( null,"
                    .$pagamento->getValor().", null,'"
                    //.$pagamento->getDataPagamento().",'"
                    .$pagamento->getDataVencimento()."',"
                    .$pagamento->getSecretaria()->getIdSecretaria().","
                    .$pagamento->getAluno()->getIdAluno(). ")";
            
            //$sql = "INSERT INTO pagamento(valor,dataVencimento, idSecretaria, idAluno) VALUES (200,'2015-05-12',12,10";
            
            if(mysqli_query($this->getConexao(), $sql)){
               
               // $this->fecharConexao();
           
            }else{
                throw new Exception(Excecoes::inserirObjeto("Pagamento".  mysql_errno($this->getConexao())));
            }
            
        }else {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->erro.")"));
        }   
    } 
    
    public function alterar($pagamento){
        
        $sql = "USE " . $this->getNomeBanco();
        
        if(@$this->getConexao()->query($sql) === TRUE){
            
            $sql = "UPDATE pagamento SET valor = '".$pagamento->getValor()
                                                 ."', dataPagamento = '".$pagamento->getDataPagamento()
                                                 ."', dataVencimento = '".$pagamento->getDataVencimento()
                                                 ."' WHERE idSecretaria = '".$pagamento->getSecretaria()->getIdSecretaria()
                                                 ."' AND idAluno = '".$pagamento->getAluno()->getIdAluno();//getIdAluno();  
                       
            if( mysqli_query($this->getConexao(), $sql)){
                
                $this->fecharConexao();
                return TRUE;
            }else{
                throw new Exception(Excecoes::alterarObjeto("Pagamento: ".mysqli_error($this->getConexao())));
            }
            
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
        
    }
    
    public function excluir($pagamento){
       
        $sql = "USE " . $this->getNomeBanco();
        
        if(@$this->getConexao()->query($sql) === TRUE){
            
            $sql = "DELETE FROM pagamento WHERE idPagamento = ".$pagamento->getIdPagamento();
            
            if( mysqli_query($this->getConexao(), $sql)){
                
                $this->fecharConexao();
                return TRUE;
            }else{
                throw new Exception(Excecoes::alterarObjeto("Pagamento: ".mysqli_error($this->getConexao())));
            }
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }   
    
    public function listar(){
        
        $listaPagamentos = array();
        
        $sql = "USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === TRUE){
            
            $sql = "SELECT * FROM pagamento,pessoa,aluno,secretaria WHERE (pagamento.idAluno = aluno.idAluno) AND "
                                                                        ."(pagamento.idSecretaria = secretaria.idSecretaria)";
                                                                        //."(pessoa.idPessoa = secretaria.idSecretaria)";
             $result = mysqli_query($this->getConexao(), $sql);
             
             while ($row = mysqli_fetch_array($result)){
                 
                $aluno = new Aluno($row['idPessoa'], 
                                   $row['nome'], 
                                   $row['cpf'], 
                                   $row['endereco'], 
                                   $row['senha'], 
                                   $row['telefone'], 
                                   $row['login'], 
                                   $row['email'], 
                                   $row['sexo'], 
                                   $row['dataNascimento'], 
                                   null/*secretaria*/, 
                                   $row['idMusica'], 
                                   null/*$dieta*/, 
                                   null/*$listaPagamentos*/, 
                                   null/*$listaTreinos*/,
                                   $row['foto']);
                 
                $secretaria = new Secretaria($row['idPessoa'], 
                                             $row['nome'], 
                                             $row['cpf'], 
                                             $row['endereco'], 
                                             $row['senha'], 
                                             $row['telefone'],
                                             $row['login'], 
                                             $row['email'], 
                                             NULL);
                
                $pagamento = new Pagamento($row['idPagamento'], 
                                           $row['valor'],
                                           $row['dataVencimento'], 
                                           $row['dataPagamento'],
                                           $secretaria, 
                                           $aluno);  
                
                array_push($listaPagamento, $pagamento);
            }
            
            return $listaPagamento;
        }   
    }
}
