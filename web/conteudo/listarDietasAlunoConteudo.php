<?php 

//$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";

try
{
    $listaDietas = $fachada->listarDietas($_SESSION['Aluno'], EAGER);
    //var_dump($listaDietas);
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
    
    
   
 
    
?>

<h1 class="title">Listar Dietas</h1>
    <div class="line"></div>
    Telefone:<?php echo $aluno->getTelefone() ?> | Email:<?php echo $aluno->getEmail() ?> | Endereço:<?php echo $aluno->getEndereco() ?>
    <div style="float:right"><image height = "80" src="<?php echo IMAGE_PATH_ALUNOS."/".$aluno->getFoto() ?>"> </div>
    <div class="intro" style="margin-bottom:50px"></div>
    
    
    
    <h3>Usuário logado: <?php echo $aluno->getNome() ?></h3>
   
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
                        <td><?php 
                                 $sizeListaAlimentos = count($dieta->getListaAlimentos());
                                 $count = 1;
                                 foreach ($dieta->getListaAlimentos() as $alimento)
                                 {
                                     if($count == $sizeListaAlimentos)
                                     {
                                       echo $alimento->getDescricao();
                                     }
                                     else
                                     {
                                       echo $alimento->getDescricao().", ";  
                                     }
                                     
                                     $count++;
                                 }
                             ?></td>  
                    </tr>
                  
                    <?php } ?>
                    
        </table>
    </div>

    
    <?php include('componentes/footerOne.php') ?>