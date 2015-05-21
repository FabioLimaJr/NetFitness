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
    $listaDietas = $fachada->listarDietas($_SESSION['Nutricionista']);
    
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
  
?>

<h1 class="title">Excluir Dieta</h1>
    <div class="line"></div>
    Telefone:<?php echo $nutricionista->getTelefone() ?> | Email:<?php echo $nutricionista->getEmail() ?> | Endereço:<?php echo $nutricionista->getEndereco() ?>
    <div class="intro" style="margin-bottom:50px"></div>
    
    
    
    <h3>Usuário logado: <?php echo $nutricionista->getNome() ?></h3>
   
    <div class="clear"></div>
    <div class="line"></div>

    <?php if(!$camposPreenchidos) 
    { ?>
    <div style="margin-bottom: 50px">
        
 
        <div class="form-container" style="margin-bottom:50px">
         
        <form class="forms" action="excluirDieta.php" method="post" >
         <fieldset>
            <ol>


             <li class="form-row text-input-row">
               <label>Dietas</label>
               <table style="width:100%">
                    <tr>
                      <th>Nome Aluno</th> 
                      <th>Descrição Dieta</th>
                      <th>Selecionar</th>
                    </tr>
                    
                    <?php foreach ($listaDietas as $dieta){ ?>
                    <tr>
                        <td><?php echo $dieta->getAluno()->getNome() ?></td> 
                        <td><?php echo $dieta->getDescricao() ?></td>  
                        <td><input type="radio" name="idDieta" value="<?php echo $dieta->getIdDieta() ?>"></td>  
                    </tr>
                    <input type="hidden" name="nomeAluno<?php echo $dieta->getIdDieta() ?>" value="<?php echo $dieta->getAluno()->getNome() ?>">
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
            $dieta = new Dieta($_POST['idDieta']);
            $fachada->excluirDieta($dieta);
            $mensagem = "A dieta do aluno ".$_POST['nomeAluno'.$dieta->getIdDieta()]." foi excluida com sucesso.";
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