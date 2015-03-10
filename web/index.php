<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/netFitness.css">

        <meta charset="UTF-8">
        <title>NetFitness : Login</title>
    </head>
    
    
    <body>
        <div id="boxLogin">
            
            <form enctype="multipart/form-data" name="loginUsuario" method="post"  action="logarUsuario.php">
                Informar Login:<br>
                <input type="text" name="login">
                <br/><br/>  
                Informar Senha:<br>
                <input type="text" name="senha"><br/><br/>  
                <input type="submit" value="Logar">
            </form>
          
         </div>
        
    </body>
</html>
