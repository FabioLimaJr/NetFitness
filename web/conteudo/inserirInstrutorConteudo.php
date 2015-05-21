<?php
 $camposPreenchidos = false;
 $fachada = Fachada::getInstance();
 $mensagem = "";
 
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
     $camposPreenchidos = true;
 }
 if(isset($_SESSION['Instrutor']))
 {
     $instrutor = $_SESSION['Instrutor'];
 }
?>

<h1 class="title">Página usuário</h1>
<div class="line"></div>
Nome: <?php echo $coordenador->getNome() ?> | Telefone:<?php echo $coordenador->getTelefone() ?> | Email:<?php echo $coordenador->getEmail() ?>
     
<div class="intro" style="margin-bottom:50px">
         
</div>

<h3>Inserir Instrutor</h3>
   
<div class="clear"></div>
<div class="line"></div>

<?php 
   
    if(!$camposPreenchidos)
    {   
        ?>

<div class="form-container" style="margin-bottom:50px">
    <form class="forms" action="inserirInstrutor.php" method="post" >
        <fieldset>
            <ol>
                <li class="form-row text-input-row">
                    <label>Nome</label>
                    <input type="text" name="nome" value="<?php if(isset($instrutor)) echo $instrutor->getNome() ?>" class="text-input" style="width: 300px">
                </li>

                <li class="form-row text-input-row">
                  <label>CPF</label>
                  <input type="text" name="cpf" value="<?php if(isset($instrutor)) echo $instrutor->getCpf() ?>" class="text-input" style="width: 300px">  &nbsp;&nbsp;<span style="color: #c4c4c4">Ex. 111.111.111-11</span>
                </li>

                <li class="form-row text-input-row">
                  <label>Endereço</label>
                  <input type="text" name="endereco" value="<?php if(isset($instrutor)) echo $instrutor->getEndereco() ?>" class="text-input" style="width: 300px">
                </li>
            
                <li class="form-row text-input-row">
                  <label>Telefone</label>
                  <input type="text" name="telefone" value="<?php if(isset($instrutor)) echo $instrutor->getTelefone() ?>" class="text-input" style="width: 300px"> <span style="color: #c4c4c4">&nbsp;&nbsp;Ex. (DD) 1111-1111</span>
                </li>

                <li class="form-row text-input-row">
                  <label>Email</label>
                  <input type="text" name="email" value="<?php if(isset($instrutor)) echo $instrutor->getEmail() ?>" class="text-input" style="width: 300px">
                </li>

                 <li class="form-row text-input-row">
                  <label>Login</label>
                  <input type="text" name="login" value="<?php if(isset($instrutor)) echo $instrutor->getLogin()?>" class="text-input" style="width: 300px">
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
    }else{
        
        //$idInstrutor, $coordenador, $listaTreinos, $listaExamesFisicos, $listaDicas, $nome, $cpf, $endereco, $senha, $telefone, $email, $login
        $instrutor = new Instrutor(null, 
                                    $coordenador, 
                                    null, 
                                    null, 
                                    null, 
                                    $_POST['nome'], 
                                    $_POST['cpf'], 
                                    $_POST['endereco'], 
                                    $_POST['senha'], 
                                    $_POST['telefone'], 
                                    $_POST['email'], 
                                    $_POST['login']);
        
        $_SESSION['Instrutor'] = $instrutor;
        
        try{
            
            $fachada->inserirInstrutor($instrutor);
            $mensagem = "Instrutor inserido com sucesso!!";
            unset($_SESSION['Instrutor']);
        } catch (Exception $ex) {

            $mensagem = $ex->getMessage();
        }
    }
    
    ?>

    <h3>Mensagem</h3>
    <p><?php echo $mensagem ?></p>

    
    
    <?php include('componentes/footerOne.php') ?>

