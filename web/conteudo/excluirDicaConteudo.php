<?php

$camposPreenchidos = false;
//$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $camposPreenchidos = true;
}

try {
    
    $pessoa="";
    if($_SESSION['tipoUsuario'] == "Nutricionista")
    {
         $pessoa = $_SESSION['Nutricionista'];
         $listaDicas = $fachada->listarDicas($_SESSION['Nutricionista']);
         $_SESSION['listaDicas'] = $listaDicas;   
    }
    else if(($_SESSION['tipoUsuario'] == "Instrutor"))
    {
         $pessoa = $_SESSION['Instrutor'];
         $listaDicas = $fachada->listarDicas($_SESSION['Instrutor']);
         $_SESSION['listaDicas'] = $listaDicas;
    }
    
} catch (Exception $exc) {
    echo $exc->getMessage();
}


?>

<h1 class="title">Excluir Dica</h1>

<div class="line"></div>
Telefone:<?php echo $pessoa->getTelefone() ?> | Email:<?php echo $pessoa->getEmail() ?> | Endereço:<?php echo $pessoa->getEndereco() ?>
<div class="intro" style="margin-bottom:50px"></div>

<h3>Usuário logado: <?php echo $pessoa->getNome() ?></h3>
   
<div class="clear"></div>
<div class="line"></div>

<?php 
if(!$camposPreenchidos){
    
?>

<div style="margin-bottom: 50px"></div>

<div class="form-container" style="margin-bottom: 50px"></div>

<form class="forms" action="excluirDica.php" method="POST">
    <fieldset>
        <ol>
            <li class="form-row text-input-row">
                <label>Dicas</label>
                <table style="width: 100%">
                    <tr>
                        <th>Titulo</th>
                        <th>Descrição</th>
                        <th>Selecione</th>
                    </tr>
                    
                    <?php foreach ($listaDicas as $dica){ ?>
                    <tr>
                        <td><?php echo $dica->getTitulo();?></td>
                        <td><?php echo $dica->getDescricao();?></td>
                        <td><input type="radio" name="idDica" value="<?php echo $dica->getIdDica()?>"></td>                        
                    </tr>
                    <?php } ?>
                </table>
            </li>
            
            <li class="button-row" style="margin-top: 50px;margin-left: -100px;text-align: center">
                <input type="submit" value="Excluir" name="submit" class="btn-submit">
            </li>
        </ol>
    </fieldset>
</form>

<?php }  else {
    
    try {
    
        $dica = new Dica($_POST['idDica']);
         $fachada->excluirDica($dica);
         $mensagem = "A Dica foi excluida com sucesso.";
        
     } catch (Exception $exc) {
         echo $exc->getMessage();
     }
}
if($mensagem != ""){
?>
        <h3>Mensagem</h3>
        <p><?php echo $mensagem ?></p>
    
    <?php 
}    
include('componentes/footerOne.php') ?>