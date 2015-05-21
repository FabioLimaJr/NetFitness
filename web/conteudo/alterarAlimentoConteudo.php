<?php

$camposPreenchidos = false;
//$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $camposPreenchidos = true;
}

try {
    $listaAlimentos = $fachada->listarAlimentos($_SESSION['Nutricionista']);
    $_SESSION['listaAlimentos'] = $listaAlimentos;
} catch (Exception $exc) {
    echo $exc->getMessage();
}

?>

<h1 class="title">Alterar Alimento</h1>

<div class="line"></div>
Telefone:<?php echo $nutricionista->getTelefone() ?> | Email:<?php echo $nutricionista->getEmail() ?> | Endereço:<?php echo $nutricionista->getEndereco() ?>
<div class="intro" style="margin-bottom:50px"></div>

<h3>Usuário logado: <?php echo $nutricionista->getNome() ?></h3>
   
<div class="clear"></div>
<div class="line"></div>

 <?php 
 if(!$camposPreenchidos) 
 { ?>
    <div class="form-container" style="margin-bottom:50px">
    <form class="forms" action="alterarAlimento.php" method="post" >
      <fieldset>
          <ol>
              <li class="form-row text-input-row">
                  <table style="width: 100%; margin-bottom: 50px">
                      <tr>
                          <th>Descricao</th>
                          <th>Caloria</th>
                          <th>Proteina</th>
                          <th>Carboidrato</th>
                          <th>Gordura</th>
                          <th>Quantidade Alimento</th>
                           <th>Selecionar</th>
                      </tr>
                      
                      <?php foreach ($listaAlimentos as $alimento){ ?>
                        <tr>
                            <td><?php echo $alimento->getDescricao() ?></td>
                            <td><?php echo $alimento->getCaloria() ?></td>
                            <td><?php echo $alimento->getProteina() ?></td>
                            <td><?php echo $alimento->getCarboidrato() ?></td>
                            <td><?php echo $alimento->getGordura() ?></td>
                            <td><?php echo $alimento->getQtdAlimento() ?></td>
                            <td><input type="radio" name="idAlimento" value="<?php echo $alimento->getIdAlimento() ?>"></td>
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
 

     if(isset($_POST['idAlimento']))
     {
         
         
         if($_POST['submit']=="Alterar")
         {
             
          $listaAlimentosRetornada = $_SESSION['listaAlimentos'];
          $alimentoSelecionado = null;
         foreach ($listaAlimentosRetornada as $alimento){
             if($alimento->getIdAlimento() == $_POST['idAlimento']){
                 $alimentoSelecionado = $alimento;
                 break;
             }
         }
         
         
         ?>
         <div class="form-container" style="margin-bottom: 50px">
        <form class="forms" action="alterarAlimento.php" method="POST">
            <fieldset>
                <ol>
                    <li class="form-row text-input-row">
                        <label>Descrição</label>
                        <textarea class="text-input" name="descricao"  style="width:500px; height: 100px"><?php if(isset($alimentoSelecionado)) echo $alimentoSelecionado->getDescricao() ?></textarea>
                    </li>
                    
                    <li class="form-row text-input-row" >
                        <label>Caloria</label>
                        <input type="text" name="caloria" value="<?php if(isset($alimentoSelecionado)) echo $alimentoSelecionado->getCaloria() ?>" class="text-input" style="white: 300px">
                    </li>
                    
                    <li class="form-row text-input-row">
                        <label>Proteina</label>
                        <input type="text" name="proteina" value="<?php if(isset($alimentoSelecionado)) echo $alimentoSelecionado->getProteina() ?>" class="text-input" style="white: 300px">
                    </li>
                    
                    <li class="form-row text-input-row">
                        <label>Carboidrato</label>
                        <input type="text" name="carboidrato" value="<?php if(isset($alimentoSelecionado)) echo $alimentoSelecionado->getCarboidrato() ?>" class="text-input" style="white: 300px">
                    </li>
                    
                    <li class="form-row text-input-row">
                        <label>Gordura</label>
                        <input type="text" name="gordura" value="<?php if(isset($alimentoSelecionado)) echo $alimentoSelecionado->getGordura() ?>" class="text-input" style="white: 300px">
                    </li>      
                    
                    <li class="form-row text-input-row">
                        <label>Quantidade</label>
                        <input type="text" name="qtdAlimento" value="<?php if(isset($alimentoSelecionado)) echo $alimentoSelecionado->getQtdAlimento() ?>" class="text-input" style="white: 300px">
                    </li>
                    
                    <li class="button-row" style="margin-top: 50px">
                        <input type="hidden" name="idAlimento" value="<?php echo $_POST['idAlimento'] ?>">
                        <input type="submit" name="submit" value="Confirmar" class="btn-submit">
                    </li>                    
                </ol>
            </fieldset>
        </form>
    </div>

     <?php }  
     else
     {
          $alimento = new Alimento($_POST['idAlimento'], 
                             $_POST['descricao'], 
                             $_POST['caloria'],
                             $_POST['proteina'],
                             $_POST['carboidrato'],
                             $_POST['gordura'], 
                             $_POST['qtdAlimento'],
                             $_SESSION['Nutricionista']);
    
             //$_SESSION['Nutricionista'] = $nutricionista; 
            // var_dump($_SESSION['Nutricionista']);

             try
             {
                $fachada->alterarAlimento($alimento);
                $mensagem = "Parabéns, o alimento foi alterado  com sucesso!";
                //unset($_SESSION['Nutricionista']);

             }
             catch(Exception $exc)
             {
                $mensagem = $exc->getMessage();
             }
     }
     
     }
     
}

 if( isset($_POST['submit']) && $_POST['submit']=="Confirmar")  { ?>
    
        <h3>Mensagem</h3>
        <p><?php echo $mensagem ?></p>
    
    <?php } 
    
include('componentes/footerOne.php') ?>