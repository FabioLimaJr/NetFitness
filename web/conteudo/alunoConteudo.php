<?php
 $aluno = $_SESSION['Aluno'];
 $mensagem = "Selecione no menu na esquerda a opção a ser escolhida."
?>

<h1 class="title">Página usuário</h1>
    <div class="line"></div>
    Telefone:<?php echo $aluno->getTelefone() ?> | Email:<?php echo $aluno->getEmail() ?>
    <div style="float:right"><image height = "80" src="<?php echo IMAGE_PATH_ALUNOS."/".$aluno->getFoto() ?>"> </div>
    <div class="intro" style="margin-bottom:50px">
         
    </div>
    
    <h3>Usuário logado: <?php echo $aluno->getNome() ?></h3>
   
    <div class="clear"></div>
    <div class="line"></div>

    <div class="note-box" style="margin-bottom: 50px">
        <?php echo $mensagem ?>
    </div>

    
    
    
    
   
    
    <?php include('componentes/footerOne.php') ?>