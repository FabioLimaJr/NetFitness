<?php 

$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";

try
{
   $pessoa="";
    if($_SESSION['tipoUsuario'] == "Nutricionista")
    {
         $pessoa = $_SESSION['Nutricionista'];
         $listaDicas = $fachada->listarDicas($_SESSION['Nutricionista']);
         $_SESSION['listaDicas'] = $listaDicas;   
    }
    else if(($_SESSION['tipoUsuario'] == "Instrutor"))
    {
         $pessoa = $_SESSION['Instrutor'];
         $listaDicas = $fachada->listarDicas($_SESSION['Instrutor']);
         $_SESSION['listaDicas'] = $listaDicas;
    }
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
       
?>

<h1 class="title">Listar Dicas</h1>
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