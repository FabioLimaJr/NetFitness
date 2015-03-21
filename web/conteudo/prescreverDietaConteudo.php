<?php
 $camposPreenchidos = false;
 $fachada = Fachada::getInstance();
 $mensagem = "";
 
  
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
     $camposPreenchidos = true;
 }
 if(isset($_SESSION['Dieta']))
 {
     $dieta = $_SESSION['Dieta'];
 }

 $listaAlunos = $fachada->listarAlunos();
 $listaAlimentos = $fachada->listarAlimentos();
 
 
?>

<h1 class="title">Página usuário</h1>
    <div class="line"></div>
    
    Nome: <?php echo $nutricionista->getNome() ?> | Telefone:<?php echo $nutricionista->getTelefone() ?> | Email:<?php echo $nutricionista->getEmail() ?> | Endereço:<?php echo $nutricionista->getEndereco() ?>
    
    <div class="intro" style="margin-bottom:50px">
         
    </div>
    
    
    
    <h3>Prescrever Dieta</h3>
   
    <div class="clear"></div>
    <div class="line"></div>
    
    
    
   <?php 
   
    if(!$camposPreenchidos)
    {   
        ?> 
         <div class="form-container" style="margin-bottom:50px">
         <form class="forms" action="prescreverDieta.php" method="post" >
         <fieldset>
           <ol>


             <li class="form-row text-input-row">
               <label>Descrição</label>
               <textarea class="text-input" name="descricao" style="width:478px; height: 100px"><?php 
                        if(isset($dieta)) echo $dieta->getDescricao() 
                ?></textarea>
             </li>

             <li class="form-row text-input-row">
               <label>Aluno</label>
               <select name="idAluno" size="5" style="width: 500px">
                   
                   <?php
                   $primeiro = true;
                   $selecionado = "selected=\"selected\"";
                   foreach ($listaAlunos as $aluno) 
                   {     
                      ?>  
                        <option <?php echo $selecionado ?> value="<?php echo $aluno->getIdAluno() ?>"><?php echo $aluno->getNome() ?></option>
                        <?php 

                         if($primeiro) 
                         {
                             $primeiro = false;
                             $selecionado ="";
                         }
                    
                   } ?>
                   
                </select>
             </li>
             
             <li class="form-row text-input-row">
              <label>Alimentos</label>   
                 <table style="width:500px; margin-left:100px">
                    <tr>
                      <th>Descrição</th> 
                      <th>Cal. (%)</th>
                      <th>Carb. (%)</th>
                      <th>Prot. (%)</th>
                      <th>Gord. (%)</th>
                      <th>Sel.</th>
                     </tr>
                      
                      <?php foreach ($listaAlimentos as $alimento) { ?>
                         <tr>
                             <td> <?php echo $alimento->getDescricao() ?> </td>
                             <td> <?php echo $alimento->getCaloria() ?> </td>
                             <td> <?php echo $alimento->getCarboidrato() ?> </td>
                             <td> <?php echo $alimento->getProteina() ?> </td>
                             <td> <?php echo $alimento->getGordura() ?> </td>
                             <td> <input type="checkbox" name="alimento<?php echo $alimento->getIdAlimento() ?>" value="true"> </td>
                         </tr>
                      <?php } ?>
                     
                     
              </table>
             </li>

             

             <li class="button-row" style="margin-top:50px">
               <input type="submit" value="Prescrever" name="submit" class="btn-submit">
             </li>
           </ol>

         </fieldset>
       </form>
       <div class="response"></div>
     </div>
        <?php 
    } 
    else
    {
       //$aluno = $fachada->;
       $aluno = new Aluno($_POST['idAluno']);
       $aluno = $fachada->detalharAluno($aluno);
       
       $listaAlimentosPrescritos = array();
      
       foreach(array_keys($_POST) as $parametro)
       {
           if(strpos($parametro,'alimento') !== false)
           {
               $idAlimento = explode("alimento", $parametro);
               
               foreach($listaAlimentos as $alimento) 
               {
                    if ($idAlimento[1] == $alimento->getIdAlimento()) 
                    {  
                        array_push($listaAlimentosPrescritos, $alimento);
                        break;
                    }
               }
           }
       }
       
     
       $dieta = new Dieta(null, $_POST['descricao'], $listaAlimentosPrescritos, $_SESSION['Nutricionista'], $aluno);      
       $_SESSION['Dieta'] = $dieta;
       
       try
       {
           $fachada->inserirDieta($dieta);
           unset($_SESSION['Dieta']);
           $mensagem = "A dieta do aluno ".$aluno->getNome()." foi inserida com sucesso.";
       } 
       catch (Exception $exc)
       {
           $mensagem = $exc->getMessage();
       }


       /*

           $aluno = new Aluno(null, $_POST['nome'], $_POST['cpf'], 
                                $_POST['endereco'], $_POST['senha'], 
                                $_POST['telefone'], $_POST['login'], 
                                $_POST['email'],$_POST['sexo'], 
                                $_POST['dataNascimento'], $secretaria, 
                               

             $_SESSION['Aluno'] = $aluno; 
            // var_dump($_SESSION['Aluno']);

             try
             {
                $fachada->incluirAluno($aluno);
                $mensagem = "Parabéns, o aluno ".$_POST['nome']." foi incluido com sucesso!";
                unset($_SESSION['Aluno']);

             }
             catch(Exception $exc)
             {
                $mensagem = $exc->getMessage();
             }*/
    }
  
   
   
   if($camposPreenchidos) { ?>
    
        <h3>Mensagem</h3>
        <p><?php echo $mensagem ?></p>
    
    <?php } 
    
    include('componentes/footerOne.php') ?>
