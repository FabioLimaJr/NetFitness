<?php 

$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";

try
{
    $listaDietas = $fachada->listarDietas();
    //var_dump($listaDietas);
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
    
    
   
 
    
?>

<h1 class="title">Listar Dietas</h1>
    <div class="line"></div>
    Telefone:<?php echo $nutricionista->getTelefone() ?> | Email:<?php echo $nutricionista->getEmail() ?> | Endereço:<?php echo $nutricionista->getEndereco() ?>
    <div class="intro" style="margin-bottom:50px"></div>
    
    
    
    <h3>Usuário logado: <?php echo $nutricionista->getNome() ?></h3>
   
    <div class="clear"></div>
    <div class="line"></div>

    <div style="margin-bottom: 50px">
        
        <table style="width:100%">
                    <tr>
                      <th>Nome Aluno</th> 
                      <th>Descrição Dieta</th>
                      <th>Alimentos</th>
                    </tr>
                    
                    <?php foreach ($listaDietas as $dieta){ ?>
                    <tr>
                        <td><?php echo $dieta->getAluno()->getNome() ?></td> 
                        <td><?php echo $dieta->getDescricao() ?></td>  
                        <td>Falta lista Alimentos</td>  
                    </tr>
                  
                    <?php } ?>
                    
        </table>
    </div>

    
    <?php include('componentes/footerOne.php') ?>