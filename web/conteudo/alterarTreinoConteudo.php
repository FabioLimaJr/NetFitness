<?php 

$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";
$camposPreenchidos = false;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $camposPreenchidos = true;
}

try
{
    $listaTreinos = $fachada->listarTreinos($_POST['Instrutor'], EAGER);
    $listaExercicios = $fachada->listarExercicios();
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
    
?>

<h1 class="title">Alterar Treino</h1>
<div class="line"></div>

Telefone:<?php echo $instrutor->getTelefone() ?> | Email:<?php echo $instrutor->getEmail() ?> | Endereço:<?php echo $instrutor->getEndereco() ?>
<div class="intro" style="margin-bottom:50px"></div>

<h3>Usuário logado: <?php echo $instrutor->getNome() ?></h3>

<div class="clear"></div>
<div class="line"></div>

<?php 
     if(!$camposPreenchidos) 
     { ?>

<div class="form-container" style="margin-bottom:50px">
      <form class="forms" action="alterarTreino.php" method="post" >
      <fieldset>
      
       <ol>
            <li class="form-row text-input-row">     
               <table style="width:100%;margin-bottom:50px">
                         <tr>
                           <th>Nome</th> 
                           <th>Descrição</th>
                           <th>Exercicio</th>
                           <th>Selecionar</th>
                         </tr>

                         <?php foreach ($listaTreinos as $treino){ ?>
                         <tr>
                             <td><?php echo $treino->getNome() ?></td> 
                             <td><?php echo $treino->getDescricao() ?></td>  
                             <td>
                                 Falta lista de Exercicios
                             </td>  
                             <td><input type="radio" name="idTreino" value="<?php echo $treino->getIdTreino() ?>"></td>
                         </tr>

                         <?php 
                         
                    
                         } ?>

               </table>
             </li>

             <li class="form-row text-input-row" style="text-align:center;margin-left:-100px">
                    <input type="submit" value="Alterar" name="submit" class="btn-submit">
                    <input type="hidden" name="">
             </li>       
        </ol>  
       </fieldset>
       </form>
    </div>

     <?php }else{
         
         if(isset($_POST['idTreino'])){
             
             $treino = new Treino($_POST['idTreino']);
             $treinoRetornado = $fachada->detalharTreino($treino, EAGER);
             
             $listaExerciciosNaoSelecionados = array();
             $listaExerciciosSelecionados = $treino->getListaExercicios();
             
             foreach($listaExercicios as $exercicio){
                 
                 $exercicioPresente = false;
                 foreach($listaExerciciosSelecionados as $exercicioSelecionado){
                     
                     if($exercicioSelecionado->getIdExercicio() == $exercicio->getIdExercicio()){
                         
                         $exercicioPresente = true;
                     }
                 }
                 
                 if(!$exercicioPresente){
                         array_push($listaExerciciosNaoSelecionados, $exercicio);
                 }
             }
             
             $_SESSION['treinoRetornado']=$treinoRetornado;
     
     ?>

     <div class="form-container" style="margin-bottom:50px">
        <form class="forms" action="alterarTreino.php" method="post" >
              <fieldset>
                  <ol>
                      <li class="form-row text-input-row">
                            <label>Nome</label>
                            <input type="text" name="nome" value="<?php if(isset($treinoRetornado)) echo $treinoRetornado->getNome() ?>" class="text-input" style="width: 300px">
                      </li>
                      <li class="form-row text-input-row">
                            <label>Descrição</label>
                            <input type="text" name="descricao" value="<?php if(isset($treinoRetornado)) echo $treinoRetornado->getNome() ?>" class="text-input" style="width: 300px">
                      </li>

                      <li class="form-row text-input-row">
                      <label>Exercícios</label>   
                      <table style="width:500px; margin-left:100px">
                        <tr>
                          <th>Nome</th> 
                          <th>Músculo</th>
                          <th>Series</th>
                          <th>Repetições</th>
                          <th>Selecione</th>
                        </tr>

                        <?php foreach ($listaExerciciosSelecionados as $exercicioSelecionado) { ?>
                             <tr>
                                 <td> <?php echo $exercicioSelecionado->getNome() ?> </td>
                                 <td> <?php echo $exercicioSelecionado->getMusculo() ?> </td>
                                 <td> <input type="text" name="series<?php echo $exercicioSelecionado->getIdExercicio() ?>" value="<?php if(isset($treinoRetornado)) echo $treinoRetornado->getSerie() ?>" class="text-input" style="width: 30px"> </td>
                                 <td> <input type="text" name="repeticoes<?php echo $exercicioSelecionado->getIdExercicio() ?>" value="<?php if(isset($treinoRetornado)) echo $treinoRetornado->getRepeticoes() ?>" class="text-input" style="width: 30px"> </td>
                                 <td> <input type="checkbox" name="exercicio<?php echo $exercicioSelecionado->getIdExercicio() ?>" value="true" style="width: 30px" checked> </td>
                             </tr>

                          <?php } 
                            foreach ($listaExerciciosNaoSelecionados as $exercicioNaoSelecionado) {
                          ?>
                             <tr>
                                 <td> <?php echo $exercicioNaoSelecionado->getNome() ?> </td>
                                 <td> <?php echo $exercicioNaoSelecionado->getMusculo() ?> </td>
                                 <td> <input type="text" name="series<?php echo $exercicioNaoSelecionado->getIdExercicio() ?>" value="<?php if(isset($treinoRetornado)) echo $treinoRetornado->getSerie() ?>" class="text-input" style="width: 30px"> </td>
                                 <td> <input type="text" name="repeticoes<?php echo $exercicioNaoSelecionado->getIdExercicio() ?>" value="<?php if(isset($treinoRetornado)) echo $treinoRetornado->getRepeticoes() ?>" class="text-input" style="width: 30px"> </td>
                                 <td> <input type="checkbox" name="exercicio<?php echo $exercicioNaoSelecionado->getIdExercicio() ?>" value="true" style="width: 30px"> </td>
                             </tr>

                          <?php } ?>

                       </table>
                       </li>

                       <li class="button-row" style="margin-top:50px">
                           <input type="submit" value="Salvar Alterações" name="submit" class="btn-submit">
                       </li>
                </ol>
            </fieldset>
        </form>
        <div class="response"></div>
    </div>

    <?php 
         }else{
             
             if($_POST['submit']=='Salvar Alterações'){
                 
                 $exerciciosSelecionados = array();
                 
                 foreach(array_keys($_POST) as $parametro){
                     
                    if(strpos($parametro,'exercicio') !== false)
                    {
                        $idExercicio = explode("exercicio", $parametro);

                        foreach($listaExercicios as $exercicio) 
                        {
                             if ($idExercicio[1] == $exercicio->getIdExercicio()) 
                             {
                                 //$postSerie = "serie".$idExercicio;
                                 $exercicio->setSeries($_POST['series'.$exercicio->getIdExercicio()]);
                                 //echo $exercicio->getSeries();
                                 $exercicio->setRepeticoes($_POST['repeticoes'.$exercicio->getIdExercicio()]);
                                 //echo $exercicio->getRepeticoes();
                                 array_push($exerciciosSelecionados, $exercicio);
                                 break;
                             }
                        }
                    }
                }
                
                $treinoAlterado = new Treino();
                $treinoAlterado->setIdTreino($_SESSION['treinoRetornado']);
                $treinoAlterado->setNome($_POST['nome']);
                $treinoAlterado->setDescricao($_POST['descricao']);
                $treinoAlterado->setInstrutor($instrutor);
                $treinoAlterado->setListaExercicios($exerciciosSelecionados);
                
                try{
                    
                    $fachada->alterarTreino($treinoAlterado);
                    unset($_SESSION['Treino']);
                    $mensagem = "O treino foi alterado com sucesso!!";
                } catch (Exception $ex) {
                    $mensagem = $ex->getMessage();
                }
             }else{
                 $mensagem = "Não foi selecionado o treino!!";
             }
         }
     }
     
     if($camposPreenchidos && !isset($_POST['idTreino']) || isset($treinoAlterado)){
        
   ?>

    <h3>Mensagem</h3>
    <p><?php echo $mensagem ?></p>
    <?php 
    
        } 
    include('componentes/footerOne.php') 
    ?>


