<?php
 $nutricionista = $_SESSION['Nutricionista'];
 $mensagem = "Selecione no menu na esquerda a opção a ser escolhida."
?>

<h1 class="title">Página usuário</h1>
    <div class="line"></div>
    Telefone:<?php echo $nutricionista->getTelefone() ?> | Email:<?php echo $nutricionista->getEmail() ?> | Endereço:<?php echo $nutricionista->getEndereco() ?>
    <div class="intro" style="margin-bottom:50px">
         
    </div>
    
    
    
    <h3>Usuário logado: <?php echo $nutricionista->getNome() ?></h3>
   
    <div class="clear"></div>
    <div class="line"></div>

    <div class="note-box" style="margin-bottom: 50px">
        <?php echo $mensagem ?>
    </div>

    
   
    
    <?php include('componentes/footerOne.php') ?>