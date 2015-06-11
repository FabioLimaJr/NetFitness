<?php 

//$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";
$camposPreenchidos = false;
$error = false;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $camposPreenchidos = true;
}

try
{
   $listaDietas = $fachada->listarDietas($_SESSION['Aluno'], EAGER);
   if(sizeof($listaDietas)==0)
   {
        $mensagem = "O aluno ainda não recebeu a prescrição da dieta.";
   }
} 
catch (Exception $exc)
{
   $mensagem = $exc->getMessage();
   $error = true;
}   
    
    
   
 
    
?>

<h1 class="title">Visualizar Dieta</h1>
    <div class="line"></div>
    Telefone:<?php echo $aluno->getTelefone() ?> | Email:<?php echo $aluno->getEmail() ?> | Endereço:<?php echo $aluno->getEndereco() ?>
    <div style="float:right"><image height = "80" src="<?php echo IMAGE_PATH_ALUNOS."/".$aluno->getFoto() ?>"> </div>
    <div class="intro" style="margin-bottom:50px"></div>
    
   
    
    <h3>Usuário logado: <?php echo $aluno->getNome() ?></h3>
   
    <div class="clear"></div>
    <div class="line"></div>

    <div style="margin-bottom: 50px">
        
      <?php if(!$camposPreenchidos) {?>
        <form class="forms" action="listarDietasAluno.php" method="post" >
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
                         
                         $idDieta = "";
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
                           <?php }                   
                    
                         } ?>

               </table>
                
             </li>
              <?php if(sizeof($listaDietas)!=0) { ?>
             <li class="form-row text-input-row" style="text-align:center;margin-left:-100px">
                    <input type="submit" value="Detalhar" name="submit" class="btn-submit">

             </li>       
              <?php } ?>
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
                $dieta = new Dieta($_POST['idDieta']);
                $dietaRetornada = $fachada->detalharDieta($dieta, EAGER);
                $gorduraTotal = 0;
                $proteinaTotal = 0;
                $carboidratoTotal = 0;
                $caloriaTotal = 0;
                
                foreach ($dietaRetornada->getListaAlimentos() as $alimento)
                {
                    $gorduraTotal += $alimento->getGordura()/100*$alimento->getQtdAlimento();
                    $proteinaTotal += $alimento->getProteina()/100*$alimento->getQtdAlimento();
                    $carboidratoTotal += $alimento->getCarboidrato()/100*$alimento->getQtdAlimento();
                    $caloriaTotal += $alimento->getCaloria()/100*$alimento->getQtdAlimento(); 
                }
                
                ?>
                     <div style="margin-bottom: 50px">
        
                        <table style="width:100%">
                                    <tr>
                                        <td>Nome Aluno</td>
                                        <td>Descrição Dieta</td>
                                        <td>Alimentos</td>
                                        <td>Cal. (gx100)</td>
                                        <td>Prot.(gx100)</td>
                                        <td>Carb.(gx100)</td>
                                        <td>Gord.(gx100)</td>
                                        <td>Qtd.(gx100)</td>
                                    </tr>
                                    <?php if($dietaRetornada->getListaAlimentos()!=null)
                                    { ?>
                                     <tr>
                                         <td rowspan="<?php echo count($dietaRetornada->getListaAlimentos()) ?>"><?php echo $dietaRetornada->getAluno()->getNome() ?></td>
                                        <td rowspan="<?php echo count($dietaRetornada->getListaAlimentos()) ?>"><?php echo $dietaRetornada->getDescricao() ?></td>
                                
                                            <td><?php echo $dietaRetornada->getListaAlimentos()[0]->getDescricao() ?></td>
                                            <td><?php echo $dietaRetornada->getListaAlimentos()[0]->getCaloria() ?></td>
                                            <td><?php echo $dietaRetornada->getListaAlimentos()[0]->getProteina() ?></td>
                                            <td><?php echo $dietaRetornada->getListaAlimentos()[0]->getCarboidrato() ?></td>
                                            <td><?php echo $dietaRetornada->getListaAlimentos()[0]->getGordura() ?></td>
                                            <td><?php echo $dietaRetornada->getListaAlimentos()[0]->getQtdAlimento() ?></td>
          
                                      </tr>
                                      
                                      
                                        <?php for($count=1; $count<count($dietaRetornada->getListaAlimentos());$count++) {?>
                                            <tr>
                                                <td><?php echo $dietaRetornada->getListaAlimentos()[$count]->getDescricao() ?></td>
                                                <td><?php echo $dietaRetornada->getListaAlimentos()[$count]->getCaloria() ?></td>
                                                <td><?php echo $dietaRetornada->getListaAlimentos()[$count]->getProteina() ?></td>
                                                <td><?php echo $dietaRetornada->getListaAlimentos()[$count]->getCarboidrato() ?></td>
                                                <td><?php echo $dietaRetornada->getListaAlimentos()[$count]->getGordura() ?></td>
                                                <td><?php echo $dietaRetornada->getListaAlimentos()[$count]->getQtdAlimento() ?></td>
                                            </tr>
                                        <?php }
                                    }
                                    else
                                    {
                                        ?>
                                            <tr>
                                                <td><?php echo $dietaRetornada->getAluno()->getNome() ?></td>
                                                <td><?php echo $dietaRetornada->getDescricao() ?></td>

                                               <td>Nenhum alimento foi encontrado na dieta do aluno</td>
                                               <td>//</td>
                                               <td>//</td>
                                               <td>//</td>
                                               <td>//</td>
                                            </tr>
                                    <?php } ?>
                                  
                        </table>
                         
                          <br/><br/>
                         Gordura total : <?php echo $gorduraTotal ?> g <br/><br/>
                         Proteina total : <?php echo $proteinaTotal ?> g <br/><br/>
                         Carboidrato total : <?php echo $carboidratoTotal ?> g <br/><br/><br/>
                         <b>Caloria total: <?php echo $caloriaTotal ?></b>
                         
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
    
    if(sizeof($listaDietas)==0 || $error)
    {
        ?> <h3>Mensagem</h3>
             <p><?php echo $mensagem ?></p> <?php
    }
    
    include('componentes/footerOne.php') ?>