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
    $listaInstrutores = $fachada->listarInstrutores(LAZY);
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
    
?>

<h1 class="title">Detalhar Instrutor</h1>
  <div class="line"></div>
    
        Telefone:<?php echo $coordenador->getTelefone() ?> | Email:<?php echo $coordenador->getEmail() ?> | Endereço:<?php echo $coordenador->getEndereco() ?>

    <div class="intro" style="margin-bottom:50px"></div>
    
    
    
    <h3>Usuário logado: <?php echo $coordenador->getNome() ?></h3>
   
   
    <div class="clear"></div>
    <div class="line"></div>
    
    <?php if(!$camposPreenchidos) {?>
    
    <div class="form-container" style="margin-bottom:50px">
      <form class="forms" action="detalharInstrutor.php" method="post" >
      <fieldset>
      
       <ol>
            <li class="form-row text-input-row">     
               <table style="width:100%;margin-bottom:50px">
                         <tr>
                           <th>Nome Instrutor</th> 
                           <th>CPF</th>
                           <th>Selecionar</th>
                         </tr>

                         <?php foreach ($listaInstrutores as $instrutor){ ?>
                         <tr>
                             <td><?php echo $instrutor->getNome() ?></td> 
                             <td><?php echo $instrutor->getCpf() ?></td>
                             <td><input type="radio" name="idInstrutor" value="<?php echo $instrutor->getIdInstrutor() ?>"></td>
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
                    
                    $instrutor = new Instrutor($_POST['idInstrutor']);
                    $instrutorRetornado = $fachada->detalharInstrutor($instrutor, LAZY);
                    
                    ?>
                    
                    <div style="margin-bottom: 50px">
        
                        <table style="width:100%">
                                    <tr>
                                        <td>Nome do Instrutor</td>
                                        <td>CPF</td>
                                        <td>Endereço</td>
                                        <td>Telefone</td>
                                        <td>Login</td>
                                        <td>Email</td>
                                    </tr>
                                  
                                    <tr>
                                        <td><?php echo $instrutorRetornado->getNome() ?></td> 
                                        <td><?php echo $instrutorRetornado->getCpf() ?></td>
                                        <td><?php echo $instrutorRetornado->getEndereco() ?></td>
                                        <td><?php echo $instrutorRetornado->getTelefone() ?></td>
                                        <td><?php echo $instrutorRetornado->getLogin() ?></td>
                                        <td><?php echo $instrutorRetornado->getEmail() ?></td>
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
                
                $mensagem = "Não foi selecionada o instrutor";
                ?> <h3>Mensagem</h3>
                <p><?php echo $mensagem ?></p> <?php
            }
        }
        
        include('componentes/footerOne.php') ?>

