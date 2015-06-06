<?php
 $camposPreenchidos = false;
 $fachada = Fachada::getInstance();
 $mensagem = "";
 
  
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
     $camposPreenchidos = true;
 }
 if(isset($_SESSION['Opiniao']))
 {
     $opiniao = $_SESSION['Opiniao'];
 }
 
 try{
     
     $listaOpinioes = $fachada->listarOpinioes(LAZY);
     
 } catch (Exception $ex) {
     $mensagem = $ex->getMessage();
 }
?>

<h1 class="title">Página usuário</h1>
<div class="line"></div>
    
Nome: <?php echo $aluno->getNome() ?> | Telefone:<?php echo $aluno->getTelefone() ?> | Email:<?php echo $aluno->getEmail() ?> | Endereço:<?php echo $aluno->getEndereco() ?>
 <div style="float:right"><image height = "80" src="<?php echo IMAGE_PATH_ALUNOS."/".$aluno->getFoto() ?>"> </div>   
<div class="intro" style="margin-bottom:50px">
         
</div>
  
<h3>Alterar Opinião</h3>
   
<div class="clear"></div>
<div class="line"></div>

<?php 
     if(!$camposPreenchidos){ 
?>

<div class="form-container" style="margin-bottom:50px">
    <form class="forms" action="alterarOpiniao.php" method="post" >
        <fieldset>
      
            <ol>
                <li class="form-row text-input-row">     
                    <table style="width:100%;margin-bottom:50px">
                        <tr>
                            <th>Descrição</th> 
                            <th>Data de Postagem</th>
                            <th>Selecionar</th>
                        </tr>
                        
                        <?php foreach ($listaOpinioes as $opiniao){ ?>
                        
                        <tr>
                            <td><?php echo $opiniao->getDescricao() ?></td> 
                            <td><?php echo ExpressoesRegulares::inverterData($opiniao->getDataPostagem()) ?></td>    
                            <td><input type="radio" name="idOpiniao" value="<?php echo $opiniao->getIdOpiniao() ?>"></td>
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
         
         if(isset($_POST['idOpiniao'])){
             
             $opiniao = new Opiniao($_POST['idOpiniao']);
             //$exercicio->setIdExercicio($_POST['idExercicio']);
             $opiniaoRetornada = $fachada->detalharOpiniao($opiniao, LAZY);
             //var_dump($opiniaoRetornada);
             //echo $opiniaoRetornada->getDescricao();
             $_SESSION['opiniaoRetornada'] = $opiniaoRetornada;

?>

    <div class="form-container" style="margin-bottom:50px">
        <form class="forms" action="alterarOpiniao.php" method="post" >
            <fieldset>
                <ol>

                    <li class="form-row text-input-row">
                        <label>Descrição</label>
                        <textarea class="text-input" name="descricao" value="" style="width:500px; height: 100px"><?php if(isset($opiniaoRetornada)) echo $opiniaoRetornada->getDescricao() ?></textarea>
                    </li>

                    <li class="form-row text-input-row">
                        <label>Data de Postagem</label>
                        <input type="text" id="dataPicked" maxlength="10" name="data" value="<?php if(isset($opiniaoRetornada)) echo $opiniaoRetornada->getDataPostagem() ?>" class="text-input" style="width: 300px">
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
                 
             $opiniaoAlterada = new Opiniao($_SESSION['opiniaoRetornada']->getIdOpiniao());
             $opiniaoAlterada->setDescricao($_POST['descricao']);
             $opiniaoAlterada->setDataPostagem($_POST['data']);
             
             try{
                 
                 //$fachada->alterarExercicio($exercicioAlterado);
                 $fachada->alterarOpiniao($opiniaoAlterada);
                 $mensagem = "A opinião foi alterada com sucesso!!";
                 
             } catch (Exception $ex) {
                 
                 $mensagem = $ex->getMessage();
                 
             }
        }else{
    
            $mensagem = "Não foi selecionado a opinião";
        }
      }
    }
    
    if($camposPreenchidos && !isset($_POST['idOpiniao']) || isset($opiniaoAlterada)){
        
    ?>
    
        <h3>Mensagem</h3>
        <p><?php echo $mensagem ?></p>
    
    <?php } 
    
include('componentes/footerOne.php') ?>


