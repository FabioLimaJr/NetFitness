<?php
 $camposPreenchidos = false;
 $fachada = Fachada::getInstance();
 $mensagem = "";
 
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
     $camposPreenchidos = true;
 }
 if(isset($_SESSION['Musica']))
 {
     $musica = $_SESSION['Musica'];
 }
?>

<h1 class="title">Página usuário</h1>
    <div class="line"></div>
    
    Nome: <?php echo $secretaria->getNome() ?> | Telefone:<?php echo $secretaria->getTelefone() ?> | Email:<?php echo $secretaria->getEmail() ?> | Endereço:<?php echo $secretaria->getEndereco() ?>
    
    <div class="intro" style="margin-bottom:50px">
         
    </div>
    
    
    
    <h3>Inserir Música</h3>
   
    <div class="clear"></div>
    <div class="line"></div>
    
    
    <?php 
   
    if(!$camposPreenchidos)
    {   
        ?> 
         <div class="form-container" style="margin-bottom:50px">
            <form class="forms" action="inserirMusica.php" method="POST" >
                <fieldset>
                    <ol>

                        <li class="form-row text-input-row">
                            <label>Titulo</label>
                            <input type="text" name="titulo" value="<?php if(isset($musica)) echo $musica->getTitulo() ?>" class="text-input" style="white: 300px">
                        </li>
                        
                        <li class="form-row text-input-row">
                            <label>Categoria</label>
                            <input type="text" name="categoria" value="<?php if(isset($musica)) echo $musica->getCategoria() ?>" class="text-input" style="white: 300px">
                        </li>
                        
                        <li class="form-row text-input-row">
                            <label>Artista/Banda</label>
                            <input type="text" name="artista" value="<?php if(isset($musica)) echo $musica->getArtista() ?>" class="text-input" style="white: 300px">
                        </li>
                                        
                        <li class="button-row" style="margin-top: 50px">                        
                            <input type="submit" name="submit" value="Inserir" class="btn-submit">
                        </li>
                    </ol>
                </fieldset>
            </form>
       <div class="response"></div>
     </div>
    
        <?php 
    } 
    else
    {

             $musica = new Musica(null, 
                                    $_POST['titulo'], 
                                    $_POST['categoria'],
                                    $_POST['artista'],
                                    $secretaria);

             $_SESSION['Secretaria'] = $secretaria; 
            // var_dump($_SESSION['Secretaria']);

             try
             {
                $fachada->inserirMusica($musica);
                $mensagem = "Parabéns, a Música foi incluida com sucesso!";
                unset($_SESSION['Musica']);

             }
             catch(Exception $exc)
             {
                $mensagem = $exc->getMessage();
             }
    }
    
    ?>
    
    <h3>Mensagem</h3>
    <p><?php echo $mensagem ?></p>
    
    <?php include('componentes/footerOne.php') ?>