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
?>

<h1 class="title">Página usuário</h1>
<div class="line"></div>
Nome: <?php echo $coordenador->getNome() ?> | Telefone:<?php echo $coordenador->getTelefone() ?> | Email:<?php echo $coordenador->getEmail() ?>
     
<div class="intro" style="margin-bottom:50px">
         
</div>
    
    
    
<h3>Inserir Secretaria</h3>
   
<div class="clear"></div>
<div class="line"></div>

<?php 
   
    if(!$camposPreenchidos)
    {   
        ?>

<div class="form-container" style="margin-bottom:50px">
    <form class="forms" action="inserirSecretaria.php" method="post" >
        <fieldset>
            <ol>
                <li class="form-row text-input-row">
                    <label>Nome</label>
                    <input type="text" name="nome" value="<?php if(isset($secretaria)) echo $secretaria->getNome() ?>" class="text-input" style="width: 300px">
                </li>

                <li class="form-row text-input-row">
                  <label>CPF</label>
                  <input type="text" name="cpf" value="<?php if(isset($secretaria)) echo $secretaria->getCpf() ?>" class="text-input" style="width: 300px">
                </li>

                <li class="form-row text-input-row">
                  <label>Endereço</label>
                  <input type="text" name="endereco" value="<?php if(isset($secretaria)) echo $secretaria->getEndereco() ?>" class="text-input" style="width: 300px">
                </li>
            
                <li class="form-row text-input-row">
                  <label>Telefone</label>
                  <input type="text" name="telefone" value="<?php if(isset($secretaria)) echo $secretaria->getTelefone() ?>" class="text-input" style="width: 300px">
                </li>

                <li class="form-row text-input-row">
                  <label>Email</label>
                  <input type="text" name="email" value="<?php if(isset($secretaria)) echo $secretaria->getEmail() ?>" class="text-input" style="width: 300px">
                </li>

                 <li class="form-row text-input-row">
                  <label>Login</label>
                  <input type="text" name="login" value="<?php if(isset($secretaria)) echo $secretaria->getLogin()?>" class="text-input" style="width: 300px">
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
        
        $secretaria = new Secretaria(null, $_POST['nome'], $_POST['cpf'], $_POST['endereco'], $_POST['senha'], $_POST['telefone'], $_POST['login'], $_POST['email'], $coordenador);
        $_SESSION['Secretaria'] = $secretaria;
        
        try{
           if(!$fachada->conferirLoginsenha($secretaria)){ 
               
                $fachada->inserirSecretaria($secretaria);
                $mensagem = "Parabéns, a(o) secretaria(o) ".$_POST['nome']." foi inserida(o)  com sucesso!";
                unset($_SESSION['Secretaria']);
                           
           }  else {
               throw new Exception(Excecoes::loginSenhaInvalidos());
           }
           
            $mail = new PHPMailer;
            $mail->setLanguage('pt');
                        //$mail->SMTPDebug = 1;
                        
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = SMTP_SERVER;  // Specify main and backup SMTP servers
            $mail->SMTPAuth = SMTP_AUTH;                               // Enable SMTP authentication
            $mail->Username = EMAIL_ADDRESS;                 // SMTP username
            $mail->Password = EMAIL_PASSWORD;                      // SMTP password
            $mail->SMTPSecure = SMTP_SICURE;                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = SMTP_PORT;                                    // TCP port to connect to

            $mail->From = EMAIL_ADDRESS;
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = '8bit';
            $mail->ContentType = 'text/html; charset=utf-8\r\n';
            $mail->FromName = "NetFitness";
            $mail->addAddress($_POST['email']);     // Add a recipient

            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = "Cadastro NetFitness";
            $mail->Body    = "Parabéns ".$_POST['nome'].", o seu cadastro na NetFitness foi realizado com sucesso.<br><br/>".
                             "Dados do cadastro do usuário:<br/>".
                             "Login: ".$_POST['login']."<br/>".
                             "Senha: ".$_POST['senha']."<br/><br/>".
                             "NetFitenss.com.br";


            if(!$mail->send()) 
            {
                $mensagem.="<br/><br/>Erro ao enviar o email de notificação de cadastro<br/>".$mail->ErrorInfo;
            }  
            else
            {
                $mensagem.="<br/><br/>Um email de notificação foi enviada ao usuário ".$_POST['nome'];
            }
           
        } catch (Exception $ex) {

            $mensagem = $ex->getMessage();
        }            
    }
    
    ?>

    <h3>Mensagem</h3>
    <p><?php echo $mensagem ?></p>

    
    
    <?php include('componentes/footerOne.php') ?>