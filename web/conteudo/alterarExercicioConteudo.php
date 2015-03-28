<?php

$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";
$camposPreenchidos = false;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $camposPreenchidos = true;
}

try
{
    $listaExercicios = $fachada->listarExercicios($_SESSION['Instrutor']);

} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}
?>

<h1 class="title">Alterar Exercicio</h1>
<div class="line"></div>
Telefone:<?php echo $instrutor->getTelefone() ?> | Email:<?php echo $instrutor->getEmail() ?> | Endereço:<?php echo $instrutor->getEndereco() ?>
<div class="intro" style="margin-bottom:50px"></div>

<h3>Usuário logado: <?php echo $instrutor->getNome() ?></h3>
<div class="clear"></div>
<div class="line"></div>

<?php 
     if(!$camposPreenchidos){ 
?>
<div class="form-container" style="margin-bottom:50px">
    <form class="forms" action="alterarExercicio.php" method="post" >
        <fieldset>
      
            <ol>
                <li class="form-row text-input-row">     
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
                            <td><input type="radio" name="idExercicio" value="<?php echo $exercicio->getIdExercicio() ?>"></td>
                        </tr>
                        <?php 
                            } 
                        ?>

                    </table>
                  </li>

                  <li class="form-row text-input-row" style="text-align:center;margin-left:-100px">
                         <input type="submit" value="Alterar" name="submit" class="btn-submit">
                         <input type="hidden" name="">
                  </li>       
            </ol>  
        </fieldset>
    </form>
</div>

<?php 
     }else{
         
     }
?>