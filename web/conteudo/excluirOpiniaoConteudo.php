<?php

$camposPreenchidos = false;
//$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $camposPreenchidos = true;
}

try {
    
    $listaOpinioes = $fachada->listarOpinioes($_SESSION['Aluno']);
    
} catch (Exception $exc) {

    echo $exc->getMessage();
    
}
?>

<h1 class="title">Excluir Opinião</h1>

<div class="line"></div>
Telefone:<?php echo $aluno->getTelefone() ?> | Email:<?php echo $aluno->getEmail() ?> | Endereço:<?php echo $aluno->getEndereco() ?>
<div style="float:right"><image height = "80" src="<?php echo IMAGE_PATH_ALUNOS."/".$aluno->getFoto() ?>"> </div>
<div class="intro" style="margin-bottom:50px"></div>

<h3>Usuario Logado: <?php echo $aluno->getNome() ?></h3>

<div class="clean"></div>
<div class="line"></div>

<?php 
if(!$camposPreenchidos){
    
?>

<div style="margin-bottom: 50px"></div>

<div class="form-container" style="margin-bottom: 50px"></div>

<form class="forms" action="excluirOpiniao.php" method="POST">
    <fieldset>
        <ol>
            <li class="form-row text-input-row">
                <label>Opiniões</label>
                <table style="width: 100%">
                    <tr>
                        <th>Descrição</th>
                        <th>Data Postagem</th>
                        <th>Selecione</th>
                    </tr>
                    
                    <?php foreach ($listaOpinioes as $opiniao){ ?>
                    <tr>
                        <td><?php echo $opiniao->getDescricao();?></td>
                        <td><?php echo $opiniao->getDataPostagem();?></td>                        
                        <td><input type="radio" name="idOpiniao" value="<?php echo $opiniao->getIdOpiniao()?>"></td>                        
                    </tr>
                    <input type="hidden" name="nomeAluno<?php echo $opiniao->getIdOpiniao() ?>" value="<?php echo $opiniao->getAluno()->getNome() ?>">
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
    
        $opiniao = new Opiniao($_POST['idOpiniao']);
         $fachada->excluirOpiniao($opiniao);
         $mensagem = "A Opinião do Aluno ".$_POST['nomeAluno'.$opiniao->getIdOpiniao()]." foi excluida com sucesso.";
        
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