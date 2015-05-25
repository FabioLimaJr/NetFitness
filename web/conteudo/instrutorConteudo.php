<?php
 $instrutor = $_SESSION['Instrutor'];
 $mensagem = "Selecione no menu na esquerda a opção a ser escolhida."
?>

<h1 class="title">Página usuário</h1>
    <div class="line"></div>
    Telefone:<?php echo $instrutor->getTelefone() ?> | Email:<?php echo $instrutor->getEmail() ?> | Endereço:<?php echo $instrutor->getEndereco() ?>
    <div class="intro" style="margin-bottom:50px">
         
    </div>
    
    
    
    <h3>Usuário logado: <?php echo $instrutor->getNome() ?></h3>
   
    <div class="clear"></div>
    <div class="line"></div>

    <div class="note-box" style="margin-bottom: 50px">
        <?php echo $mensagem ?>
    </div>

    
    
    
    <?php include('componentes/footerOne.php') ?>