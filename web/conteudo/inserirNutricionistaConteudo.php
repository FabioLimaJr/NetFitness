<?php
 $camposPreenchidos = false;
 $fachada = Fachada::getInstance();
 $mensagem = "";
 
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
     $camposPreenchidos = true;
 }
 if(isset($_SESSION['Nutricionista']))
 {
     $nutricionista = $_SESSION['Nutricionista'];
 }
?>

<h1 class="title">Página usuário</h1>
    <div class="line"></div>
        Nome: <?php echo $coordenador->getNome() ?> | Telefone:<?php echo $coordenador->getTelefone() ?> | Email:<?php echo $coordenador->getEmail() ?>
     
    <div class="intro" style="margin-bottom:50px">
         
    </div>
    
    
    
    <h3>Inserir Nutricionista</h3>
   
    <div class="clear"></div>
    <div class="line"></div>
       
   <?php 
   
    if(!$camposPreenchidos)
    {   
        ?> 
         <div class="form-container" style="margin-bottom:50px">
         <form class="forms" action="inserirNutricionista.php" method="post" >
         <fieldset>
           <ol>
<!--
              <li class="form-row text-input-row">
                 <label>Sexo</label>
                 <input type="radio" name="sexo" value="m" style="margin-top: 10px" checked>Masculino
                 <input type="radio" name="sexo" value="f">Feminino
             </li>  
-->
             <li class="form-row text-input-row">
               <label>Nome</label>
               <input type="text" name="nome" value="<?php if(isset($nutricionista)) echo $nutricionista->getNome() ?>" class="text-input" style="width: 300px">
             </li>

             <li class="form-row text-input-row">
               <label>CPF</label>
               <input type="text" name="cpf" value="<?php if(isset($nutricionista)) echo $nutricionista->getCpf() ?>" class="text-input" style="width: 300px">
             </li>

             <li class="form-row text-input-row">
               <label>Endereço</label>
               <input type="text" name="endereco" value="<?php if(isset($nutricionista)) echo $nutricionista->getEndereco() ?>" class="text-input" style="width: 300px">
             </li>
            
             <li class="form-row text-input-row">
               <label>Telefone</label>
               <input type="text" name="telefone" value="<?php if(isset($nutricionista)) echo $nutricionista->getTelefone() ?>" class="text-input" style="width: 300px">
             </li>

             <li class="form-row text-input-row">
               <label>Email</label>
               <input type="text" name="email" value="<?php if(isset($nutricionista)) echo $nutricionista->getEmail() ?>" class="text-input" style="width: 300px">
             </li>

             <li class="form-row text-input-row">
               <label>CRN</label>
               <input type="text" name="crn" value="<?php if(isset($nutricionista)) echo $nutricionista->getcrn() ?>" class="text-input" style="width: 300px">
             </li>

              <li class="form-row text-input-row">
               <label>Login</label>
               <input type="text" name="login" value="<?php if(isset($nutricionista)) echo $nutricionista->getLogin()?>" class="text-input" style="width: 300px">
             </li>

              <li class="form-row text-input-row">
               <label>Senha</label>
               <input type="password" name="senha" value="" class="text-input" style="width: 300px">
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
        // $idNutricionista, $coordenador, $crn, $listaDietas, $listaDicas, 
          //               $nome, $cpf, $endereco, $senha, $telefone, $email, $login)
        $nutricionista = new Nutricionista(null, $coordenador,$_POST['crn'],
                        null/*$dieta*/,null/*$dica*/, $_POST['nome'], $_POST['cpf'], 
                        $_POST['endereco'], $_POST['senha'], 
                        $_POST['telefone'], $_POST['email'],
                        $_POST['login']);

             $_SESSION['Nutricionista'] = $nutricionista; 
           // var_dump($_SESSION['Nutricionista']);

             try
             {
                $fachada->inserirNutricionista($nutricionista);
                $mensagem = "Parabéns, o(a) nutricionista ".$_POST['nome']." foi inserido(a)  com sucesso!";
                unset($_SESSION['Nutricionista']);

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
