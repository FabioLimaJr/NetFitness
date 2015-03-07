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
        $controladorAluno = new ControladorAluno();
        $controladorInstrutor = new ControladorInstrudor();
    }
    
    public static function getInstance(){
        if($instance === null){
             $instance = new Fachada();
        }
        return $instance;
    }
    
    public function alterarAluno($aluno) {
        
        $controladorAluno->alterar($aluno);
    }

    public function alterarInstrutor($instrutor) {
        
        $controladorInstrutor->alterar($instrutor);
    }

    public function detalharAluno($aluno) {
        
        $controladorAluno->detalhar($aluno);
    }

    public function detalharInstrutor($instrutor) {
        
        $controladorInstrutor->detalhar($instrutor);
    }

    public function excluirAluno($aluno) {
        
        $controladorAluno->excluir($aluno);
    }

    public function excluirInstrutor($instrutor) {
        
        $controladorInstrutor->alterar($instrutor);
    }

    public function incluirAluno($aluno) {
        
        $controladorAluno->incluir($aluno);
    }

    public function incluirInstrutor($instrutor) {
        
        $controladorInstrutor->incluir($instrutor);
    }

    public function listarAluno() {
        
        return $controladorAluno->listar();
    }

    public function listarInstrutor() {
        
        return $controladorInstrutor->listar();
    }

}
