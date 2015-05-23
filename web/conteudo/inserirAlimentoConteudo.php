<?php
$camposPreenchidos = false;
$fachada = Fachada::getInstance();
$mensagem = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $camposPreenchidos = true;
    
}

if(isset($_SESSION['Alimento'])){

    $alimento = $_SESSION['Alimento'];
    
}
?>

<h1 class="title">Pagina Usuário</h1>

<div class="line"></div>

Nome: <?php echo $nutricionista->getNome() ?> | Telefone:<?php echo $nutricionista->getTelefone() ?> | Email:<?php echo $nutricionista->getEmail() ?>

<div class="intro" style="margin-bottom: 50px">
    
    
</div>

<h3>Inserir Alimento</h3>

<div class="clear"></div>
<div class="line"></div>

<?php 

if(!$camposPreenchidos){

?>
    <div class="form-container" style="margin-bottom: 50px">
        <form class="forms" action="inserirAlimento.php" method="POST">
            <fieldset>
                <ol>
                    <li class="form-row text-input-row">
                        <label>Descrição</label>
                        <textarea class="text-input" name="descricao" value="<?php if(isset($alimento)) echo $alimento->getDescricao() ?>" style="width:500px; height: 100px"></textarea>
                    </li>
                    
                    <li class="form-row text-input-row">
                        <label>Caloria</label>
                        <input type="text" name="caloria" value="<?php if(isset($alimento)) echo $alimento->getCaloria() ?>" class="text-input" style="width: 300px">
                    </li>
                    
                    <li class="form-row text-input-row">
                        <label>Proteina</label>
                        <input type="text" name="proteina" value="<?php if(isset($alimento)) echo $alimento->getProteina() ?>" class="text-input" style="width: 300px">
                    </li>
                    
                    <li class="form-row text-input-row">
                        <label>Carboidrato</label>
                        <input type="text" name="carboidrato" value="<?php if(isset($alimento)) echo $alimento->getCarboidrato() ?>" class="text-input" style="width: 300px">
                    </li>
                    
                    <li class="form-row text-input-row">
                        <label>Gordura</label>
                        <input type="text" name="gordura" value="<?php if(isset($alimento)) echo $alimento->getGordura() ?>" class="text-input" style="width: 300px">
                    </li>
                    
                    <li class="form-row text-input-row">
                        <label>Quantidade</label>
                        <input type="text" name="qtdAlimento" value="<?php if(isset($alimento)) echo $alimento->getQtdAlimento() ?>" class="text-input" style="width: 300px">
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
    $alimento = new Alimento(NULL, 
                             $_POST['descricao'], 
                             $_POST['caloria'],
                             $_POST['proteina'],
                             $_POST['carboidrato'],
                             $_POST['gordura'],
                             $_POST['qtdAlimento'],
                             $nutricionista);
    
             $_SESSION['Nutricionista'] = $nutricionista; 

             try
             {
                $fachada->inserirAlimento($alimento);
                $mensagem = "Parabéns, o alimento foi inserido com sucesso!";
                unset($_SESSION['Nutricionista']);

             }
             catch(Exception $exc)
             {
                $mensagem = $exc->getMessage();
             }
}
?>
 <h3>Mensagem</h3>
    <p><?php echo $mensagem ?></p>

    
    
    <?php include('componentes/footerOne.php') ?>