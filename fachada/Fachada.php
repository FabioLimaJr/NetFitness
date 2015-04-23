<?php

/**
 * Description of Fachada
 *
 * @author Marcelo
 */
include('../serverPath.php');
include('../constants.php');
include('IFachada.php');

include($serverPath . 'controlador/ControladorAluno.php');
include($serverPath . 'controlador/ControladorCoordenador.php');
include($serverPath . 'controlador/ControladorInstrutor.php');
include($serverPath . 'controlador/ControladorSecretaria.php');
include($serverPath . 'controlador/ControladorExercicio.php');
include($serverPath . 'controlador/ControladorNutricionista.php');
include($serverPath . 'controlador/ControladorTreino.php');
include($serverPath . 'controlador/ControladorOpiniao.php');
include($serverPath . 'controlador/ControladorAlimento.php');
include($serverPath . 'controlador/ControladorDieta.php');
include($serverPath . 'controlador/ControladorPagamento.php');
include($serverPath . 'controlador/ControladorExameFisico.php');
include($serverPath . 'controlador/ControladorDica.php');
include($serverPath . 'controlador/ControladorMusica.php');
include($serverPath . 'controlador/ControladorNoticia.php');

class Fachada implements IFachada 
{

    private $controladorAluno;
    private $controladorInstrutor;
    private $controladorSecretaria;
    private $controladorCoordenador;
    private $controladorExercicio;
    private $controladorNutricionista;
    private $controladorTreino;
    private $controladorOpiniao;
    private $controladorAlimento;
    private $controladorDieta;
    private $controladorPagamento;
    private $controladorExameFisico;
    private $controladorDica;
    private $controladorMusica;
    private $controladorNoticia;
    
    private static $instance = null;

    function __construct() 
    {
        $this->controladorAluno = new ControladorAluno();
        $this->controladorInstrutor = new ControladorInstrutor();
        $this->controladorSecretaria = new ControladorSecretaria();
        $this->controladorCoordenador = new controladorCoordenador();
        $this->controladorExercicio = new ControladorExercicio();
        $this->controladorNutricionista = new ControladorNutricionista();
        $this->controladorTreino = new ControladorTreino();
        $this->controladorAlimento = new ControladorAlimento();
        $this->controladorDieta = new ControladorDieta();
        $this->controladorOpiniao = new ControladorOpiniao();
        $this->controladorPagamento = new ControladorPagamento();
        $this->controladorExameFisico = new ControladorExameFisico();
        $this->controladorDica = new controladorDica();
        $this->controladorMusica = new ControladorMusica();
        $this->controladorNoticia = new ControladorNoticia();
    }

//self:: serve para chamar um atributo statico da propria classe
    public static function getInstance() {

        if (self::$instance === null) {
            self::$instance = new Fachada();
        }
        return self::$instance;
    }

    public function alterarAluno($aluno) {
        $this->controladorAluno->alterar($aluno);
    }

    public function alterarInstrutor($instrutor) {
        $this->controladorInstrutor->alterar($instrutor);
    }

   public function detalharAluno($aluno, $fetchType) {
        return $this->controladorAluno->detalhar($aluno, $fetchType);
    }

    public function detalharInstrutor($instrutor, $fetchType) {
        return $this->controladorInstrutor->detalhar($instrutor, $fetchType);
    }

    public function excluirAluno($aluno) {
        $this->controladorAluno->excluir($aluno);
    }

    public function excluirInstrutor($instrutor) {
        $this->controladorInstrutor->excluir($instrutor);
    }

    public function inserirAluno($aluno) {
        $this->controladorAluno->inserir($aluno);
    }

    public function inserirInstrutor($instrutor) {
        $this->controladorInstrutor->inserir($instrutor);
    }

    public function listarAlunos($fetchType) {
        return $this->controladorAluno->listar($fetchType);
    }

    public function listarInstrutores($fetchType) {
        return $this->controladorInstrutor->listar($fetchType);
    }

