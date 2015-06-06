<?php
 $camposPreenchidos = false;
 $fachada = Fachada::getInstance();
 $mensagem = "";
 
  
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
     $camposPreenchidos = true;
 }
 if(isset($_SESSION['Opiniao']))
 {
     $opiniao = $_SESSION['Opiniao'];
 }
?>

<h1 class="title">Página usuário</h1>
    <div class="line"></div>
    
    Nome: <?php echo $aluno->getNome() ?> | Telefone:<?php echo $aluno->getTelefone() ?> | Email:<?php echo $aluno->getEmail() ?> | Endereço:<?php echo $aluno->getEndereco() ?>
    <div style="float:right"><image height = "80" src="<?php echo IMAGE_PATH_ALUNOS."/".$aluno->getFoto() ?>"> </div>
    <div class="intro" style="margin-bottom:50px">
         
    </div>
    
    
    
    <h3>Inserir Opinião</h3>
   
    <div class="clear"></div>
    <div class="line"></div>
    
   <?php 
   
    if(!$camposPreenchidos)
    {   
        ?> 
         <div class="form-container" style="margin-bottom:50px">
             <form class="forms" action="inserirOpiniao.php" method="post" >
         <fieldset>
           <ol>

              <li class="form-row text-input-row">
                        <label>Descrição</label>
                        <textarea class="text-input" name="descricao" value="<?php if(isset($opiniao)) echo $opiniao->getDescricao() ?>" style="width:500px; height: 100px"></textarea>
              </li> 

             <li class="form-row text-input-row">
                 <label>Data de Postagem</label>
                 <input type="text" id="dataPicked" maxlength="10" name="data" value="" class="text-input" style="width: 300px">
             </li>

             <li class="button-row" style="margin-top:50px">
               <input type="submit" value="Inserir" name="submit" class="btn-submit">
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

             $opiniao = new Opiniao(null, 
                                    $_POST['descricao'],
                                    $_POST['data'], 
                                    $aluno);

             
             $_SESSION['Opiniao'] = $opiniao; 

             try
             {
                $fachada->inserirOpiniao($opiniao);
                $mensagem = "Parabéns, a opiniao do aluno ".$aluno->getNome()." foi incluido com sucesso!";
                
             }
             catch(Exception $exc)
             {
                $mensagem = $exc->getMessage();
             }
    }
   ?> 
    
    <h3>Mensagem</h3>
    <p><?php echo $mensagem ?></p>

    
    
    <?php include('componentes/footerOne.php') ?>
