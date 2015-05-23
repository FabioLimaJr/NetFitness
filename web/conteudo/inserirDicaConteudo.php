<?php
$camposPreenchidos = false;
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
<h1 class="title">Pagina Usuário</h1>

<div class="line"></div>

Nome: <?php echo $pessoa->getNome() ?> | Telefone:<?php echo $pessoa->getTelefone() ?> | Email:<?php echo $pessoa->getEmail() ?>

<div class="intro" style="margin-bottom: 50px">
    
    
</div>

<h3>Inserir Dica</h3>

<div class="clear"></div>
<div class="line"></div>

<?php 

if(!$camposPreenchidos){

?>
    <div class="form-container" style="margin-bottom: 50px">
        <form class="forms" action="inserirDica.php" method="POST">
            <fieldset>
                <ol>
                    <li class="form-row text-input-row">
                        <label>Titulo</label>
                        <input type="text" name="titulo" value="<?php if(isset($dica)) echo $dica->getTitulo() ?>" class="text-input" style="width: 300px">
                    </li>
                    
                    <li class="form-row text-input-row">
                        <label>Descrição</label>
                        <textarea class="text-input" name="descricao" value="<?php if(isset($dica)) echo $dica->getDescricao() ?>" style="width:500px; height: 100px"></textarea>
                    </li>
                    
                    <li class="button-row" style="margin-top: 50px">                        
                        <input type="submit" name="submit" value="Inserir" class="btn-submit">
                    </li>                    
                </ol>
            </fieldset>
        </form>
    </div>

<?php
}else{
    $dica = new Dica(NULL, 
                    $_POST['descricao'], 
                    $_POST['titulo']);

    if($_SESSION['tipoUsuario'] == "Nutricionista"){
        
        $_SESSION['Nutricionista'] = $pessoa; 
        try{
            $fachada->inserirDica($dica, $pessoa);
            $mensagem = "Parabéns, a dica foi inserida com sucesso!";
            unset($_SESSION['Nutricionista']);

        }catch(Exception $exc){
                $mensagem = $exc->getMessage();
        }
        
    }else if ($_SESSION['tipoUsuario'] == "Instrutor") {
        
        $_SESSION['Instrutor'] = $pessoa; 
        try{
            $fachada->inserirDica($dica, $pessoa);
            $mensagem = "Parabéns, a dica foi inserida com sucesso!";
            unset($_SESSION['Instrutor']);

        }catch(Exception $exc){
                $mensagem = $exc->getMessage();
        }
    }                
    
}
?>
    <h3>Mensagem</h3>
    <p><?php echo $mensagem ?></p>
    <?php include('componentes/footerOne.php') ?>