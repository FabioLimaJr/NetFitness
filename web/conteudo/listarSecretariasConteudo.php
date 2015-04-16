<?php 

$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";
$listaSecretarias = array();

try
{
    $listaSecretarias = $fachada->listarSecretarias(LAZY);
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
    
?>

<h1 class="title">Listar Secretarias</h1>
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
                    
                    <?php foreach ($listaSecretarias as $secretaria){ ?>
                    <tr>
                        <td><?php echo $secretaria->getNome() ?></td> 
                        <td><?php echo $secretaria->getEmail() ?></td>  
                        <td><?php echo $secretaria->getTelefone() ?> </td>
                    </tr>
                  
                    <?php } ?>
                    
        </table>
    </div>

    
    <?php include('componentes/footerOne.php') ?>
