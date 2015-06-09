<?php
/**
 *
 * @author Marcelo
 */
interface IRepositorioTreino {

    public function inserir($treino);
    public function alterar($treino);
    public function excluir($treino);
    public function listar($instrutor, $fetchType);
    public function detalhar($treino, $fetchType);
    public function vincularTreinoAlunos($treino, $listaAlunos, $qtdTreinos);
    public function listarTreinoPorAluno($aluno, $fetchType);
    public function listarTreinosRealizados($aluno, $treino);
    public function atualizarDatasTreinosRealizados($aluno, $treino, $qtdTreinos);
    public function excluirVinculoTreinoAluno($aluno, $treino);
}
