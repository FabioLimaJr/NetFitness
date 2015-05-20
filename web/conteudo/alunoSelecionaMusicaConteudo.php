<?php 
$camposPreenchidos = false;
$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";
$listaMusicas = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $camposPreenchidos = true;
}

try
{
    $listaMusicas = $fachada->listarMusicas(EAGER);
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
    
?>

<h1 class="title">Aluno Seleciona Musica</h1>
<div class="line"></div>
    
Telefone:<?php echo $aluno->getTelefone() ?> | Email:<?php echo $aluno->getEmail() ?> | Endereço:<?php echo $aluno->getEndereco() ?>

<div class="intro" style="margin-bottom:50px"></div>
    
    
    
<h3>Usuário logado: <?php echo $aluno->getNome() ?></h3>
   
   
<div class="clear"></div>
<div class="line"></div>

<?php 
if(!$camposPreenchidos){
    
?>

<div style="margin-bottom: 50px">
    <div class="form-container" style="margin-bottom:50px">
      <form class="forms" action="alunoSelecionaMusica.php" method="post" >
      <fieldset>      
       <ol>
    <table style="width: 100%">
            <tr>
               <th>Titulo</th>
               <th>Categoria</th>
               <th>Artista</th>
               <th>Selecione</th>
            </tr>
            
            <?php foreach ($listaMusicas as $musica){ ?>
                    <tr>
                        <td><?php echo $musica->getTitulo() ?></td>
                        <td><?php echo $musica->getCategoria() ?></td>
                        <td><?php echo $musica->getArtista() ?></td>
                        <td><input type="radio" name="idMusica" value="<?php echo $musica->getIdMusica()?>"></td>
                    </tr>
                  
            <?php } ?>  
            
    </table>
       </ol>
          <li class="button-row" style="margin-top: 50px;margin-left: -100px;text-align: center">
              <input type="submit" value="Selecionar" name="submit" class="btn-submit">
          </li>
      </fieldset>
      </form>
    
</div>
<?php }else {
        try {
            $musicaSelecionada = new Musica($_POST['idMusica']);
            $_SESSION['Aluno']->setMusica($musicaSelecionada);
            $fachada->alterarAluno($aluno);

            $mensagem = "Musica Selecionada com sucesso.";
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
