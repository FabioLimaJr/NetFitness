<?php 

//$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";
$listaAlunos = array();

try
{
    $listaAlunos = $fachada->listarAlunos(LAZY);
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
    
?>

<h1 class="title">Lista de Alunos</h1>
<div class="line"></div>
    
Telefone:<?php echo $secretaria->getTelefone() ?> | Email:<?php echo $secretaria->getEmail() ?> | Endereço:<?php echo $secretaria->getEndereco() ?>

<div class="intro" style="margin-bottom:50px"></div>
    
    
    
<h3>Usuário logado: <?php echo $secretaria->getNome() ?></h3>
   
   
<div class="clear"></div>
<div class="line"></div>

<div style="margin-bottom: 50px">
        
        <table style="width:100%">
                    <tr>
                      <th>Nome</th> 
                      <th>Email</th>
                      <th>Telefone</>
                      
                    </tr>
                    
                    <?php foreach ($listaAlunos as $aluno){ ?>
                    <tr>
                        <td><?php echo $aluno->getNome() ?></td> 
                        <td><?php echo $aluno->getEmail() ?></td>  
                        <td><?php echo $aluno->getTelefone() ?> </td>
                    </tr>
                  
                    <?php } ?>
                    
        </table>
    </div>

    
    <?php include('componentes/footerOne.php') ?>

