<?php

//$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";

try {
    
    $listaNoticias = $fachada->listarNoticia($_SESSION['Secretaria'], LAZY);
    
} catch (Exception $exc) {
    echo $exc->getMessage();
}

?>

<h1 class="title">Listar Noticias</h1>
    <div class="line"></div>
    Telefone:<?php echo $secretaria->getTelefone() ?> | Email:<?php echo $secretaria->getEmail() ?> | Endereço:<?php echo $secretaria->getEndereco() ?>
    <div class="intro" style="margin-bottom:50px"></div>

<h3>Usuário logado: <?php echo $secretaria->getNome() ?></h3>
   
    <div class="clear"></div>
    <div class="line"></div>

    <div style="margin-bottom: 50px">
        <table style="width: 100%">
            <tr>
               <th>Titulo</th>
               <th>Descrição</th>
               <th>Data</th>
            </tr>
            
            <?php foreach ($listaNoticias as $noticia){ ?>
                    <tr>
                        <td><?php echo $noticia->getTitulo() ?></td>
                        <td><?php echo $noticia->getDescricao() ?></td> 
                        <td><?php echo ExpressoesRegulares::inverterData($noticia->getData()) ?></td> 
                    </tr>
                  
            <?php } ?>
        </table>
    </div>
    
     <?php include('componentes/footerOne.php') ?>