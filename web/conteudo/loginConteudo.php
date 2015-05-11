<h1 class="title">Login Usuário</h1>
    <div class="line"></div>
    <div class="intro" style="margin-bottom:50px">Efetue o login para ter acesso a área restrita.</div>
    
    
    
    <h3>Informar os dados do usuário</h3>
   
    <div class="clear"></div>
    <div class="line"></div>

    <!--.forms fieldset .text-input -->
    
    <div class="form-container" style="margin-bottom:50px">
        <form class="forms" action="loginResposta.php" method="post" >
        <fieldset>
          <ol>
            <li class="form-row text-input-row">
              <label>Login</label>
              <input type="text" name="login" value="" class="text-input" style="width: 300px">
            </li>
            <li class="form-row text-input-row">
              <label>Senha</label>
              <input type="password" name="senha" value="" class="text-input" style="width: 300px">
            </li>
          
            <li class="button-row">
              <input type="submit" value="Submit" name="submit" class="btn-submit">
            </li>
          </ol>
         
        </fieldset>
      </form>
      <div class="response"></div>
    </div>
    
    
    
    
    
    

    
    <?php include('componentes/footerOne.php') ?>
