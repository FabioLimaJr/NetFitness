<?php

/**
 * Description of Aluno
 *
 * @author Daniele
 */
class Aluno extends Pessoa
{
    private $idAluno;
    private $sexo;
    private $opiniao;
    private $secretaria;
    //acho que no aluno está faltando a lista de treinos, mas não
    //colocamos uma chave estrangeira do aluno na lista de treinos.
    //Por enquanto vou deixar assim, depois vamos ver se é o caso
    //de corrigir a tabela treinos
    
    public function __construct($idAluno, $nome, $cpf, $endereco, $senha, $telefone, $login, $email, $sexo, $opiniao, $secretaria) 
    {
        parent::__construct($idAluno, $nome, $cpf, $endereco, $senha, $telefone, $login, $email);
        
        $this->setIdAluno($idAluno);
        $this->setOpiniao($opiniao);
        $this->setSecretaria($secretaria);
        $this->setSexo($sexo);
    }
    
    
    function getIdAluno() {
        return $this->idAluno;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getOpiniao() {
        return $this->opiniao;
    }

    function getSecretaria() {
        return $this->secretaria;
    }

    function setIdAluno($idAluno) {
        $this->idAluno = $idAluno;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setOpiniao($opiniao) {
        $this->opiniao = $opiniao;
    }

    function setSecretaria($secretaria) {
        $this->secretaria = $secretaria;
    }


}
