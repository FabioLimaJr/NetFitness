<?php

//$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";

try {
    
    $listaAlimento = $fachada->listarAlimentos($_SESSION['Nutricionista']);
    
} catch (Exception $exc) {
    echo $exc->getMessage();
}

?>

<h1 class="title">Listar Alimento</h1>
    <div class="line"></div>
    Telefone:<?php echo $nutricionista->getTelefone() ?> | Email:<?php echo $nutricionista->getEmail() ?> | Endereço:<?php echo $nutricionista->getEndereco() ?>
    <div class="intro" style="margin-bottom:50px"></div>

<h3>Usuário logado: <?php echo $nutricionista->getNome() ?></h3>
   
    <div class="clear"></div>
    <div class="line"></div>

    <div style="margin-bottom: 50px">
        <table style="width: 100%">
            <tr>
               <th>Descrição</th> 
               <th>Caloria</th>
               <th>Proteina</th>
               <th>Carboidrato</th>
               <th>Gordura</th>
               <th>Quantidade Alimento</th>
            </tr>
            
            <?php foreach ($listaAlimento as $alimento){ ?>
                    <tr>
                        <td><?php echo $alimento->getDescricao() ?></td> 
                        <td><?php echo $alimento->getCaloria() ?></td>
                        <td><?php echo $alimento->getProteina() ?></td>
                        <td><?php echo $alimento->getCarboidrato() ?></td>
                        <td><?php echo $alimento->getGordura() ?></td>
                        <td><?php echo $alimento->getQtdAlimento() ?></td>
                    </tr>
                  
            <?php } ?>
        </table>
    </div>
    
     <?php include('componentes/footerOne.php') ?>