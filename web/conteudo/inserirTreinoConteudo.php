<?php 
    
    $camposPreenchidos = false;
    $fachada = Fachada::getInstance();
    $mensagem = "";
    //unset($_SESSION['Treino']);
    
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $camposPreenchidos = true;
    }
    if(isset($_SESSION['Treino']))
    {
        $treino = $_SESSION['Treino'];
    }
    
    $listaExercicios = $fachada->listarExercicios();
    
?>

<h1 class="title">Página usuário</h1>
<div class="line"></div>

Nome: <?php echo $instrutor->getNome() ?> | Telefone:<?php echo $instrutor->getTelefone() ?> | Email:<?php echo $instrutor->getEmail() ?> | Endereço:<?php echo $instrutor->getEndereco() ?>
    
<div class="intro" style="margin-bottom:50px"></div>

<h3>Inserir Treino</h3>

<div class="clear"></div>
<div class="line"></div>

<?php 
    
    if(!$camposPreenchidos){
        
?>

<div class="form-container" style="margin-bottom:50px">
    <form class="forms" action="inserirTreino.php" method="post" >
          <fieldset>
              <ol>
                  <li class="form-row text-input-row">
                        <label>Nome</label>
                        <input type="text" name="nome" value="<?php if(isset($treino)) echo $treino->getNome() ?>" class="text-input" style="width: 300px">
                  </li>
                  <li class="form-row text-input-row">
                        <label>Descrição</label>
                        <input type="text" name="descricao" value="<?php if(isset($treino)) echo $treino->getNome() ?>" class="text-input" style="width: 300px">
                  </li>
                  
                  <li class="form-row text-input-row">
                  <label>Exercícios</label>   
                  <table style="width:500px; margin-left:100px">
                    <tr>
                      <th>Nome</th> 
                      <th>Músculo</th>
                      <th>Series</th>
                      <th>Repetições</th>
                      <th>Selecione</th>
                    </tr>
                      
                    <?php foreach ($listaExercicios as $exercicio) { ?>
                         <tr>
                             <td> <?php echo $exercicio->getNome() ?> </td>
                             <td> <?php echo $exercicio->getMusculo() ?> </td>
                             <td> <input type="text" name="serie<?php echo $exercicio->getIdExercicio() ?>" value="<?php if(isset($treino)) echo $treino->getSerie() ?>" class="text-input" style="width: 30px"> </td>
                             <td> <input type="text" name="repeticoes<?php echo $exercicio->getIdExercicio() ?>" value="<?php if(isset($treino)) echo $treino->getRepeticoes() ?>" class="text-input" style="width: 30px"> </td>
                             <td> <input type="checkbox" name="exercicio<?php echo $exercicio->getIdExercicio() ?>" value="true" style="width: 30px"> </td>
                         </tr>
                         
                      <?php } ?>
                         
                   </table>
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

    }else{
        
        /* 
         * falta o trecho para pegar os exercicios selecionados
         */
        
        $treino = new Treino();
        $treino->setIdTreino(NULL);
        $treino->setNome($_POST['nome']);
        $treino->setDescricao($_POST['descricao']);
        $treino->setInstrutor($instrutor);
        $treino->setListaExercicios($listaExerciciosSelecionados);
        
        //$_SESSION['Treino'] = $treino;
        try{
            
            $fachada->inserirTreino($treino);
            unset($_SESSION['Dieta']);
            $mensagem = "O treino foi inserido com sucesso!!";
            
        } catch (Exception $ex) {

            $mensagem = $ex->getMessage();
        }
    }
    
    if($camposPreenchidos){
        
?>

<h3>Mensagem</h3>
<p><?php echo $mensagem ?></p>
<?php 

    } 
    include('componentes/footerOne.php') 
?>

       