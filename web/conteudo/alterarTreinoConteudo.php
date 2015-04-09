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
         
         if(isset($_POST['idTreino']))){
             
             $treino = new Treino($_POST['idTreino']);
             $treinoRetornado = $fachada->detalharTreino($treino, EAGER);
             
             $listaExerciciosNaoSelecionados = array();
             $listaExerciciosSelecionados = $treino->getListaExercicios();
             
             foreach($listaExercicios as $exercicio){
                 
                 $exercicioPresemte = false;
                 foreach($listaExerciciosSelecionados as $exercicioSelecionado){
                     
                     if($exercicioSelecionado->getIdExercicio() == $exercicio->getIdExercicio()){
                         
                         $exercicioPresemte = true;
                     }
                 }
                 
                 if(!$exercicioPresemte){
                         array_push($listaExerciciosNaoSelecionados, $exercicio);
                 }
             }
             
             $_SESSION['exercicioRetornado']=$exercicioRetornado;
     
     ?>


