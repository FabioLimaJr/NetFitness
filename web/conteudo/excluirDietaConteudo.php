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
    $listaDietas = $fachada->listarDietas($_SESSION['Nutricionista'], EAGER);
    if(sizeof($listaDietas)==0)
    {
        $mensagem = "Nenhum aluno recebeu a prescrição da dieta.";
    }
    
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
        
 
        <div class="form-container" style="margin-bottom:50px"><br/>
         Dietas
         <form class="forms" action="excluirDieta.php" method="post" style="margin-top:20px" >
         <fieldset>
            <ol>


             <li class="form-row text-input-row">
               
               <table style="width:100%;margin-bottom:50px">
                         <tr>
                           <th>Nome Aluno</th> 
                           <th>Descrição Dieta</th>
                           <th>Alimentos</th>
                           <th>Qtd</th>
                           <th>Selecionar</th>
                         </tr>

                         <?php 
                         
                         
                         foreach ($listaDietas as $dieta)
                         { 
                           $numAlimentos = sizeof($dieta->getListaAlimentos());
                           $nomeAluno = $dieta->getAluno()->getNome();
                           $descDieta = $dieta->getDescricao();
                           $idDieta = $dieta->getIdDieta();
                           $first = true;
                           
                           foreach ($dieta->getListaAlimentos() as $alimento)
                           {
                         ?>
                         
                         
                         <tr>
                             <?php if($first){ ?><td rowspan="<?php echo $numAlimentos ?>"><?php echo $nomeAluno ?></td> 
                             <td rowspan="<?php echo $numAlimentos ?>"><?php echo $descDieta ?></td><?php } ?>
                             <td><?php echo $alimento->getDescricao() ?></td>
                             <td><?php echo $alimento->getQtdAlimento() ?> </td>
                             <?php if($first){ ?><td rowspan="<?php echo $numAlimentos ?>"><input type="radio" name="idDieta" value="<?php echo $idDieta ?>"></td><?php $first=false; } ?>
                             
                         </tr>
                           <?php }  ?>           
                           
                        <?php } ?>
                
               </table>
               
             </li>
             <?php if(sizeof($listaDietas)!=0) { ?> 
             <li class="button-row" style="margin-top:50px;margin-left: -100px;text-align: center">
               <input type="submit" value="Excluir" name="submit" class="btn-submit">
             </li>
             <?php } ?>
             
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
            $alunoSelecionado = $fachada->detalharDieta($dieta,EAGER)->getAluno();
            $fachada->excluirDieta($dieta);
            $mensagem = "A dieta do aluno ".$alunoSelecionado->getNome()." foi excluida com sucesso.";
        } 
        catch (Exception $exc)
        {
            $mensagem = $exc->getMessage();
        }
        
            
             
    } 
    
    if($mensagem != "") { ?>
        <h3>Mensagem</h3>
        <p><?php echo $mensagem ?></p>
    <?php }
    
    include('componentes/footerOne.php') ?>