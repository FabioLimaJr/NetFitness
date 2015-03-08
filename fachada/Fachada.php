<?php
/**
 * Description of Fachada
 *
 * @author Marcelo
 */
class Fachada implements IFachada{
    
    private $controladorAluno;
    private $controladorInstrutor;
    private $controladorSecretaria;
    private static $instance = null;
            
    function __construct() {
        //$this->controladorAluno = new ControladorAluno();
        $this->controladorInstrutor = new ControladorInstrutor();
        $this->controladorSecretaria = new ControladorSecretaria();
    }
    
    public static function getInstance(){
        if(self::$instance === null){
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

    public function detalharAluno($aluno) {
        
        $this->controladorAluno->detalhar($aluno);
    }

    public function detalharInstrutor($instrutor) {
        
        $this->controladorInstrutor->detalhar($instrutor);
    }

    public function excluirAluno($aluno) {
        
        $this->controladorAluno->excluir($aluno);
    }

    public function excluirInstrutor($instrutor) {
        
        $this->controladorInstrutor->alterar($instrutor);
    }

    public function incluirAluno($aluno) {
        
        $this->controladorAluno->incluir($aluno);
    }

    public function incluirInstrutor($instrutor) {
        
        $this->controladorInstrutor->incluir($instrutor);
    }

    public function listarAlunos() {
        
        return $this->controladorAluno->listar();
    }

    public function listarInstrutores() {
        
        return $this->controladorInstrutor->listar();
    }

    public function incluirSecretaria($secretaria){
        
        $this->controladorSecretaria->inserir($secretaria);
    }
    
    public function alterarSecretaria($secretaria){
        /*
         * como no alterar os campos passam pelas mesmas validações do inserir
         * eu usei o mesmo metodo para validar os campos e lá fiz uma validação
         * para ver se é um inserir ou alterar.
         */
        $this->controladorSecretaria->inserir($secretaria);
    }
}
