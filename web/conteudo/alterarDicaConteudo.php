<?php
$camposPreenchidos = false;
//$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $camposPreenchidos = true;
}

try {
    //$pessoa="";
if($_SESSION['tipoUsuario'] == "Nutricionista")
{
    // $pessoa = $_SESSION['Nutricionista'];
     $listaDicas = $fachada->listarDicas($pessoa);
     $_SESSION['listaDicas'] = $listaDicas;   
}
else if(($_SESSION['tipoUsuario'] == "Instrutor"))
{
    // $pessoa = $_SESSION['Instrutor'];
     $listaDicas = $fachada->listarDicas($pessoa);
     $_SESSION['listaDicas'] = $listaDicas;
}
    
    
} catch (Exception $exc) {
    echo $exc->getMessage();
}

?>

<h1 class="title">Alterar Dica</h1>

<div class="line"></div>
Telefone:<?php echo $pessoa->getTelefone() ?> | Email:<?php echo $pessoa->getEmail() ?> | Endereço:<?php echo $pessoa->getEndereco() ?>
<div class="intro" style="margin-bottom:50px"></div>

<h3>Usuário logado: <?php echo $pessoa->getNome() ?></h3>
   
<div class="clear"></div>
<div class="line"></div>

<?php 
 if(!$camposPreenchidos) 
 { ?>
    <div class="form-container" style="margin-bottom:50px">
    <form class="forms" action="alterarDica.php" method="post" >
      <fieldset>
          <ol>
              <li class="form-row text-input-row">
                  <table style="width: 100%; margin-bottom: 50px">
                      <tr>
                          <th>Descricao</th>
                          <th>Titulo</th>
                          <th>Selecionar</th>
                      </tr>
                      
                      <?php foreach ($listaDicas as $dica){ ?>
                        <tr>
                            <td><?php echo $dica->getDescricao() ?></td>
                            <td><?php echo $dica->getTitulo() ?></td>
                            <td><input type="radio" name="idDica" value="<?php echo $dica->getIdDica() ?>"></td>
                        </tr>
                      <?php }?>
                  </table>
              </li>
              
              <li class="form-row text-input-row" style="text-align:center;margin-left:-100px">
                <input type="submit" value="Alterar" name="submit" class="btn-submit">
             </li>
          </ol>
      </fieldset>
    </form>
    </div>
 <?php } 
 else 
    { 

     if(isset($_POST['idDica']))
     {
         
         
         if($_POST['submit']=="Alterar")
         {
             
          $listaDicasRetornada = $_SESSION['listaDicas'];
          $dicaSelecionada = null;
         foreach ($listaDicasRetornada as $dica){
             if($dica->getIdDica() == $_POST['idDica']){
                 $dicaSelecionada = $dica;
                 break;
             }
         }
         
         
         ?>
        <div class="form-container" style="margin-bottom: 50px">
        <form class="forms" action="alterarDica.php" method="POST">
            <fieldset>
                <ol>
                    <li class="form-row text-input-row" >
                        <label>Titulo</label>
                        <input type="text" name="titulo" value="<?php if(isset($dicaSelecionada)) echo $dicaSelecionada->getTitulo() ?>" class="text-input" style="white: 300px">
                    </li>
                    
                    <li class="form-row text-input-row">
                        <label>Descrição</label>
                        <textarea class="text-input" name="descricao"  style="width:500px; height: 100px"><?php if(isset($dicaSelecionada)) echo $dicaSelecionada->getDescricao() ?></textarea>
                    </li>
                    
                    <li class="button-row" style="margin-top: 50px">
                        <input type="hidden" name="idDica" value="<?php echo $_POST['idDica'] ?>">
                        <input type="submit" name="submit" value="Confirmar" class="btn-submit">
                    </li>                    
                </ol>
            </fieldset>
        </form>
    </div>

     <?php }  
     else
     {
          $dica = new Dica($_POST['idDica'], 
                             $_POST['descricao'], 
                             $_POST['titulo']);
   
           if(isset($_SESSION['Nutricionista'])){
             try
             {
                $fachada->alterarDica($dica);
                $mensagem = "Parabéns, a dica foi alterada  com sucesso!";
               
             }
             catch(Exception $exc)
             {
                $mensagem = $exc->getMessage();
             }  
           }else if (isset($_SESSION['Instrutor'])) {
               try
             {
                $fachada->alterarDica($dica);
                $mensagem = "Parabéns, a dica foi alterada  com sucesso!";
               
             }
             catch(Exception $exc)
             {
                $mensagem = $exc->getMessage();
             }
           }
             
     }
     
     }
     
}

 if( isset($_POST['submit']) && $_POST['submit']=="Confirmar")  { ?>
    
        <h3>Mensagem</h3>
        <p><?php echo $mensagem ?></p>
    
    <?php } 
    
include('componentes/footerOne.php') ?>