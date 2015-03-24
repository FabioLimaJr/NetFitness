<?php 

$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";
$listaNutricionistas = array();

try
{
    $listaNutricionistas = $fachada->listarNutricionistas();
   // var_dump($listaNutricionistas);
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
    
?>

<h1 class="title">Listar Nutricionistas</h1>
    <div class="line"></div>
    
        Telefone:<?php echo $coordenador->getTelefone() ?> | Email:<?php echo $coordenador->getEmail() ?> | Endereço:<?php echo $coordenador->getEndereco() ?>

    <div class="intro" style="margin-bottom:50px"></div>
    
    
    
    <h3>Usuário logado: <?php //echo $coordenador->getNome() ?></h3>
   
   
    <div class="clear"></div>
    <div class="line"></div>

    <div style="margin-bottom: 50px">
        
        <table style="width:100%">
                    <tr>
                      <th>Nome da Nutricionista</th> 
                      <th>CRN</th>
                      <th>Email</th>
                      <th>Telefone</>
                      
                    </tr>
                    
                    <?php foreach ($listaNutricionistas as $nutricionista){ ?>
                    <tr>
                        <td><?php echo $nutricionista->getNome() ?></td> 
                        <td><?php echo $nutricionista->getCrn() ?></td>  
                        <td><?php echo $nutricionista->getEmail() ?></td>  
                        <td><?php echo $nutricionista->getTelefone() ?> </td>
                    </tr>
                  
                    <?php } ?>
                    
        </table>
    </div>

    
    <?php include('componentes/footerOne.php') ?>