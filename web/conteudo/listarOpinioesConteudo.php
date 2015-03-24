<?php

$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";

try
{
    $listaOpinioes = $fachada->listarOpinioes($_SESSION['Secretaria']);
   // var_dump($listaOpinioes);
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   

?>

<h1 class="title">Listar Opinioes dos Alunos</h1>
    <div class="line"></div>
    Nome: <?php echo $secretaria->getNome() ?> | Telefone:<?php echo $secretaria->getTelefone() ?> | Email:<?php echo $secretaria->getEmail() ?>
    <div class="intro" style="margin-bottom:50px"></div>
       
    
    <h3>Usuário logado: <?php echo $secretaria->getNome() ?></h3>
   
    <div class="clear"></div>
    <div class="line"></div>

    <div style="margin-bottom: 50px">
        
        <table style="width:100%">
                    <tr>
                      <th>Nome Aluno</th>
                      <th>Descrição Opinião</th>
                      <th>DataPostagem</th>
                    </tr>
                    
                    <?php foreach ($listaOpinioes as $opiniao){ ?>
                    <tr> 
                        <td><?php echo $opiniao->getAluno()->getNome() ?></td> 
                        <td><?php echo $opiniao->getDescricao() ?></td> 
                        <td><?php echo $opiniao->getDataPostagem() ?></td>  
                    </tr>
                  
                    <?php } ?>
                    
        </table>
    </div>

    
    <?php include('componentes/footerOne.php') ?>
