<?php

$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";
$listaNoticiasRetornadas = array();
$listaNoticias;

try {
    
    $listaSecretarias = $fachada->listarSecretarias(LAZY);
   
    
} catch (Exception $exc) {
    echo $exc->getMessage();
}

foreach ($listaSecretarias as $secretaria){
                
$liastaNoticias = $fachada->listarNoticia($secretaria, LAZY);
$listaNoticiasRetornadas = array_merge($listaNoticiasRetornadas, $liastaNoticias); 
 }        

?>

<h1 class="title">Visualizar Noticias</h1>
    <div class="line"></div>
    Telefone:<?php echo $secretaria->getTelefone() ?> | Email:<?php echo $secretaria->getEmail() ?> | Endereço:<?php echo $secretaria->getEndereco() ?>
    <div class="intro" style="margin-bottom:50px"></div>

<h3>Usuário logado: <?php echo $secretaria->getNome() ?></h3>
   
    <div class="clear"></div>
    <div class="line"></div>

    <div style="margin-bottom: 50px">
        <table style="width: 100%">
            <tr>
               <th>Titulo</th>
               <th>Descrição</th> 
            </tr>
            
           <?php foreach ($listaNoticiasRetornadas as $noticiaRetornada){  ?>
            <tr>
                <td><?php echo $noticiaRetornada->getTitulo() ?></td>
                <td><?php echo $noticiaRetornada->getDescricao() ?></td> 
            </tr>
            
           <?php } ?>
            
           
            
        </table>
    </div>
    
 <?php include('componentes/footerOne.php');