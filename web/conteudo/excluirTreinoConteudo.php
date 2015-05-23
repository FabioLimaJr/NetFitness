<?php 

$camposPreenchidos = false;
//$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";
 
  
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $camposPreenchidos = true;
}

try
{
    $listaTreinos = $fachada->listarTreinos($_SESSION['Instrutor'], EAGER);
    
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
  
?>

<h1 class="title">Excluir Treino</h1>
<div class="line"></div>
Telefone:<?php echo $instrutor->getTelefone() ?> | Email:<?php echo $instrutor->getEmail() ?> | Endereço:<?php echo $instrutor->getEndereco() ?>
<div class="intro" style="margin-bottom:50px"></div>
   
<h3>Usuário logado: <?php echo $instrutor->getNome() ?></h3>
   
<div class="clear"></div>
<div class="line"></div>

<?php if(!$camposPreenchidos) 
    { ?>

    <div style="margin-bottom: 50px">
        
 
        <div class="form-container" style="margin-bottom:50px">
         
        <form class="forms" action="excluirTreino.php" method="post" >
         <fieldset>
            <ol>


             <li class="form-row text-input-row">
               <label>Treinos</label>
               <table style="width:100%">
                    <tr>
                      <th>Nome</th> 
                      <th>Descrição</th>
                      <th>Selecionar</th>
                    </tr>
                    
                    <?php foreach ($listaTreinos as $treino){ ?>
                    <tr>
                        <td><?php echo $treino->getNome() ?></td> 
                        <td><?php echo $treino->getDescricao() ?></td>  
                        <td><input type="radio" name="idTreino" value="<?php echo $treino->getIdTreino() ?>"></td>  
                    </tr>
                    <?php } ?>
                    
                </table>
             </li>

              <li class="button-row" style="margin-top:50px;margin-left: -100px;text-align: center">
               <input type="submit" value="Excluir" name="submit" class="btn-submit">
             </li>
             
            </ol>

         </fieldset>
       </form>
    </div>
</div>

    <?php 
         
        }else{
            
            try{
            
                $treino = new Treino();
                $treino->setIdTreino($_POST['idTreino']);
                $fachada->excluirTreino($treino);
                $mensagem = "O treino foi excluido com sucesso!!";
            } 
            catch (Exception $exc){
                $mensagem = $exc->getMessage();
            }
    
    ?>

    <h3>Mensagem</h3>
    <p><?php echo $mensagem ?></p>
    
    <?php     
    } 
    
    include('componentes/footerOne.php') ?>

