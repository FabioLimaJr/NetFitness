<?php
 $camposPreenchidos = false;
 $fachada = Fachada::getInstance();
 $mensagem = "";
 
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
     $camposPreenchidos = true;
 }
 if(isset($_SESSION['Secretaria']))
 {
     $secretaria = $_SESSION['Secretaria'];
 }
 $listaAlunos = array();
 $listaAlunos = $fachada->listarAlunos(LAZY);
 
?>

<h1 class="title">Página usuário</h1>
    <div class="line"></div>
        Nome: <?php echo $secretaria->getNome() ?> | Telefone:<?php echo $secretaria->getTelefone() ?> | Email:<?php echo $secretaria->getEmail() ?>
     
    <div class="intro" style="margin-bottom:50px">
         
    </div>
        
        
    <h3>Inserir Pagamento</h3>
   
    <div class="clear"></div>
    <div class="line"></div>
    
    <?php 
   
    if(!$camposPreenchidos)
    {   
        ?> 
         <div class="form-container" style="margin-bottom:50px">
         <form class="forms" action="inserirPagamento.php" method="post" >
         <fieldset>
           <ol>
             <li class="form-row text-input-row">
               <label>Valor</label>
               <input type="text" name="valor" value="<?php if(isset($pagamento)) echo $pagamento->getValor() ?>" class="text-input" style="width: 300px">
             </li>

             <li class="form-row text-input-row">
               <label>DataVencimento</label>
               <input type="text" id="dataPicked" maxlength="10" name="dataVencimento" value="" class="text-input" style="width: 300px">
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
        echo 'Id Aluno: '.$_POST['idAluno'];
        $alunoSelecionado = new Aluno($_POST['idAluno']);
        //$alunoSelecionado->setIdAluno($_POST['aluno']);
        $pagamento = new Pagamento(null, 
                                   $_POST['valor'], 
                                   $_POST['dataVencimento'],
                                   null, 
                                   $secretaria, 
                                   $alunoSelecionado);
             

             $_SESSION['Pagamento'] = $pagamento; 
             //var_dump($_SESSION['Secretaria']);

             try
             {
                $fachada->inserirPagamento($pagamento);
                $mensagem = "Parabéns, o pagamento foi inserido com sucesso!";
                unset($_SESSION['Secretaria']);

             }
             catch(Exception $exc)
             {
                $mensagem = $exc->getMessage();
                echo $mensagem;
             }
    }
  
   
   ?> 
        