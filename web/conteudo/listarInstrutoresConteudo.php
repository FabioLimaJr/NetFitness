<?php 

$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";
$listaInstrutores = array();

try
{
    $listaInstrutores = $fachada->listarInstrutores(LAZY);
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
    
?>

<h1 class="title">Lista de Instrutores</h1>
<div class="line"></div>
    
Telefone:<?php echo $coordenador->getTelefone() ?> | Email:<?php echo $coordenador->getEmail() ?> | Endereço:<?php echo $coordenador->getEndereco() ?>

<div class="intro" style="margin-bottom:50px"></div>
    
    
    
<h3>Usuário logado: <?php echo $coordenador->getNome() ?></h3>
   
   
<div class="clear"></div>
<div class="line"></div>

<div style="margin-bottom: 50px">
        
        <table style="width:100%">
                    <tr>
                      <th>Nome</th> 
                      <th>Email</th>
                      <th>Telefone</>
                      
                    </tr>
                    
                    <?php foreach ($listaInstrutores as $instrutor){ ?>
                    <tr>
                        <td><?php echo $instrutor->getNome() ?></td> 
                        <td><?php echo $instrutor->getEmail() ?></td>  
                        <td><?php echo $instrutor->getTelefone() ?> </td>
                    </tr>
                  
                    <?php } ?>
                    
        </table>
    </div>

    
    <?php include('componentes/footerOne.php') ?>

