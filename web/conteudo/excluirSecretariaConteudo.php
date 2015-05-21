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
    $listaSecretarias = $fachada->listarSecretarias(LAZY);
    
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
  
?>

<h1 class="title">Excluir Secretaria</h1>
<div class="line"></div>
Telefone:<?php echo $coordenador->getTelefone() ?> | Email:<?php echo $coordenador->getEmail() ?> | Endereço:<?php echo $coordenador->getEndereco() ?>
<div class="intro" style="margin-bottom:50px"></div>
    
<h3>Usuário logado: <?php echo $coordenador->getNome() ?></h3>
   
<div class="clear"></div>
<div class="line"></div>

<?php if(!$camposPreenchidos) 
    { ?>
    <div style="margin-bottom: 50px">
        
 
        <div class="form-container" style="margin-bottom:50px">
         
            <form class="forms" action="excluirSecretaria.php" method="post" >
         <fieldset>
            <ol>


             <li class="form-row text-input-row">
               <label>Secretarias</label>
               <table style="width:100%">
                    <tr>
                      <th>Nome da Secretaria</th> 
                      <th>CPF</th>
                      <th>Selecionar</th>
                    </tr>
                    
                    <?php foreach ($listaSecretarias as $secretaria){ ?>
                    <tr>
                        <td><?php echo $secretaria->getNome() ?></td> 
                        <td><?php echo $secretaria->getCpf() ?></td>  
                        <td><input type="radio" name="idSecretaria" value="<?php echo $secretaria->getIdSecretaria() ?>"></td>  
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
        
    <?php
    
    }else{
        
        try{
            
            $secretaria = new Secretaria($_POST['idSecretaria']);
            $fachada->excluirSecretaria($secretaria);
            $mensagem = "A Secretaria foi excluida com sucesso!!";
            
        } catch (Exception $ex) {

            $mensagem = $ex->getMessage();
            
        }
        
        ?>
        
        <h3>Mensagem</h3>
        <p><?php echo $mensagem ?></p>
    
    <?php     
    } 
    
    include('componentes/footerOne.php') ?>

