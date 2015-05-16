<?php 

$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";

try
{
   $listaInstrutores = $fachada->listarInstrutores(EAGER);
   $listaNutricionistas = $fachada->listarNutricionistas(EAGER);
   $listaDicas = array();
   
   foreach ($listaInstrutores as $instrutor)
   {
      $listaDicas = array_merge($listaDicas, $instrutor->getListaDicas());  
   }
   
   foreach ($listaNutricionistas as $nutricionista)
   {
       $listaDicas = array_merge($listaDicas, $nutricionista->getListaDicas());
   }
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
       
?>

<h1 class="title">Visualizar Dicas</h1>
    <div class="line"></div>
    Telefone:<?php echo $pessoa->getTelefone() ?> | Email:<?php echo $pessoa->getEmail() ?> | Endereço:<?php echo $pessoa->getEndereco() ?>
    <div class="intro" style="margin-bottom:50px"></div>
    
    
    
    <h3>Usuário logado: <?php echo $pessoa->getNome() ?></h3>
   
    <div class="clear"></div>
    <div class="line"></div>

    <div style="margin-bottom: 50px">
        
        <table style="width:100%">
                    <tr>
                      <th>Titulo</th> 
                      <th>Descrição</th>
                    </tr>
                    
                    <?php foreach ($listaDicas as $dica){ ?>
                    <tr>                        
                        <td><?php echo $dica->getTitulo() ?></td>  
                        <td><?php echo $dica->getDescricao() ?></td>  
                    </tr>
                  
                    <?php } ?>
                    
        </table>
    </div>

    
    <?php include('componentes/footerOne.php') ?>