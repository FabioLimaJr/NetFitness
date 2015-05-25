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

             
                <li class="form-row text-input-row">
                    <label>Altura</label>
                    <input type="text" name="altura" value="<?php if(isset($exameFisico)) echo $exameFisico->getAltura() ?>" class="text-input" style="width: 100px"> Ex: 1.70 Metros
             </li>
               <li class="form-row text-input-row">
                    <label>Peso</label>
                    <input type="text" name="peso" value="<?php if(isset($exameFisico)) echo $exameFisico->getPeso() ?>" class="text-input" style="width: 100px"> Ex: 80.5 Kilos
                </li>
                
                 <li class="form-row text-input-row">
                    <label>IMC</label>
                    <input type="text" name="imc" value="<?php if(isset($exameFisico)) echo $exameFisico->getImc() ?>" class="text-input" style="width: 100px"> Ex: 24.5
             </li>
                <h3 class="title">Circunferências:</h3>
              
                
                <li class="form-row text-input-row">
                    <label>Tórax</label>
                    <input type="text" name="circTorax" value="<?php if(isset($exameFisico)) echo $exameFisico->getCircTorax() ?>" class="text-input" style="width: 100px"> Ex: 110 centimetros
                </li>
                <li class="form-row text-input-row">
                    <label>Abdomen</label>
                    <input type="text" name="circAbdomen" value="<?php if(isset($exameFisico)) echo $exameFisico->getCircAbdomen() ?>" class="text-input" style="width: 100px"> Ex: 110 centimetros
                </li>
                 <li class="form-row text-input-row">
                    <label>Braço</label>
                    <input type="text" name="circBraco" value="<?php if(isset($exameFisico)) echo $exameFisico->getCircBraco() ?>" class="text-input" style="width: 100px"> Ex: 110 centimetros
                </li>
                 <li class="form-row text-input-row">
                    <label>Antebraço</label>
                    <input type="text" name="circAntebraco" value="<?php if(isset($exameFisico)) echo $exameFisico->getCircAntebraco() ?>" class="text-input" style="width: 100px"> Ex: 110 centimetros
                </li>
                 <li class="form-row text-input-row">
                    <label>Coxa</label>
                    <input type="text" name="circCoxa" value="<?php if(isset($exameFisico)) echo $exameFisico->getCircCoxa() ?>" class="text-input" style="width: 100px"> Ex: 110 centimetros
                </li>
                 <li class="form-row text-input-row">
                    <label>Panturrilha</label>
                    <input type="text" name="circPanturrilha" value="<?php if(isset($exameFisico)) echo $exameFisico->getCircPanturrilha() ?>" class="text-input" style="width: 100px"> Ex: 110 centimetros
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
       
       $exameFisico = new ExameFisico(null, $_POST['data'], $_POST['descricao'], $_POST['imc'], $_POST['altura'], 
                                      $_POST['peso'], $_POST['circTorax'], $_POST['circAbdomen'], $_POST['circBraco'], 
                                      $_POST['circAntebraco'], $_POST['circCoxa'], $_POST['circPanturrilha'], 
                                      $aluno, $_SESSION['Instrutor']);
       
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