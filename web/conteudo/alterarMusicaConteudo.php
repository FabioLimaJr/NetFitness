<?php 
//$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";
$camposPreenchidos = false;

 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
     $camposPreenchidos = true;
 }
 if(isset($_SESSION['Musica']))
 {
     $musica = $_SESSION['Musica'];
 }
 
 try{
     
     $listaMusicas = $fachada->listarMusicas(LAZY);
     $_SESSION['$listaMusicas'] = $listaMusicas;
     
 } catch (Exception $ex) {
     $mensagem = $ex->getMessage();
 }
?>

<h1 class="title">Página usuário</h1>
<div class="line"></div>
    
Nome: <?php echo $secretaria->getNome() ?> | Telefone:<?php echo $secretaria->getTelefone() ?> | Email:<?php echo $secretaria->getEmail() ?> | Endereço:<?php echo $secretaria->getEndereco() ?>
    
<div class="intro" style="margin-bottom:50px">
         
</div>

<h3>Alterar Música</h3>
   
<div class="clear"></div>
<div class="line"></div>

<?php 
     if(!$camposPreenchidos){ 
?>

<div class="form-container" style="margin-bottom:50px">
    <form class="forms" action="alterarMusica.php" method="post" >
        <fieldset>
      
            <ol>
                <li class="form-row text-input-row">     
                    <table style="width:100%;margin-bottom:50px">
                        <tr>
                            <th>Titulo</th>
                            <th>Categoria</th>
                            <th>Artista</th>                            
                            <th>Selecionar</th>
                        </tr>
                        
                        <?php foreach ($listaMusicas as $musica){ ?>
                        
                        <tr>
                            <td><?php echo $musica->getTitulo() ?></td>     
                            <td><?php echo $musica->getCategoria() ?></td>                               
                            <td><?php echo $musica->getArtista() ?></td>     
                            <td><input type="radio" name="idMusica" value="<?php echo $musica->getIdMusica() ?>"></td>
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
         
         if(isset($_POST['idMusica'])){
             
             $musica = new Musica($_POST['idMusica']);
             $musicaRetornada = $fachada->detalharMusica($musica, EAGER);
             $_SESSION['musicaRetornada'] = $musicaRetornada;

?>

    <div class="form-container" style="margin-bottom:50px">
        <form class="forms" action="alterarMusica.php" method="post" >
            <fieldset>
                <ol>
                    
                    <li class="form-row text-input-row" >
                        <label>Titulo</label>
                        <input type="text" name="titulo" value="<?php if(isset($musicaRetornada)) echo $musicaRetornada->getTitulo() ?>" class="text-input" style="white: 300px">
                    </li>
                    
                    <li class="form-row text-input-row" >
                        <label>Categoria</label>
                        <input type="text" name="categoria" value="<?php if(isset($musicaRetornada)) echo $musicaRetornada->getCategoria() ?>" class="text-input" style="white: 300px">
                    </li>
                    
                    <li class="form-row text-input-row" >
                        <label>Artista</label>
                        <input type="text" name="artista" value="<?php if(isset($musicaRetornada)) echo $musicaRetornada->getArtista() ?>" class="text-input" style="white: 300px">
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
                 
             $musicaAlterada = new Musica($_SESSION['musicaRetornada']->getIdMusica());
             $musicaAlterada->setTitulo($_POST['titulo']);
             $musicaAlterada->setCategoria($_POST['categoria']);
             $musicaAlterada->setArtista($_POST['artista']);
             $musicaAlterada->setSecretaria($_SESSION['Secretaria']);
             
             try{
                 
                 $fachada->alterarMusica($musicaAlterada);
                 $mensagem = "A Musica foi alterada com sucesso!!";
                 
             } catch (Exception $ex) {
                 
                 $mensagem = $ex->getMessage();
                 
             }
        }else{
    
            $mensagem = "Não foi selecionado a Música";
        }
      }
    }
    
    if($camposPreenchidos && !isset($_POST['idMusica']) || isset($musicaAlterada)){
        
    ?>
    
        <h3>Mensagem</h3>
        <p><?php echo $mensagem ?></p>
    
    <?php } 
    
include('componentes/footerOne.php') ?>


