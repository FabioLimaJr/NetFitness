<?php
 //$secretaria = new Secretaria();
 $secretaria = $_SESSION['Secretaria'];
 $mensagem = "Selecione no meu na esquerda a opção escolhida."
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

    
    
    
    
    
    
    <h3>Malesuada Condimentum Inceptos Vehicula</h3>
    <p>Sed posuere consectetur est at lobortis. Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>
    <ul>
      <li>Sed posuere consectetur est at lobortis, Nullam id dolor id nibh ultricies vehicula. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
      <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </li>
      <li>Maecenas sed diam eget risus varius blandit sit amet non magna.</li>
    </ul>
    
    
    <?php include('componentes/footerOne.php') ?>