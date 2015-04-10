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
     
     $listaOpinioes = $fachada->listarOpinioesAluno($_SESSION['Aluno']);
     
 } catch (Exception $ex) {
     $mensagem = $ex->getMessage();
 }
?>

<h1 class="title">Página usuário</h1>
<div class="line"></div>
    
Nome: <?php echo $aluno->getNome() ?> | Telefone:<?php echo $aluno->getTelefone() ?> | Email:<?php echo $aluno->getEmail() ?> | Endereço:<?php echo $aluno->getEndereco() ?>
    
<div class="intro" style="margin-bottom:50px">
         
</div>
  
<h3>Inserir Opinião</h3>
   
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
                            <td><?php echo $opiniao->getDataPostagem() ?></td>    
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
         
         if($_POST['idOpiniao']){
             
             $opiniao = new Opiniao($_POST['idOpiniao']);
             //$exercicio->setIdExercicio($_POST['idExercicio']);
             $opiniaoRetornada = $fachada->detalharOpiniao($opiniao);
             
             $_SESSION['opiniaoRetornada'] = $opiniaoRetornada;

?>

<div class="form-container" style="margin-bottom:50px">
             <form class="forms" action="alterarOpiniao.php" method="post" >
         <fieldset>
           <ol>

              <li class="form-row text-input-row">
                        <label>Descrição</label>
                        <textarea class="text-input" name="descricao" value="<?php if(isset($opiniaoRetornada)) echo $opiniaoRetornada->getDescricao() ?>" style="width:500px; height: 100px"></textarea>
              </li> 

             <li class="form-row text-input-row">
                 <label><?php if(isset($opiniaoRetornada)) echo $opiniaoRetornada->getDescricao() ?></label>
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
             $opiniaoAlterada->setDataPostagem($opiniaoRetornada->getDataPostagem());
             // PAROU AQUI-----------------------
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


