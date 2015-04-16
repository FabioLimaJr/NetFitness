<?php
 $camposPreenchidos = false;
 $fachada = Fachada::getInstance();
 $listaAlunos = array();
 $mensagem = "";
 
  
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
     $camposPreenchidos = true;
 }
 if(isset($_SESSION['Aluno']))
 {
     $aluno = $_SESSION['Aluno'];
 }

 $listaAlunos = $fachada->listarAlunos(LAZY);
 
 
?>

<h1 class="title">Página usuário</h1>
    <div class="line"></div>
    
    Nome: <?php echo $instrutor->getNome() ?> | Telefone:<?php echo $instrutor->getTelefone() ?> | Email:<?php echo $instrutor->getEmail() ?> | Endereço:<?php echo $instrutor->getEndereco() ?>
    
    <div class="intro" style="margin-bottom:50px">
         
    </div>
    
    
    
    <h3>Inserir Exame Físico</h3>
   
    <div class="clear"></div>
    <div class="line"></div>
    
    
    
   <?php 
   
    if(!$camposPreenchidos)
    {  
        if(isset($_SESSION))
        
        ?> 
        
       
         <div class="form-container" style="margin-bottom:50px">
             <form class="forms" action="inserirExameFisico.php" method="post" >
         <fieldset>
           <ol>


             <li class="form-row text-input-row">
               <label>Descrição</label>
               <textarea class="text-input" name="descricao" style="width:478px; height: 100px"><?php 
                        if(isset($exameFisico)) echo $exameFisico->getDescricao() 
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
                 <label>Data</label>
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
      
       $aluno = new Aluno($_POST['idAluno']);
       $aluno = $fachada->detalharAluno($aluno, LAZY);
       
       
       $exameFisico = new ExameFisico(null, $_POST['data'], $_POST['descricao'], $aluno, $_SESSION['Instrutor']);
       
       $_SESSION['ExameFisico'] = $exameFisico;
      
       
       try
       {
           $fachada->inserirExameFisico($exameFisico);
           unset($_SESSION['ExameFisico']);
           $mensagem = "O exame fisico do aluno ".$aluno->getNome()." foi inserido com sucesso.";
       } 
       catch (Exception $exc)
       {
           $mensagem = $exc->getMessage();
       }

    }
  
   
   
   if($camposPreenchidos) { ?>
    
        <h3>Mensagem</h3>
        <p><?php echo $mensagem ?></p>
    
    <?php } 
    
    include('componentes/footerOne.php') ?>