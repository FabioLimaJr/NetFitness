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
?>

<h1 class="title">Página usuário</h1>
    <div class="line"></div>
    
    Nome: <?php echo $secretaria->getNome() ?> | Telefone:<?php echo $secretaria->getTelefone() ?> | Email:<?php echo $secretaria->getEmail() ?> | Endereço:<?php echo $secretaria->getEndereco() ?>
    
    <div class="intro" style="margin-bottom:50px">
         
    </div>
    
    
    
    <h3>Inserir Noticia</h3>
   
    <div class="clear"></div>
    <div class="line"></div>
    
   <?php 
   
    if(!$camposPreenchidos)
    {   
        ?> 
         <div class="form-container" style="margin-bottom:50px">
         <form class="forms" action="inserirNoticia.php" method="post" >
         <fieldset>
           <ol>

                <li class="form-row text-input-row">
                    <label>Titulo</label>
                    <input type="text" name="titulo" value="<?php if(isset($noticia)) echo $noticia->getTitulo() ?>" class="text-input" style="width: 300px">
                </li>
                    
                <li class="form-row text-input-row">
                    <label>Descrição</label>
                    <textarea class="text-input" name="descricao" value="<?php if(isset($noticia)) echo $noticia->getDescricao() ?>" style="width:300px; height: 100px"></textarea>
                </li>
                    
                <li class="form-row text-input-row">
                    <label>Data</label>
                    <input type="text" name="data" id="dataPicked" value="<?php if(isset($noticia)) echo ExpressoesRegulares::inverterData($noticia->getData()) ?>" class="text-input" style="white: 300px">
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

             $noticia = new Noticia(null, 
                                    $_POST['titulo'], 
                                    $_POST['descricao'], 
                                    $secretaria,
                                    ExpressoesRegulares::inverterData($_POST['data']));

             $_SESSION['Secretaria'] = $secretaria; 
            
             try
             {
                $fachada->inserirNoticia($noticia);
                $mensagem = "Parabéns, a Noticia foi incluida com sucesso!";
                
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
