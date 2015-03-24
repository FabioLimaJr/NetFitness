<?php 

$camposPreenchidos = false;
$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";
 
  
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $camposPreenchidos = true;
}

try
{
    $listaNutricionistas = $fachada->listarNutricionistas($_SESSION['Nutricionista']);
    
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
  
?>

<h1 class="title">Excluir Nutricionista</h1>
    <div class="line"></div>
    Telefone:<?php //echo $coordenador->getTelefone() ?> | Email:<?php// echo $coordenador->getEmail() ?> | Endereço:<?php //echo $coordenador->getEndereco() ?>
    <div class="intro" style="margin-bottom:50px"></div>
    
    <h3>Usuário logado: <?php// echo $coordenador->getNome() ?></h3>
   
    <div class="clear"></div>
    <div class="line"></div>

    <?php if(!$camposPreenchidos) 
    { ?>
    <div style="margin-bottom: 50px">
        
 
        <div class="form-container" style="margin-bottom:50px">
         
            <form class="forms" action="excluirNutricionista.php" method="post" >
         <fieldset>
            <ol>


             <li class="form-row text-input-row">
               <label>Nutricionistas</label>
               <table style="width:100%">
                    <tr>
                      <th>Nome da Nutricionista</th> 
                      <th>CRN</th>
                      <th>Selecionar</th>
                    </tr>
                    
                    <?php foreach ($listaNutricionistas as $nutricionista){ ?>
                    <tr>
                        <td><?php echo $nutricionista->getNome() ?></td> 
                        <td><?php echo $nutricionista->getCrn() ?></td>  
                        <td><input type="radio" name="idNutricionista" value="<?php echo $nutricionista->getIdNutricionista() ?>"></td>  
                    </tr>
                    <input type="hidden" name="nomeNutricionista<?php echo $nutricionista->getIdNutricionista() ?>" value="<?php echo $nutricionista->getNome() ?>">
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
    }   
        else            
    { 
        try
        {
            $nutricionista = new Nutricionista($_POST['idNutricionista']);
            $fachada->excluirNutricionista($nutricionista);
            $mensagem = "A Nutricionista ".$_POST['nomeNutricionista'.$nutricionista->getIdNutricionista()]." foi excluida com sucesso.";
        } 
        catch (Exception $exc)
        {
            $mensagem = $exc->getMessage();
        }
        
            
        ?>
    
        <h3>Mensagem</h3>
        <p><?php echo $mensagem ?></p>
    
    <?php     
    } 
    
    include('componentes/footerOne.php') ?>