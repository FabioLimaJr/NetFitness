<?php

$camposPreenchidos = false;
$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $camposPreenchidos = true;
}

try {
    
    $listaAlimento = $fachada->listarAlimento($_SESSION['Nutricionista']);
    
} catch (Exception $exc) {

    echo $exc->getMessage();
    
}
?>

<h1 class="title">Excluir Alimento</h1>

<div class="line"></div>
Telefone:<?php echo $nutricionista->getTelefone() ?> | Email:<?php echo $nutricionista->getEmail() ?> | Endereço:<?php echo $nutricionista->getEndereco() ?>
<div class="intro" style="margin-bottom:50px"></div>

<h3>Usuario Logado: <?php echo $nutricionista->getNome() ?></h3>

<div class="clean"></div>
<div class="line"></div>

<?php 
if(!$camposPreenchidos){
    
?>

<div style="margin-bottom: 50px"></div>

<div class="form-container" style="margin-bottom: 50px"></div>

<form class="forms" action="excluirAlimento.php" method="POST">
    <fieldset>
        <ol>
            <li class="form-row text-input-row">
                <label>Alimentos</label>
                <table style="width: 100%">
                    <tr>
                        <th>Descrição</th>
                        <th>Caloria</th>
                        <th>Proteina</th>
                        <th>Carboidrato</th>
                        <th>Gordura</th>
                    </tr>
                    
                    <?php foreach ($listaAlimento as $alimento){ ?>
                    <tr>
                        <td><?php echo $alimento->getDescricao();?></td>
                        <td><?php echo $alimento->getCaloria();?></td>
                        <td><?php echo $alimento->getProteina();?></td>
                        <td><?php echo $alimento->getCarboidrato();?></td>
                        <td><?php echo $alimento->getGordura();?></td>
                        <td><input type="radio" name="idAlimento" value="<?php echo $alimento->getIdAlimento()?>"></td>                        
                    </tr>
                    <input type="hidden" name="nomeNutricionista<?php echo $alimento->getIdAlimento() ?>" value="<?php echo $alimento->getNutricionista()->getNome() ?>">
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
    
        $alimento = new Alimento($_POST['idAlimento']);
         $fachada->excluirAlimento($alimento);
         $mensagem = "O Alimento do Nutricionista ".$_POST['nomeNutricionista'.$alimento->getIdAlimento()]." foi excluida com sucesso.";
        
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