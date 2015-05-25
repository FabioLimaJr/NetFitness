<?php
 $secretaria = $_SESSION['Secretaria'];
 $mensagem = "Selecione no menu na esquerda a opção a ser escolhida."
?>

<h1 class="title">Página usuário</h1>
    <div class="line"></div>
    Telefone:<?php echo $secretaria->getTelefone() ?> | Email:<?php echo $secretaria->getEmail() ?> | Endereço:<?php echo $secretaria->getEndereco() ?>
    <div class="intro" style="margin-bottom:50px">
         
    </div>
    
    
    
    <h3>Usuário logado: <?php echo $secretaria->getNome() ?></h3>
   
    <div class="clear"></div>
    <div class="line"></div>

    <div class="note-box" style="margin-bottom: 50px">
        <?php echo $mensagem ?>
    </div>

    
    
    
    
    
   
    
    <?php include('componentes/footerOne.php') ?>