<?php 

    $fachada = Fachada::getInstance();

    $pessoa = new Pessoa(null, null, null, null, $_POST['senha'], null, $_POST['login'], null);

    $mensagem = "";
    $tipoDiv = "warning-box";
    $tipoUsuario = "";
    $usuarioLogado = null;
    $arrayMetodosLogar = ['logarAluno','logarCoordenador','logarNutricionista','logarInstrutor','logarSecretaria'];
    
    try
    {
        foreach ($arrayMetodosLogar as $metodoLogar)
        {
            $usuarioLogado = $fachada->{$metodoLogar}($pessoa);
            
            if($usuarioLogado!=null)
            {
               $tipoUsuario =  get_class($usuarioLogado);
               $tipoDiv = "info-box";
               $_SESSION[$tipoUsuario] = $usuarioLogado;
               $_SESSION['tipoUsuario'] = $tipoUsuario;
               $mensagem = "<span style=\"color:black\">O usuário ".$usuarioLogado->getNome()." efetuou o login com sucesso.</span><br/><br/>";
               $mensagem .= "<a href=\"".lcfirst($tipoUsuario).".php\">Clique aqui para acessar à sua pagina</a>";
               break;
            }
            
        }
       
    }
    catch (Exception $ex)
    {
       $tipoUsuario = "Desconhecido";
       $mensagem= $ex->getMessage();
    }
    
?>

<h1 class="title">Login Usuário</h1>
    <div class="line"></div>
    <div class="intro" style="margin-bottom:50px">Nullam id dolor id nibh ultricies vehicula ut id elit. Etiam porta sem malesuada magna mollis euismod. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</div>
    
    
    
    <h3>Tipo de usuário: <?php echo $tipoUsuario ?></h3>
   
    <div class="clear"></div>
    <div class="line"></div>

    <div class="<?php echo $tipoDiv ?>" style="margin-bottom: 50px">
        <?php echo $mensagem ?>
    </div>

    
    
    
    
    
    
    <h3>Malesuada Condimentum Inceptos Vehicula</h3>
    <p>Sed posuere consectetur est at lobortis. Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>
    <ul>
      <li>Sed posuere consectetur est at lobortis, Nullam id dolor id nibh ultricies vehicula. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
      <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </li>
      <li>Maecenas sed diam eget risus varius blandit sit amet non magna.</li>
    </ul>
    
    
    <?php include('componentes/footerOne.php') ?>
