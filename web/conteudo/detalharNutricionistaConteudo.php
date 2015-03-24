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
    $listaNutricionistas = $fachada->listarNutricionistas();
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
    
?>

<h1 class="title">Detalhar Nutricionista</h1>
  <div class="line"></div>
    
        Telefone:<?php //echo $coordenador->getTelefone() ?> | Email:<?php //echo $coordenador->getEmail() ?> | Endereço:<?php //echo $coordenador->getEndereco() ?>

    <div class="intro" style="margin-bottom:50px"></div>
    
    
    
    <h3>Usuário logado: <?php //echo $coordenador->getNome() ?></h3>
   
   
    <div class="clear"></div>
    <div class="line"></div>
    
    <?php if(!$camposPreenchidos) {?>
    
    <div class="form-container" style="margin-bottom:50px">
      <form class="forms" action="detalharNutricionista.php" method="post" >
      <fieldset>
      
       <ol>
            <li class="form-row text-input-row">     
               <table style="width:100%;margin-bottom:50px">
                         <tr>
                           <th>Nome Nutricionista</th> 
                           <th>CRN</th>
                           <th>Telefone</th>
                           <th>Email</th>
                           <th>Selecionar</th>
                         </tr>

                         <?php foreach ($listaNutricionistas as $nutricionista){ ?>
                         <tr>
                             <td><?php echo $nutricionista->getNome() ?></td> 
                             <td><?php echo $nutricionista->getCrn() ?></td>
                             <td><?php echo $nutricionista->getTelefone() ?></td>
                             <td><?php echo $nutricionista->getEmail() ?></td>
                             <td><input type="radio" name="idNutricionista" value="<?php echo $nutricionista->getIdNutricionista() ?>"></td>
                         </tr>

                         <?php 
                         
                    
                         } ?>

               </table>
             </li>

             <li class="form-row text-input-row" style="text-align:center;margin-left:-100px">
                    <input type="submit" value="Detalhar" name="submit" class="btn-submit">

             </li>       
        </ol>  
       </fieldset>
       </form>
    </div>
    <?php }
    else
    {
        if(count($_POST)>1)
        {
            //Detalhar
            try
            {
                $nutricionista = new Nutricionista($_POST['idNutricionista']);
                $nutricionistaRetornada = $fachada->detalharNutricionista($nutricionista);
               // var_dump($dietaRetornada);
                ?>
                     <div style="margin-bottom: 50px">
        
                        <table style="width:100%">
                                    <tr>
                                        <td>Nome da Nutricionista</td>
                                        <td>CNR</td>
                                        <td>Telefone</td>
                                        <td>Email</td>
                                      
                                    </tr>
                                   
                                     <?php foreach ($listaNutricionistas as $nutricionistaRetornada){ ?>
                         <tr>
                             <td><?php echo $nutricionistaRetornada->getNome() ?></td> 
                             <td><?php echo $nutricionistaRetornada->getCrn() ?></td>
                             <td><?php echo $nutricionistaRetornada->getTelefone() ?></td>
                             <td><?php echo $nutricionistaRetornada->getEmail() ?></td>
                         </tr>

                         <?php 
                         
                    
                         } ?>

                        </table>
                    </div>
                <?php
                
            } 
            catch (Exception $exc) 
            {
               $mensagem = $exc->getMessage();
               ?> <h3>Mensagem</h3>
              <p><?php echo $mensagem ?></p> <?php
            }
        }
        else 
        {
            $mensagem = "Não foi selecionada a dieta";
            ?> <h3>Mensagem</h3>
             <p><?php echo $mensagem ?></p> <?php
        }
       
    }
     
    
    include('componentes/footerOne.php') ?>