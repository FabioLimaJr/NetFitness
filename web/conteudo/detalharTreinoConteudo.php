<?php 

$fachada = Fachada::getInstance();
$mensagem ="";
$camposPreenchidos = false;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $camposPreenchidos = true;
}

try
{
    $listaTreinos = $fachada->listarTreinos($_SESSION['Instrutor'], EAGER);
    $listaExercicios = $fachada->listarExercicios(LAZY);
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
        
?>

<h1 class="title">Detalhar Treino</h1>
<div class="line"></div>
Telefone:<?php echo $instrutor->getTelefone() ?> | Email:<?php echo $instrutor->getEmail() ?> | Endereço:<?php echo $instrutor->getEndereco() ?>
<div class="intro" style="margin-bottom:50px"></div>
    
<h3>Usuário logado: <?php echo $instrutor->getNome() ?></h3>
   
<div class="clear"></div>
<div class="line"></div>

<?php if(!$camposPreenchidos) {?>

<div class="form-container" style="margin-bottom:50px">
      <form class="forms" action="detalharTreino.php" method="post" >
      <fieldset>
      
       <ol>
            <li class="form-row text-input-row">     
               <table style="width:100%;margin-bottom:50px">
                         <tr>
                           <th>Nome</th> 
                           <th>Descrição</th>
                           <th>Selecionar</th>
                         </tr>

                         <?php foreach ($listaTreinos as $treino){ ?>
                         <tr>
                             <td><?php echo $treino->getNome() ?></td> 
                             <td><?php echo $treino->getDescricao() ?></td>    
                             <td><input type="radio" name="idTreino" value="<?php echo $treino->getIdTreino() ?>"></td>
                         </tr>

                         <?php 
                         
                         } ?>

               </table>
             </li>

             <li class="form-row text-input-row" style="text-align:center;margin-left:-100px">
                    <input type="submit" value="Detalhar" name="submit" class="btn-submit">

             </li>       
        </ol>  
       </fieldset>
       </form>
    </div>

    <?php }
    else{
        
        if(count($_POST)>1){
            
            try{
                
                $treino = new Treino($_POST['idTreino']);
                $treinoRetornado = $fachada->detalharTreino($treino, EAGER);
                
                //$treinoRetornado->setListaExercicios($listaExercicios);
                ?>
                
                <div style="margin-bottom: 50px">
                     
                    <table style="width:100%">
                        <tr>
                            <td>Nome</td>
                            <td>Descrição</td>
                            <td>Instrutor</td>
                            <td>Exercicios</td>
                            <td>Series</td>
                            <td>Repetições</td>
                            <td>Descrição dos Exercicios</td>
                        </tr>
                        <?php if($treinoRetornado->getListaExercicios()!=null)
                                    { ?>
                                     <tr>
                                        <td rowspan="<?php echo count($treinoRetornado->getListaExercicios()) ?>"><?php echo $treinoRetornado->getNome() ?></td>
                                        <td rowspan="<?php echo count($treinoRetornado->getListaExercicios()) ?>"><?php echo $treinoRetornado->getDescricao() ?></td>
                                        <td rowspan="<?php echo count($treinoRetornado->getListaExercicios()) ?>"><?php echo $treinoRetornado->getInstrutor()->getNome() ?></td>
                                
                                            <td><?php echo $treinoRetornado->getListaExercicios()[0]->getNome() ?></td>
                                            <td><?php echo $treinoRetornado->getListaExercicios()[0]->getSeries() ?></td>
                                            <td><?php echo $treinoRetornado->getListaExercicios()[0]->getRepeticoes() ?></td>
                                            <td><?php echo $treinoRetornado->getListaExercicios()[0]->getDescricao() ?></td>
                                      </tr>
                                      
                                        <?php for($count=1; $count<count($treinoRetornado->getListaExercicios());$count++) {?>
                                            <tr>
                                                <td><?php echo $treinoRetornado->getListaExercicios()[$count]->getNome() ?></td>
                                                <td><?php echo $treinoRetornado->getListaExercicios()[$count]->getSeries() ?></td>
                                                <td><?php echo $treinoRetornado->getListaExercicios()[$count]->getRepeticoes() ?></td>
                                                <td><?php echo $treinoRetornado->getListaExercicios()[$count]->getDescricao() ?></td>
                                            </tr>
                                        <?php }
                                    }else{
                                        ?>
                                        <tr>
                              
                                               <td>Nenhum exercicio foi encontrado nesse treino</td>
                                               
                                        </tr>
                                        <?php } ?>
                    </table>
                </div>
            <?php
            
            } catch (Exception $ex) {
                $mensagem = $ex->getMessage();
                ?> <h3>Mensagem</h3>
                <p><?php echo $mensagem ?></p> <?php
            }
        }else{
            $mensagem = "Não foi selecionado o Treino";
            ?> <h3>Mensagem</h3>
            <p><?php echo $mensagem ?></p> <?php
        }
    }
    
    include('componentes/footerOne.php') ?>