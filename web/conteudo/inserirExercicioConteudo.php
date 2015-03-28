<?php
    $camposPreenchidos = false;
    $fachada = Fachada::getInstance();
    $mensagem = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $camposPreenchidos = true;
    }
    if(isset($_SESSION['Exercicio']))
    {
        $exercicio = $_SESSION['Exercicio'];
    }
?>

<h1 class="title">Página usuário</h1>
    <div class="line"></div>
        Nome: <?php echo $instrutor->getNome() ?> | Telefone:<?php echo $instrutor->getTelefone() ?> | Email:<?php echo $instrutor->getEmail() ?>
     
    <div class="intro" style="margin-bottom:50px">
         
    </div>
        
    <h3>Inserir Exercício</h3>
    
    <div class="clear"></div>
    <div class="line"></div>
    
    <?php 
   
    if(!$camposPreenchidos)
    {   
        ?>
    <div class="form-container" style="margin-bottom:50px">
        <form class="forms" action="inserirExercicio.php" method="post" >
            <fieldset>
                <ol>

                    <li class="form-row text-input-row">
                        <label>Nome</label>
                        <input type="text" name="nome" value="<?php if(isset($exercicio)) echo $exercicio->getNome() ?>" class="text-input" style="width: 300px">
                    </li>

                    <li class="form-row text-input-row">
                        <label>Músculo</label>
                        <input type="text" name="musculo" value="<?php if(isset($exercicio)) echo $exercicio->getMusculo() ?>" class="text-input" style="width: 300px">
                    </li>

                    <li class="form-row text-input-row">
                        <label>Descrição</label>
                        <input type="text" name="descricao" value="<?php if(isset($exercicio)) echo $exercicio->getDescricao() ?>" class="text-input" style="width: 300px">
                    </li>

                    <li class="button-row" style="margin-top:50px">
                        <input type="submit" value="Inserir" name="submit" class="btn-submit">
                    </li>
               </ol>

            </fieldset>
        </form>
        <div class="response"></div>
    </div>
    <?php
    }else {
    
        $exercicio = new Exercicio(NULL, $_POST['nome'], $_POST['musculo'], $_POST['descricao']);
        $_SESSION['Exercicio'] = $exercicio;
        
        try {
            
            $fachada->inserirExercicio($exercicio);
            $mensagem = "Parabéns, o exercicio ".$_POST['nome']." foi inserido com sucesso!";
            unset($_SESSION['Exercicio']);
            
        } catch (Exception $exc) {
            
            $mensagem = $exc->getMessage();
            
        }

    }
    
    ?>
    
    <h3>Mensagem</h3>
    <p><?php echo $mensagem ?></p>
    
    <?php include('componentes/footerOne.php') ?>