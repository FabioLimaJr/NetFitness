<?php
    $camposPreenchidos = false;
    $fachada = Fachada::getInstance();
    $mensagem = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $camposPreenchidos = true;
    }
    if(isset($_SESSION['Instrutor']))
    {
        $instrutor = $_SESSION['Instrutor'];
    }
?>

<h1 class="title">Página usuário</h1>
    <div class="line"></div>
        Nome: <?php echo $instrutor->getNome() ?> | Telefone:<?php echo $instrutor->getTelefone() ?> | Email:<?php echo $instrutor->getEmail() ?>
     
    <div class="intro" style="margin-bottom:50px">
         
    </div>
        
    <h3>Inserir Exercicio</h3>
    
    <div class="clear"></div>
    <div class="line"></div>
    
    <div class="form-container" style="margin-bottom:50px">
        <form class="forms" action="inserirExercicioRespostaConteudo.php" method="post" >
            <fieldset>
                <ol>

                    <li class="form-row text-input-row">
                        <label>Nome</label>
                        <input type="text" name="nome" value="" class="text-input" style="width: 300px">
                    </li>

                    <li class="form-row text-input-row">
                        <label>Músculo</label>
                        <input type="text" name="musculo" value="" class="text-input" style="width: 300px">
                    </li>

                    <li class="form-row text-input-row">
                        <label>Descrição</label>
                        <input type="text" name="descricao" value="" class="text-input" style="width: 300px">
                    </li>

                    <li class="button-row" style="margin-top:50px">
                        <input type="submit" value="Inserir" name="submit" class="btn-submit">
                    </li>
               </ol>

            </fieldset>
        </form>
        <div class="response"></div>
    </div>