<?php
/**
 * Description of Fachada
 *
 * @author Marcelo
 */
class Fachada implements IFachada{
    
    private $controladorAluno;
    private $controladorInstrutor;
    private static $instance = null;
            
    function __construct() {
        $this->controladorAluno = new ControladorAluno();
        $this->controladorInstrutor = new ControladorInstrudor();
    }
    
    public static function getInstance(){
        if($this->instance === null){
             $this->instance = new Fachada();
        }
        return $this->instance;
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

    public function listarAluno() {
        
        return $this->controladorAluno->listar();
    }

    public function listarInstrutor() {
        
        return $this->controladorInstrutor->listar();
    }

}
