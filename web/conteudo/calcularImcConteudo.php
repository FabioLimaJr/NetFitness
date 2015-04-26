<?php
 $camposPreenchidos = false;
 $fachada = Fachada::getInstance();
 $mensagem = "";
 
  
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
     $camposPreenchidos = true;
 }
?>

<h1 class="title">Página usuário</h1>
    <div class="line"></div>
    
    Nome: <?php echo $aluno->getNome() ?> | Telefone:<?php echo $aluno->getTelefone() ?> | Email:<?php echo $aluno->getEmail() ?> | Endereço:<?php echo $aluno->getEndereco() ?>
    
    <div class="intro" style="margin-bottom:50px">
         
    </div>
    
    
    
    <h3>Calcular IMC</h3>
   
    <div class="clear"></div>
    <div class="line"></div>
    
<?php 
   
    if(!$camposPreenchidos)
    {   
        ?> 
         <div class="form-container" style="margin-bottom:50px">
             <form class="forms" action="calcularImc.php" method="post" >
         <fieldset>
           <ol>

             <li class="form-row text-input-row">
                    <label>Peso</label>
                    <input type="text" name="peso" value="" class="text-input" style="width: 70px">
             </li>
             
             <li class="form-row text-input-row">
                    <label>Altura</label>
                    <input type="text" name="altura" value="" class="text-input" style="width: 70px">
             </li>
             <li class="button-row" style="margin-top:50px">
               <input type="submit" value="Calcular" name="submit" class="btn-submit">
             </li>
           </ol>

         </fieldset>
       </form>
       <div class="response"></div>
     </div>
        <?php 
    } 
    else
    {

        $aluno = new Aluno();
        
        $mensagem = $aluno->calcularIMC($_POST['peso'], $_POST['altura']);
    }
   ?> 
    
    <h3>Mensagem</h3>
    <p><?php echo $mensagem ?></p>

    
    
    <?php include('componentes/footerOne.php') ?>

