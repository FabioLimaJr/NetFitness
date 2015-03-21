<?php
 $camposPreenchidos = false;
 $fachada = Fachada::getInstance();
 $mensagem = "";
 
  
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
     $camposPreenchidos = true;
 }
 if(isset($_SESSION['Aluno']))
 {
     $aluno = $_SESSION['Aluno'];
 }
?>

<h1 class="title">Página usuário</h1>
    <div class="line"></div>
    
    Nome: <?php echo $secretaria->getNome() ?> | Telefone:<?php echo $secretaria->getTelefone() ?> | Email:<?php echo $secretaria->getEmail() ?> | Endereço:<?php echo $secretaria->getEndereco() ?>
    
    <div class="intro" style="margin-bottom:50px">
         
    </div>
    
    
    
    <h3>Inserir Aluno</h3>
   
    <div class="clear"></div>
    <div class="line"></div>
    
    <!--
     ($idAluno, $nome, $cpf, $endereco, $senha, $telefone, $login, $email, $sexo, $dataNascimento, $secretaria,
                                $musica, $dieta, $listaPagamentos, $listaTreinos) 
    -->
    
   <?php 
   
    if(!$camposPreenchidos)
    {   
        ?> 
         <div class="form-container" style="margin-bottom:50px">
         <form class="forms" action="inserirAluno.php" method="post" >
         <fieldset>
           <ol>

              <li class="form-row text-input-row">
                 <label>Sexo</label>
                 <input type="radio" name="sexo" value="m" style="margin-top: 10px" checked>Masculino
                 <input type="radio" name="sexo" value="f">Feminino
             </li>  

             <li class="form-row text-input-row">
               <label>Nome</label>
               <input type="text" name="nome" value="<?php if(isset($aluno)) echo $aluno->getNome() ?>" class="text-input" style="width: 300px">
             </li>

             <li class="form-row text-input-row">
               <label>Cpf</label>
               <input type="text" name="cpf" value="<?php if(isset($aluno)) echo $aluno->getCpf() ?>" class="text-input" style="width: 300px">
             </li>

             <li class="form-row text-input-row">
               <label>Endereço</label>
               <input type="text" name="endereco" value="<?php if(isset($aluno)) echo $aluno->getEndereco() ?>" class="text-input" style="width: 300px">
             </li>

             <li class="form-row text-input-row">
               <label>Telefone</label>
               <input type="text" name="telefone" value="<?php if(isset($aluno)) echo $aluno->getTelefone() ?>" class="text-input" style="width: 300px">
             </li>

             <li class="form-row text-input-row">
               <label>Email</label>
               <input type="text" name="email" value="<?php if(isset($aluno)) echo $aluno->getEmail() ?>" class="text-input" style="width: 300px">
             </li>



             <li class="form-row text-input-row">
               <label>Dt Nascimento</label>
               <input type="text" name="dataNascimento" value="<?php if(isset($aluno)) echo $aluno->getdataNascimento() ?>" class="text-input" style="width: 300px">
             </li>

              <li class="form-row text-input-row">
               <label>Login</label>
               <input type="text" name="login" value="<?php if(isset($aluno)) echo $aluno->getLogin()?>" class="text-input" style="width: 300px">
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

             $aluno = new Aluno(null, $_POST['nome'], $_POST['cpf'], 
                                $_POST['endereco'], $_POST['senha'], 
                                $_POST['telefone'], $_POST['login'], 
                                $_POST['email'],$_POST['sexo'], 
                                $_POST['dataNascimento'], $secretaria, 
                                null/*$musica*/, null/*$dieta*/, null/*$listaPagamentos*/, 
                                null/*$listaTreinos*/);

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
             }
    }
  
   
   
   ?> 
    
    <h3>Mensagem</h3>
    <p><?php echo $mensagem ?></p>

    
    
    <?php include('componentes/footerOne.php') ?>