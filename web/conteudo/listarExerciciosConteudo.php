<?php

//$fachada = new Fachada();
$fachada = Fachada::getInstance();
//$mensagem ="";
//$camposPreenchidos = false;

/*if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $camposPreenchidos = true;
}*/

try
{
    $listaExercicios = $fachada->listarExercicios();

} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}
?>

<h1 class="title">Lista de Exercícios</h1>
<div class="line"></div>
Telefone:<?php echo $instrutor->getTelefone() ?> | Email:<?php echo $instrutor->getEmail() ?> | Endereço:<?php echo $instrutor->getEndereco() ?>
<div class="intro" style="margin-bottom:50px"></div>

<h3>Usuário logado: <?php echo $instrutor->getNome() ?></h3>
<div class="clear"></div>
<div class="line"></div>


<div style="margin-bottom: 50px">
    
    <table style="width:100%;margin-bottom:50px">
                        <tr>
                            <th>Nome Exercicio</th> 
                            <th>Músculo</th>
                            <th>Descrição</th>
                        </tr>
                        
                        <?php foreach ($listaExercicios as $exercicio){ ?>
                        
                        <tr>
                            <td><?php echo $exercicio->getNome() ?></td> 
                            <td><?php echo $exercicio->getMusculo() ?></td>  
                            <td><?php echo $exercicio->getDescricao() ?></td>  
                        </tr>
                        <?php 
                            } 
                        ?>

    </table>
        
</div>

<?php include('componentes/footerOne.php') ?>

