<?php
$camposPreenchidos = false;
$fachada = Fachada::getInstance();
$mensagem = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $camposPreenchidos = true;
    
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
                        <input type="text" name="titulo" value="<?php if(isset($dica)) echo $dica->getTitulo() ?>" class="text-input" style="white: 300px">
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

    if(isset($_SESSION['Nutricionista'])){
        
        $_SESSION['Nutricionista'] = $pessoa; 
        var_dump($_SESSION['Nutricionista']);
        
        try{
            $fachada->inserirDica($dica);
            $mensagem = "Parabéns, a dica foi inserido com sucesso!";
            unset($_SESSION['Nutricionista']);

        }catch(Exception $exc){
                $mensagem = $exc->getMessage();
        }
        
    }else if (isset($_SESSION['Instrutor'])) {
        
        $_SESSION['Instrutor'] = $pessoa; 
        var_dump($_SESSION['Instrutor']);
        
        try{
            $fachada->inserirDica($dica);
            $mensagem = "Parabéns, a dica foi inserido com sucesso!";
            unset($_SESSION['Instrutor']);

        }catch(Exception $exc){
                $mensagem = $exc->getMessage();
        }
    }                
    
}
?>