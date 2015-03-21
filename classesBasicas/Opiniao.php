<?php
/**
 * Description of Opiniao
 *
 * @author Fábio
 */
class Opiniao {
          
    function __construct($idOpiniao, $descricao, $dataPostagem, $aluno){
        $this->idOpiniao = $idOpiniao;
        $this->descricao = $descricao;
        $this->dataPostagem = $dataPostagem;
        $this->aluno = $aluno;
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
