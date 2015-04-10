<?php

$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";

try {
    
    $listaOpinioes = $fachada->listarOpinioes($_SESSION['Aluno']);
    
} catch (Exception $exc) {
    echo $exc->getMessage();
}

?>

<h1 class="title">Listar Opiniões</h1>
    <div class="line"></div>
    Telefone:<?php echo $aluno->getTelefone() ?> | Email:<?php echo $aluno->getEmail() ?> | Endereço:<?php echo $aluno->getEndereco() ?>
    <div class="intro" style="margin-bottom:50px"></div>

<h3>Usuário logado: <?php echo $aluno->getNome() ?></h3>
   
    <div class="clear"></div>
    <div class="line"></div>

    <div style="margin-bottom: 50px">
        <table style="width: 100%">
            <tr>
               <th>Descrição</th> 
               <th>Data Postagem</th>
            </tr>
            
            <?php foreach ($listaOpinioes as $opiniao){ ?>
                    <tr>
                        <td><?php echo $opiniao->getDescricao() ?></td> 
                        <td><?php echo $opiniao->getDataPostagem() ?></td>
                    </tr>
                  
            <?php } ?>
        </table>
    </div>
    
     <?php include('componentes/footerOne.php') ?>