    public function inserirSecretaria($secretaria) {
        $this->controladorSecretaria->inserir($secretaria);
    }

    public function alterarSecretaria($secretaria) {
        $this->controladorSecretaria->alterar($secretaria);
    }

    public function excluirSecretaria($secretaria) {
        $this->controladorSecretaria->excluir($secretaria);
    }

   public function listarSecretarias($fetchType) {
        return $this->controladorSecretaria->listar($fetchType);
    }

    public function detalharSecretaria($secretaria,$fetchType) {
        return $this->controladorSecretaria->detalhar($secretaria,$fetchType);
    }

    public function logarCoordenador($coordenador) {
        return $this->controladorCoordenador->logar($coordenador);
    }
    
    public function detalharCoordenador($coordenador, $fetchType)
    {
        return $this->controladorCoordenador->detalhar($coordenador, $fetchType);
    }

    public function logarSecretaria($secretaria) {
        return $this->controladorSecretaria->logar($secretaria);
    }

    public function logarAluno($aluno) {
        return $this->controladorAluno->logar($aluno);
    }

    public function inserirExercicio($exercicio) {
        return $this->controladorExercicio->inserir($exercicio);
    }

    public function alterarExercicio($exercicio) {
        return $this->controladorExercicio->alterar($exercicio);
    }

    public function excluirExercicio($exercicio) {
        return $this->controladorExercicio->excluir($exercicio);
    }

    public function listarExercicios() {
        return $this->controladorExercicio->listar();
    }

    public function detalharExercicio($exercicio) {
        return $this->controladorExercicio->detalhar($exercicio);
    }

    public function logarInstrutor($instrutor) {
        return $this->controladorInstrutor->logar($instrutor);
    }

    public function inserirTreino($treino) {
        return $this->controladorTreino->inserir($treino);
    }

    public function alterarTreino($treino) {
        return $this->controladorTreino->alterar($treino);
    }

    public function excluirTreino($treino) {
        return $this->controladorTreino->excluir($treino);
    }

    public function listarTreinos($instrutor, $fetchType) {
        return $this->controladorTreino->listar($instrutor, $fetchType);
    }

    public function detalharTreino($treino, $fetchType) {
        return $this->controladorTreino->detalhar($treino, $fetchType);
    }
    // listar todos os treino independente do instrutor logado.
    public function listarTodosTreinos($fetchType) {
        return $this->controladorTreino->listarTodos($fetchType);
    }
    
    public function vincularTreinoAlunos($treino, $listaAlunos){
        return $this->controladorTreino->vincularTreinoAlunos($treino, $listaAlunos);
    }


    public function inserirOpiniao($opiniao) {
        return $this->controladorOpiniao->inserir($opiniao);
    }
    
    public function alterarOpiniao($opiniao) {
        return $this->controladorOpiniao->alterar($opiniao);
    }
    
    public function excluirOpiniao($opiniao) {
        return $this->controladorOpiniao->excluir($opiniao);
    }

    public function listarOpinioes($aluno) {
        return $this->controladorOpiniao->listar($aluno);
    }
    
    public function detalharOpiniao($opiniao){
        return $this->controladorOpiniao->detalhar($opiniao);
    }

    public function inserirAlimento($alimento) {
        return $this->controladorAlimento->inserir($alimento);
    }
    
    public function alterarAlimento($alimento) {
        return $this->controladorAlimento->alterar($alimento);
    }

    public function excluirAlimento($alimento) {
        return $this->controladorAlimento->excluir($alimento);
    }

    public function listarAlimentos($fetchType) {
        return $this->controladorAlimento->listar($fetchType);
    }
    
    public function detalharAlimento($alimento,$fetchType) {
        return $this->controladorAlimento->detalhar($alimento,$fetchType);
    }

    public function alterarDieta($dieta)
    {
        $this->controladorDieta->alterar($dieta);
    }

