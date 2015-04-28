<?php

$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";

try {
    
    $listaMusicas = $fachada->listarMusicas(EAGER);
    
} catch (Exception $exc) {
    echo $exc->getMessage();
}

?>

<h1 class="title">Listar Músicas</h1>
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
            </tr>
            
            <?php foreach ($listaMusicas as $musica){ ?>
                    <tr>
                        <td><?php echo $musica->getTitulo() ?></td>
                    </tr>
                  
            <?php } ?>
        </table>
    </div>
    
     <?php include('componentes/footerOne.php') ?>