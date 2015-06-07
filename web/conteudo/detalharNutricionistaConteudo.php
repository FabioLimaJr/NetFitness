<?php 

//$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";
$camposPreenchidos = false;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $camposPreenchidos = true;
}

try
{
    $listaNutricionistas = $fachada->listarNutricionistas(LAZY);
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
    
?>

<h1 class="title">Detalhar Nutricionista</h1>
  <div class="line"></div>
    
        Telefone:<?php echo $coordenador->getTelefone() ?> | Email:<?php echo $coordenador->getEmail() ?> | Endereço:<?php echo $coordenador->getEndereco() ?>

    <div class="intro" style="margin-bottom:50px"></div>
    
    
    
    <h3>Usuário logado: <?php echo $coordenador->getNome() ?></h3>
   
   
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
                           <th>CPF</th>
                           <th>CRN</th>
                           <th>Selecionar</th>
                         </tr>

                         <?php foreach ($listaNutricionistas as $nutricionista){ ?>
                         <tr>
                             <td><?php echo $nutricionista->getNome() ?></td> 
                             <td><?php echo $nutricionista->getCpf() ?></td>
                              <td><?php echo $nutricionista->getCrn() ?></td>
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
    <?php 
           
        }else{
            
            if(count($_POST)>1){
                
                try{
                    
                    $nutricionista = new Nutricionista($_POST['idNutricionista']);
                   $nutricionistaRetornado = $fachada->detalharNutricionista($nutricionista, LAZY);
                    
                    ?>
                    
                    <div style="margin-bottom: 50px">
        
                        <table style="width:100%">
                                    <tr>
                                        <td>Nome da Nutricionista</td>
                                        <td>CPF</td>
                                        <td>CRN</td>
                                        <td>Endereço</td>
                                        <td>Telefone</td>
                                        <td>Login</td>
                                        <td>Email</td>
                                    </tr>
                                  
                                    <tr>
                                        <td><?php echo $nutricionistaRetornado->getNome() ?></td> 
                                        <td><?php echo $nutricionistaRetornado->getCpf() ?></td>
                                        <td><?php echo $nutricionistaRetornado->getCrn() ?></td>
                                        <td><?php echo $nutricionistaRetornado->getEndereco() ?></td>
                                        <td><?php echo $nutricionistaRetornado->getTelefone() ?></td>
                                        <td><?php echo $nutricionistaRetornado->getLogin() ?></td>
                                        <td><?php echo $nutricionistaRetornado->getEmail() ?></td>
                                    </tr>

                        </table>
                    </div>
                <?php
                
                } catch (Exception $ex) {

                    $mensagem = $ex->getMessage();
                    ?> <h3>Mensagem</h3>
                    <p><?php echo $mensagem ?></p> <?php
              
                }
                
            }else{
                
                $mensagem = "Não foi selecionada o nutricionista";
                ?> <h3>Mensagem</h3>
                <p><?php echo $mensagem ?></p> <?php
            }
        }
        
        include('componentes/footerOne.php') ?>

