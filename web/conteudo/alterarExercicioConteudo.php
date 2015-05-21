<?php

//$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";
$camposPreenchidos = false;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $camposPreenchidos = true;
}

try
{
    $listaExercicios = $fachada->listarExercicios();

} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}
?>

<h1 class="title">Alterar Exercicio</h1>
<div class="line"></div>
Telefone:<?php echo $instrutor->getTelefone() ?> | Email:<?php echo $instrutor->getEmail() ?> | Endereço:<?php echo $instrutor->getEndereco() ?>
<div class="intro" style="margin-bottom:50px"></div>

<h3>Usuário logado: <?php echo $instrutor->getNome() ?></h3>
<div class="clear"></div>
<div class="line"></div>

<?php 
     if(!$camposPreenchidos){ 
?>
<div class="form-container" style="margin-bottom:50px">
    <form class="forms" action="alterarExercicio.php" method="post" >
        <fieldset>
      
            <ol>
                <li class="form-row text-input-row">     
                    <table style="width:100%;margin-bottom:50px">
                        <tr>
                            <th>Nome Exercicio</th> 
                            <th>Músculo</th>
                            <th>Descrição</th>
                            <th>Selecionar</th>
                        </tr>
                        
                        <?php foreach ($listaExercicios as $exercicio){ ?>
                        
                        <tr>
                            <td><?php echo $exercicio->getNome() ?></td> 
                            <td><?php echo $exercicio->getMusculo() ?></td>  
                            <td><?php echo $exercicio->getDescricao() ?></td>  
                            <td><input type="radio" name="idExercicio" value="<?php echo $exercicio->getIdExercicio() ?>"></td>
                        </tr>
                        <?php 
                            } 
                        ?>

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

<?php 
     }else{
         
         if(isset($_POST['idExercicio'])){
             
             $exercicio = new Exercicio($_POST['idExercicio']);
             $exercicioRetornado = $fachada->detalharExercicio($exercicio);
             
             $_SESSION['exercicioRetornado'] = $exercicioRetornado;

?>

    <div class="form-container" style="margin-bottom:50px">
        <form class="forms" action="alterarExercicio.php" method="post" >
            <fieldset>
                <ol>

                    <li class="form-row text-input-row">
                        <label>Nome</label>
                        <input type="text" name="nome" value="<?php if(isset($exercicioRetornado)) echo $exercicioRetornado->getNome() ?>" class="text-input" style="width: 300px">
                    </li>

                    <li class="form-row text-input-row">
                        <label>Músculo</label>
                        <input type="text" name="musculo" value="<?php if(isset($exercicioRetornado)) echo $exercicioRetornado->getMusculo() ?>" class="text-input" style="width: 300px">
                    </li>

                    <li class="form-row text-input-row">
                        <label>Descrição</label>
                        <input type="text" name="descricao" value="<?php if(isset($exercicioRetornado)) echo $exercicioRetornado->getDescricao() ?>" class="text-input" style="width: 300px">
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
             
             if($_POST['submit'] == 'Salvar Alterações'){
                 
             $exercicioAlterado = new Exercicio($_SESSION['exercicioRetornado']->getIdExercicio(), $_POST['nome'], $_POST['musculo'], $_POST['descricao']);
             
             try{
                 
                 //$fachada->alterarExercicio($exercicioAlterado);
                 $fachada->alterarExercicio($exercicioAlterado);
                 $mensagem = "O exercício foi alterado com sucesso!!";
                 
             } catch (Exception $ex) {
                 
                 $mensagem = $exc->getMessage();
                 
             }
        }else{
    
            $mensagem = "Não foi selecionado o exercicio";
        }
      }
    }
    
    if($camposPreenchidos && !isset($_POST['idExercicio']) || isset($exercicioAlterado)){
?>
    
    <h3>Mensagem</h3>
    <p><?php echo $mensagem ?></p>
    
    <?php } 
    
    include('componentes/footerOne.php') ?>