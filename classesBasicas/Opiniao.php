<?php
/**
 * Description of Opiniao
 *
 * @author Fábio
 */
class Opiniao {
    
    public function __construct() 
    {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }
    
    function __construct1($idOpiniao)
    {
        $this->setIdOpiniao($idOpiniao);
    }  
          
    function __construct4($idOpiniao, $descricao, $dataPostagem, $aluno){
        $this->setIdOpiniao($idOpiniao);
        $this->setDescricao($descricao);
        $this->setDataPostagem($dataPostagem);
        $this->setAluno($aluno);
    }    
    
    function getIdOpiniao() {
        return $this->idOpiniao;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getDataPostagem() {
        return $this->dataPostagem;
    }

    function getAluno() {
        return $this->aluno;
    }

    function setIdOpiniao($idOpiniao) {
        $this->idOpiniao = $idOpiniao;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setDataPostagem($dataPostagem) {
        $this->dataPostagem = $dataPostagem;
    }

    function setAluno($aluno) {
        $this->aluno = $aluno;
    }

}
