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
    $listaDietas = $fachada->listarDietas($_SESSION['Nutricionista']);
    //var_dump($listaDietas);
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
    
    
   
 
    
?>

<h1 class="title">Detalhar Dieta</h1>
    <div class="line"></div>
    Telefone:<?php echo $nutricionista->getTelefone() ?> | Email:<?php echo $nutricionista->getEmail() ?> | Endereço:<?php echo $nutricionista->getEndereco() ?>
    <div class="intro" style="margin-bottom:50px"></div>
    
    
    
    <h3>Usuário logado: <?php echo $nutricionista->getNome() ?></h3>
   
    <div class="clear"></div>
    <div class="line"></div>
    
    <?php if(!$camposPreenchidos) {?>
    
    <div class="form-container" style="margin-bottom:50px">
      <form class="forms" action="detalharDieta.php" method="post" >
      <fieldset>
      
       <ol>
            <li class="form-row text-input-row">     
               <table style="width:100%;margin-bottom:50px">
                         <tr>
                           <th>Nome Aluno</th> 
                           <th>Descrição Dieta</th>
                           <th>Alimentos</th>
                           <th>Selecionar</th>
                         </tr>

                         <?php foreach ($listaDietas as $dieta){ ?>
                         <tr>
                             <td><?php echo $dieta->getAluno()->getNome() ?></td> 
                             <td><?php echo $dieta->getDescricao() ?></td>  
                             <td>Falta lista Alimentos</td>  
                             <td><input type="radio" name="idDieta" value="<?php echo $dieta->getIdDieta() ?>"></td>
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
                $dieta = new Dieta($_POST['idDieta']);
                $dietaRetornada = $fachada->detalharDieta($dieta);
               // var_dump($dietaRetornada);
                ?>
                     <div style="margin-bottom: 50px">
        
                        <table style="width:100%">
                                    <tr>
                                        <td>Nome Aluno</td>
                                        <td>Descrição Dieta</td>
                                        <td>Alimentos</td>
                                        <td>Cal.(%)</td>
                                        <td>Prot.(%)</td>
                                        <td>Carb.(%)</td>
                                        <td>Gord.(%)</td>
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
          
                                      </tr>
                                      
                                      
                                        <?php for($count=1; $count<count($dietaRetornada->getListaAlimentos());$count++) {?>
                                            <tr>
                                                <td><?php echo $dietaRetornada->getListaAlimentos()[$count]->getDescricao() ?></td>
                                                <td><?php echo $dietaRetornada->getListaAlimentos()[$count]->getCaloria() ?></td>
                                                <td><?php echo $dietaRetornada->getListaAlimentos()[$count]->getProteina() ?></td>
                                                <td><?php echo $dietaRetornada->getListaAlimentos()[$count]->getCarboidrato() ?></td>
                                                <td><?php echo $dietaRetornada->getListaAlimentos()[$count]->getGordura() ?></td>
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