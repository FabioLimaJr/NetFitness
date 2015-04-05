<?php 

    $camposPreenchidos = false;
    $fachada = new Fachada();
    $fachada = Fachada::getInstance();
    $mensagem ="";


    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $camposPreenchidos = true;
    }

    try
    {
        $listaExercicios = $fachada->listarExercicios();

    } 
    catch (Exception $exc)
    {
        $mensagem = $exc->getMessage();
    }   
  
?>

<h1 class="title">Excluir Exercício</h1>
<div class="line"></div>
Telefone:<?php echo $instrutor->getTelefone() ?> | Email:<?php echo $instrutor->getEmail() ?> | Endereço:<?php echo $instrutor->getEndereco() ?>
<div class="intro" style="margin-bottom:50px"></div>

<h3>Usuário logado: <?php echo $instrutor->getNome() ?></h3>

<div class="clear"></div>
<div class="line"></div>

<?php if(!$camposPreenchidos){ 
    
?>

<div class="form-container" style="margin-bottom:50px">
    <form class="forms" action="excluirExercicio.php" method="post" >
        <fieldset>
      
            <ol>
                <li class="form-row text-input-row">     
                    <table style="width:100%;margin-bottom:50px">
                        <tr>
                            <th>Nome Exercicio</th> 
                            <th>Músculo</th>
                            <th>Descrição</th>
                            <th>Selecionar</th>
                        </tr>
                        
                        <?php foreach ($listaExercicios as $exercicio){ ?>
                        
                        <tr>
                            <td><?php echo $exercicio->getNome() ?></td> 
                            <td><?php echo $exercicio->getMusculo() ?></td>  
                            <td><?php echo $exercicio->getDescricao() ?></td>  
                            <td><input type="radio" name="idExercicio" value="<?php echo $exercicio->getIdExercicio() ?>"></td>
                        </tr>
                        <?php 
                            } 
                        ?>

                    </table>
                  </li>

                  <li class="form-row text-input-row" style="text-align:center;margin-left:-100px">
                         <input type="submit" value="Excluir" name="submit" class="btn-submit">
                         <input type="hidden" name="">
                  </li>       
            </ol>  
        </fieldset>
    </form>
</div>

<?php 
    }else{
        try{
            
            $exercicioExc = new Exercicio($_POST['idExercicio']);
            $fachada->excluirExercicio($exercicioExc);
            $mensagem = "O exercício foi excluído com sucesso!!";
        } catch (Exception $ex) {

            $mensagem = $ex->getMessage();
        }
?>

<h3>Mensagem</h3>
<p><?php echo $mensagem ?></p>

<?php     
    } 
    
    include('componentes/footerOne.php') 
?>