<?php
 $camposPreenchidos = false;
 $fachada = Fachada::getInstance();
 $mensagem = "";
 
  
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
     $camposPreenchidos = true;
 }
 if(isset($_SESSION['Noticia']))
 {
     $noticia = $_SESSION['Noticia'];
 }
 
 try{
     
     $listaNoticias = $fachada->listarNoticia($_SESSION['Secretaria'],LAZY);
     $_SESSION['$listaNoticias'] = $listaNoticias;
     
 } catch (Exception $ex) {
     $mensagem = $ex->getMessage();
 }
?>

<h1 class="title">Página usuário</h1>
<div class="line"></div>
    
Nome: <?php echo $secretaria->getNome() ?> | Telefone:<?php echo $secretaria->getTelefone() ?> | Email:<?php echo $secretaria->getEmail() ?> | Endereço:<?php echo $secretaria->getEndereco() ?>
    
<div class="intro" style="margin-bottom:50px">
         
</div>
  
<h3>Alterar Noticia</h3>
   
<div class="clear"></div>
<div class="line"></div>

<?php 
     if(!$camposPreenchidos){ 
?>

<div class="form-container" style="margin-bottom:50px">
    <form class="forms" action="alterarNoticia.php" method="post" >
        <fieldset>
      
            <ol>
                <li class="form-row text-input-row">     
                    <table style="width:100%;margin-bottom:50px">
                        <tr>
                            <th>Titulo</th> 
                            <th>Descrição</th>
                            <th>Data</th>
                            <th>Selecionar</th>
                        </tr>
                        
                        <?php foreach ($listaNoticias as $noticia){ ?>
                        
                        <tr>
                            <?php $noticia->setData(ExpressoesRegulares::inverterData($noticia->getData()))?>
                            <td><?php echo $noticia->getTitulo() ?></td> 
                            <td><?php echo $noticia->getDescricao() ?></td>    
                            <td><?php echo $noticia->getData() ?></td> 
                            <td><input type="radio" name="idNoticia" value="<?php echo $noticia->getIdNoticia() ?>"></td>
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
         
         if(isset($_POST['idNoticia'])){
             
             $noticia = new Noticia($_POST['idNoticia']);
             $noticiaRetornada = $fachada->detalharNoticia($noticia, EAGER);
             $_SESSION['noticiaRetornada'] = $noticiaRetornada;

?>

    <div class="form-container" style="margin-bottom:50px">
        <form class="forms" action="alterarNoticia.php" method="post" >
            <fieldset>
                <ol>
                    
                    <li class="form-row text-input-row" >
                        <label>Titulo</label>
                        <input type="text" name="titulo" value="<?php if(isset($noticiaRetornada)) echo $noticiaRetornada->getTitulo() ?>" class="text-input" style="width: 300px">
                    </li>
                    
                    <li class="form-row text-input-row">
                        <label>Descrição</label>
                        <input type="text" name="descricao" value="<?php if(isset($noticiaRetornada)) echo $noticiaRetornada->getDescricao() ?>" class="text-input" style="width: 300px">
                    </li>
                    
                    <li class="form-row text-input-row" >
                        <label>Data</label>
                        <input type="text" id="dataPicked" name="data" value="<?php if(isset($noticiaRetornada)) echo (ExpressoesRegulares::inverterData($noticiaRetornada->getData())) ?>" class="text-input" style="white: 300px">
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
             
             
                 
             $noticiaAlterada = new Noticia($_SESSION['noticiaRetornada']->getIdNoticia(),
                                            $_POST['titulo'],
                                            $_POST['descricao'],
                                            $_SESSION['Secretaria'],
                                            $_SESSION['noticiaRetornada']->getData());
             
             try{
                 
                 //$fachada->alterarExercicio($exercicioAlterado);
                 $fachada->alterarNoticia($noticiaAlterada);
                 $mensagem = "A Noticia foi alterada com sucesso!!";
                 
             } catch (Exception $ex) {
                 
                 $mensagem = $ex->getMessage();
                 
             }
        }else{
    
            $mensagem = "Não foi selecionado a Noticia";
        }
      }
    }
    
    if($camposPreenchidos && !isset($_POST['idNoticia']) || isset($noticiaAlterada)){
        
    ?>
    
        <h3>Mensagem</h3>
        <p><?php echo $mensagem ?></p>
    
    <?php } 
    
include('componentes/footerOne.php') ?>


