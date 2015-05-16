<?php
/**
 * Description of RepositorioGenerico
 *
 * @author Daniele
 */

include ($serverPath.'conexao/Conexao.php');

class RepositorioGenerico extends Conexao 
{
       
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function listarObjetos($objeto, $objetoRelacionado, $fetchType)
    {
        
        //$arrayPesquisaSimples = ['Instrutor','Secretaria','Nutricionista', 'Treino', 'Pagamento', 'ExameFisico', 'Dica', 'Opiniao'];
        
        $listaObjetos = array();
        $nomeClasseObjeto = get_class($objeto);
        $nomeRepositorio = "Repositorio".get_class($objeto);
        $nomeClasseObjetoRelacionado = get_class($objetoRelacionado);
                
        $repositorioObjeto = new $nomeRepositorio();
        
        if($nomeClasseObjeto == "Dieta" || $nomeClasseObjeto == "Treino")
        {
          $listaObjetos = $repositorioObjeto->listar($objetoRelacionado, EAGER);
        }
        else
        {
            $listaObjetos = $repositorioObjeto->listar(EAGER);
        }
        
        $getObjetoRelacionado = "get".$nomeClasseObjetoRelacionado;
        $getIdObjetoRelacionado = "getId".$nomeClasseObjetoRelacionado;
        $setObjeto = "set".$nomeClasseObjeto;
        $objetoRetornado = array();
        
        foreach ($listaObjetos as $objeto)
        {
            if($objeto->$getObjetoRelacionado()->$getIdObjetoRelacionado() == $objetoRelacionado->$getIdObjetoRelacionado())
            {
                if(in_array($setObjeto, get_class_methods($objetoRelacionado)))
                {
                    $objetoRetornado = $repositorioObjeto->detalhar($objeto, $fetchType);
                }
                else 
                {
                    array_push($objetoRetornado,  $repositorioObjeto->detalhar($objeto, $fetchType));
                }
                
            }
        }
        
        return $objetoRetornado;
    }
    
    public function detalharObjeto($objeto, $fetchType)
    {
   
        $nomeRepositorio = "Repositorio".get_class($objeto);
        $repositorioObjeto = new $nomeRepositorio();
        return $repositorioObjeto->detalhar($objeto, $fetchType);
    }
}

?>
