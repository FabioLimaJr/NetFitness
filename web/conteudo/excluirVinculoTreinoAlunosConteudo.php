<?php 
    
    $camposPreenchidos = false;
    $fachada = Fachada::getInstance();
    $mensagem = "";
    //unset($_SESSION['Treino']);
    
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $camposPreenchidos = true;
    }
    if(isset($_SESSION['Instrutor']))
    {
        $instrutor = $_SESSION['Instrutor'];
    }
    
    $listaTreinos = array();
    $listaAlunos = $fachada->listarAlunos(EAGER);
    
?>

<h1 class="title">Página usuário</h1>
<div class="line"></div>

Nome: <?php echo $instrutor->getNome() ?> | Telefone:<?php echo $instrutor->getTelefone() ?> | Email:<?php echo $instrutor->getEmail() ?> | Endereço:<?php echo $instrutor->getEndereco() ?>
    
<div class="intro" style="margin-bottom:50px"></div>

<h3>Excluir vínculo treino</h3>

<div class="clear"></div>
<div class="line"></div>

<?php 
    
    if(!$camposPreenchidos){
        
?>

<div class="form-container" style="margin-bottom:50px">
    Selecionar os treinos:<br/><br/>
    <form class="forms" action="excluirVinculoTreinoAlunos.php" method="post" >
      <fieldset>
      
       <ol>
        

             <li class="form-row text-input-row" style="text-align:center;margin-left:-100px">
                    
                    <table style="width:700px;margin-bottom:50px; margin-left:100px;">
                          <tr>
                              <th style="width: 300px; text-align: center">Aluno </th>
                              <th colspan="2" style="text-align: center">Treinos</th>
                          </tr>
                          
                          <?php
                          $count = 0;
                          foreach ($listaAlunos as $aluno) 
                          {     
                               
                                $listaTreinos = $aluno->getListaTreinos();
                                $first = true;
                                foreach ($listaTreinos as $treino)
                                {
                                 ?>
                                    <tr>
                                        <?php if($first)
                                        { 
                                            $first = false; 
                                            ?>
                                            <td rowspan="<?php echo sizeof($listaTreinos) ?>" style="text-align: center"><?php echo $aluno->getNome(); ?></td>
                                            <?php
                                        } ?>
                                        <td><?php echo $treino->getNome() ?></td>
                                        <td><input type="checkbox" name="IdsAT<?php echo $count ?>" value="<?php echo $aluno->getIdAluno()."-".$treino->getIdTreino() ?>"> </td>
                                    </tr>
                                  <?php  
                                  $count++;
                                } 
                           } ?>
                          
                      </table>
             </li>
             <li class="form-row text-input-row" style="text-align:center;margin-left:-100px">
                 <input type="submit" value="Excluir os vínculos" name="submit" class="btn-submit">
             </li>
        </ol>  
          
       </fieldset>
       </form>
    </div>

    <?php 
    
    }
    else
    {
 
        $arrayIds = array();
        $count = 0;
        foreach (array_keys($_POST) as $key)
        {
            if (strpos($key,'IdsAT') !== false) 
            {
                $arrKey = explode("-", $_POST[$key]);
                $arrayIds[$count]['idAluno'] = $arrKey[0];
                $arrayIds[$count]['idTreino'] = $arrKey[1];
                $count++;
            }
        }
        
        if(sizeof($arrayIds)==0)
        {
            $mensagem = "Não foi selecionado nenhum treino.";
        }
        else
        {
            foreach($arrayIds as $ids)
            {
                $aluno = new Aluno($ids["idAluno"]);
                $treino = new Treino($ids["idTreino"]);
                try
                {
                    $fachada->excluirVinculoTreinoAluno($aluno, $treino);
                } 
                catch (Exception $ex)
                {
                   $mensagem = $ex->getMessage();   
                }
                
            }
            $mensagem = "Os vínculos foram excluidos com sucesso.";
        }
  
    }

if($camposPreenchidos && $mensagem!="")
{ ?>

    <h3>Mensagem</h3>
    <p><?php echo $mensagem ?></p>
    <?php 
    
} 

include('componentes/footerOne.php') 
?>

