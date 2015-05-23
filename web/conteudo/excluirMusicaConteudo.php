<?php

$camposPreenchidos = false;
//$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $camposPreenchidos = true;
}

try {
    
    $listaMusica = $fachada->listarMusicas(EAGER);
    
} catch (Exception $exc) {

    echo $exc->getMessage();
    
}
?>

<h1 class="title">Excluir Musica</h1>

<div class="line"></div>
Telefone:<?php echo $secretaria->getTelefone() ?> | Email:<?php echo $secretaria->getEmail() ?> | Endereço:<?php echo $secretaria->getEndereco() ?>
<div class="intro" style="margin-bottom:50px"></div>

<h3>Usuario Logado: <?php echo $secretaria->getNome() ?></h3>

<div class="clean"></div>
<div class="line"></div>

<?php 
if(!$camposPreenchidos){
    
?>

<div style="margin-bottom: 50px"></div>

<div class="form-container" style="margin-bottom: 50px"></div>

<form class="forms" action="excluirMusica.php" method="POST">
    <fieldset>
        <ol>
            <li class="form-row text-input-row">
                <table style="width: 100%">
                    <tr>
                        <th>Titulo</th>
                        <th>Categoria</th>
                        <th>Artista</th>
                        <th>Selecione</th>
                    </tr>
                    
                    <?php foreach ($listaMusica as $musica){ ?>
                    <tr>
                         <td><?php echo $musica->getTitulo();?></td>  
                         <td><?php echo $musica->getCategoria();?></td>  
                         <td><?php echo $musica->getArtista();?></td>  
                        <td><input type="radio" name="idMusica" value="<?php echo $musica->getIdMusica()?>"></td>                        
                    </tr>
                    <input type="hidden" name="nomeSecretaria<?php echo $musica->getIdMusica() ?>" value="<?php echo $musica->getSecretaria()->getNome() ?>">
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
    
        $musica = new Musica($_POST['idMusica']);
         $fachada->excluirMusica($musica);
         $mensagem = "A Música foi excluida com sucesso.";
        
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