    public function detalharDieta($dieta,$fetchType)
    {
        return $this->controladorDieta->detalhar($dieta,$fetchType);
    }

    public function excluirDieta($dieta)
    {
        $this->controladorDieta->excluir($dieta);
    }

    public function inserirDieta($dieta)
    {
        $this->controladorDieta->inserir($dieta);
    }

    public function listarDietas($pessoa, $fetchType)
    {
        return $this->controladorDieta->listar($pessoa, $fetchType);
    }
    
    public function logarNutricionista($nutricionista) {
        return $this->controladorNutricionista->logar($nutricionista);
    }
    
    public function inserirNutricionista($nutricionista)
    {
        $this->controladorNutricionista->inserir($nutricionista);
    }
    
     public function alterarNutricionista($nutricionista)
    {
        $this->controladorNutricionista->alterar($nutricionista);
    }
    
    public function excluirNutricionista($nutricionista)
    {
        $this->controladorNutricionista->excluir($nutricionista);
    }

    public function listarNutricionistas($fetchType)
    {
        return $this->controladorNutricionista->listar($fetchType);
    }
    
    public function detalharNutricionista($nutricionista, $fetchType)
    {
        return $this->controladorNutricionista->detalhar($nutricionista, $fetchType);
    }
    
    public function inserirPagamento($pagamento) {
        $this->controladorPagamento->inserir($pagamento);
    }
    
    public function alterarPagamento($pagamento) {
        $this->controladorPagamento->alterar($pagamento);
    }
    
    public function excluirPagamento($pagamento) {
        $this->controladorPagamento->excluir($pagamento);
    }
    
    public function listarPagamentos($fetchType) {
        return $this->controladorPagamento->listar($fetchType);
    }
    
    public function detalharPagamento($pagamento, $fetchType)
    {
        return $this->controladorPagamento->detalhar($pagamento, $fetchType);
    }

    public function inserirExameFisico($exameFisico)
    {
        $this->controladorExameFisico->inserir($exameFisico);
    }
    
    public function listarExamesFisicos($fetchType)
    {
        return $this->controladorExameFisico->listar($fetchType);
    }
    
    public function detalharExameFisico($exameFisico, $fetchType)
    {
        return $this->controladorExameFisico->detalhar($exameFisico, $fetchType);
    }
    
    
    public function inserirDica($dica, $pessoa) {
        $this->controladorDica->inserir($dica, $pessoa);
    }
    
    public function alterarDica($dica) {
        $this->controladorDica->alterar($dica);
    }

    public function excluirDica($dica) {
        return $this->controladorDica->excluir($dica);
    }

    public function listarDicas($pessoa) {
        return $this->controladorDica->listar($pessoa);
    }
    
    public function detalharDica($dica) {
        return $this->controladorDica->detalhar($dica);
    }
    
    public function inserirMusica($musica) {
        $this->controladorMusica->inserir($musica);        
    }
    
    public function alterarMusica($musica) {
        $this->controladorMusica->alterar($musica);
    }
    
    public function excluirMusica($musica) {
        $this->controladorMusica->excluir($musica);
    }

    public function detalharMusica($musica, $fetchType)
    {
        return $this->controladorMusica->detalhar($musica, $fetchType);
    }

    public function listarMusicas($fetchType)
    {
        return $this->controladorMusica->listar($fetchType);
    }
    
    public function inserirNoticia($noticia) {
        return $this->controladorNoticia->inserir($noticia);
    }

    public function alterarNoticia($noticia) {
        return $this->controladorNoticia->alterar($noticia);
    }

    public function excluirNoticia($noticia) {
        return $this->controladorNoticia->excluir($noticia);
    }
    
    public function listarNoticia($secretaria,$fetchType) {
        return $this->controladorNoticia->listar($secretaria,$fetchType);
    }

    public function detalharNoticia($noticia, $fetchType) {
        return $this->controladorNoticia->detalhar($noticia, $fetchType);
    }
}
