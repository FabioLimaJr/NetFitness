<?php

//$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";
$camposPreenchidos = false;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $camposPreenchidos = true;
}

try
{
        $listaExameFisico = $fachada-> listarExamesFisicos($_SESSION['Instrutor'], EAGER);


} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}
?>

<h1 class="title">Alterar Exames Físicos</h1>
<div class="line"></div>
Telefone:<?php echo $instrutor->getTelefone() ?> | Email:<?php echo $instrutor->getEmail() ?> | Endereço:<?php echo $instrutor->getEndereco() ?>
<div class="intro" style="margin-bottom:50px"></div>

<h3>Usuário logado: <?php echo $instrutor->getNome() ?></h3>
<div class="clear"></div>
<div class="line"></div>

<?php 
     if(!$camposPreenchidos){ 
?>
<div class="form-container" style="margin-bottom:50px">
    <form class="forms" action="alterarExameFisico.php" method="post" >
        <fieldset>
      
            <ol>
                <li class="form-row text-input-row">     
                    <table style="width:100%;margin-bottom:50px">
                        <tr>
                            <td>Aluno</th>
                            <th>Descrição</th> 
                            <th>Data</th>
                            <th>Selecionar</th>
                        </tr>
                        
                        <?php foreach ($listaExameFisico as $exameFisico){ ?>
                        
                        <tr>
                            <td><?php echo $exameFisico->getAluno()->getNome() ?></td> 
                            <td><?php echo $exameFisico->getDescricao() ?></td>  
                            <td><?php echo ExpressoesRegulares::inverterData($exameFisico->getData()) ?></td> 
                            <td><input type="radio" name="idExameFisico" value="<?php echo $exameFisico->getIdExameFisico() ?>"></td>
                        </tr>
                        <?php 
                            } 
                        ?>

                    </table>
                  </li>

                  <li class="form-row text-input-row" style="text-align:center;margin-left:-100px">
                         <input type="submit" value="Alterar" name="submit" class="btn-submit">
                         <input type="hidden" name="">
                  </li>       
            </ol>  
        </fieldset>
    </form>
</div>

<?php 
     }else{
         
         if(isset($_POST['idExameFisico'])){
             
             $exameFisico = new ExameFisico($_POST['idExameFisico']);
             $exameFisicoRetornado = $fachada->detalharExameFisico($exameFisico, EAGER);
             
             $_SESSION['exameFisicoRetornado'] = $exameFisicoRetornado;

?>

    <div class="form-container" style="margin-bottom:50px">
        <form class="forms" action="alterarExameFisico.php" method="post" >
            <fieldset>
                <ol>

                    <li class="form-row text-input-row">
                        <label>Aluno</label>
                        <input type="text" name="aluno"  readonly value="<?php if(isset($exameFisicoRetornado)) echo $exameFisicoRetornado->getAluno()->getNome() ?>" class="text-input" style="width: 300px">
                    </li>
                    <li class="form-row text-input-row">
                        <label>Data</label>
                        <input type="text" name="data"  readonly value="<?php if(isset($exameFisicoRetornado)) echo $exameFisicoRetornado->getData() ?>" class="text-input" style="width: 300px">
                    </li>
                    <li class="form-row text-input-row">
                        <label>Descrição</label>
                        <input type="text" name="descricao" value="<?php if(isset($exameFisicoRetornado)) echo $exameFisicoRetornado->getDescricao() ?>" class="text-input" style="width: 300px">
                    </li>
                     <li class="form-row text-input-row">
                        <label>Altura</label>
                        <input type="text" name="altura" value="<?php if(isset($exameFisicoRetornado)) echo $exameFisicoRetornado->getAltura() ?>" class="text-input" style="width: 300px">
                    </li>
                     <li class="form-row text-input-row">
                        <label>Peso</label>
                        <input type="text" name="peso" value="<?php if(isset($exameFisicoRetornado)) echo $exameFisicoRetornado->getPeso() ?>" class="text-input" style="width: 300px">
                    </li>
                <h3 class="title">Circunferências</h1>

                    <li class="form-row text-input-row">
                        <label>Torax</label>
                        <input type="text" name="circTorax" value="<?php if(isset($exameFisicoRetornado)) echo $exameFisicoRetornado->getCircTorax() ?>" class="text-input" style="width: 300px">
                    </li>
                    <li class="form-row text-input-row">
                        <label>Abdomen</label>
                        <input type="text" name="circAbdomen" value="<?php if(isset($exameFisicoRetornado)) echo $exameFisicoRetornado->getCircAbdomen() ?>" class="text-input" style="width: 300px">
                    </li>
                     <li class="form-row text-input-row">
                        <label>Braço</label>
                        <input type="text" name="circBraco" value="<?php if(isset($exameFisicoRetornado)) echo $exameFisicoRetornado->getCircBraco() ?>" class="text-input" style="width: 300px">
                    </li>
                     <li class="form-row text-input-row">
                        <label>Antebraço</label>
                        <input type="text" name="circAntebraco" value="<?php if(isset($exameFisicoRetornado)) echo $exameFisicoRetornado->getCircAntebraco() ?>" class="text-input" style="width: 300px">
                    </li>
                     <li class="form-row text-input-row">
                        <label>Coxa</label>
                        <input type="text" name="circCoxa" value="<?php if(isset($exameFisicoRetornado)) echo $exameFisicoRetornado->getCircCoxa() ?>" class="text-input" style="width: 300px">
                    </li>
                     <li class="form-row text-input-row">
                        <label>Panturrilha</label>
                        <input type="text" name="circPanturrilha" value="<?php if(isset($exameFisicoRetornado)) echo $exameFisicoRetornado->getCircPanturrilha() ?>" class="text-input" style="width: 300px">
                    </li>
                                                 
                    <li class="button-row" style="margin-top:50px">
                        <input type="submit" value="Salvar Alterações" name="submit" class="btn-submit">
                    </li>
               </ol>

            </fieldset>
        </form>
        <div class="response"></div>
    </div>
    
    <?php 
         }else{
             
             if($_POST['submit'] == 'Salvar Alterações'){
                 
             $exameFisicoAlterado = new ExameFisico($_SESSION['exameFisicoRetornado']->getIdExameFisico(), $_POST['aluno'], 
                                                    $_POST['descricao'], $_POST['altura'], $POST['peso'], 
                                                    $POST['circTorax'], $POST['circAbdomen'], $POST['circBraco'], 
                                                    $POST['circAntebraco'], $POST['circCoxa'], 
                                                    $POST['circPanturrilha']);
             
             try{
                 
                 $fachada->alterarExameFisico($exameFisicoAlterado);
                 $mensagem = "O exame físico foi alterado com sucesso!!";
                 
             } catch (Exception $ex) {
                 
                 $mensagem = $ex->getMessage();
                 
             }
        }else{
    
            $mensagem = "Não foi selecionado o exame físico";
        }
      }
    }
    
    if($camposPreenchidos && !isset($_POST['idExameFisico']) || isset($ameFisicoAlterado)){
?>
    
    <h3>Mensagem</h3>
    <p><?php echo $mensagem ?></p>
    
    <?php } 
    
    include('componentes/footerOne.php') ?>