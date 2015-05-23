<?php 

//$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";

try
{
    $detalharAluno = $fachada->detalharAluno($_SESSION['Aluno'], EAGER);
    
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
    
?>

<h1 class="title">Listar Treinos</h1>
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
                      <th>Nome</th> 
                      <th>Descrição</th>
                      <th>Exercicios</th>
                    </tr>
                    
                    <?php foreach ($detalharAluno->getListaTreinos() as $treino){ ?>
                    <tr>
                        <?php $detalharTreino = $fachada->detalharTreino($treino, EAGER); ?>
                        
                        <td><?php echo $detalharTreino->getNome() ?></td> 
                        <td><?php echo $detalharTreino->getDescricao() ?></td>  
                         <td><?php 
                                 
                                 $sizeListaExercicios = count($detalharTreino->getListaExercicios());
                                 $count = 1;
                                 foreach ($detalharTreino->getListaExercicios() as $exercicio)
                                 {
                                     if($count == $sizeListaExercicios)
                                     {
                                       echo $exercicio->getNome();
                                     }
                                     else
                                     {
                                       echo $exercicio->getNome().", ";  
                                     }
                                     
                                     $count++;
                                 }
                             ?></td> 
                    </tr>
                  
                    <?php } ?>
                    
        </table>
</div>
<h3>Mensagem</h3>
<p><?php echo $mensagem ?></p>
<?php include('componentes/footerOne.php') ?>

