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
    
    $listaTreinos = $fachada->listarTreinos($instrutor, EAGER);
    $listaAlunos = $fachada->listarAlunos(LAZY);
    
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
      <form class="forms" action="vincularTreinoAlunos.php" method="post" >
      <fieldset>
      
       <ol>
            <li class="form-row text-input-row">     
               <table style="width:100%;margin-bottom:50px">
                         <tr>
                           <th>Nome</th> 
                           <th>Descrição</th>
                           <th>Exercicio</th>
                           <th>Selecionar</th>
                         </tr>

                         <?php foreach ($listaTreinos as $treino){ ?>
                         <tr>
                             <td><?php echo $treino->getNome() ?></td> 
                             <td><?php echo $treino->getDescricao() ?></td>  
                             <td>
                                 Falta lista de Exercicios
                             </td>  
                             <td><input type="radio" name="idTreino" value="<?php echo $treino->getIdTreino() ?>"></td>
                         </tr>

                         <?php 
                         
                    
                         } ?>

               </table>
             </li>

             <li class="form-row text-input-row" style="text-align:center;margin-left:-100px">
                    <input type="submit" value="Selecionar Alunos" name="submit" class="btn-submit">
                    <input type="hidden" name="">
             </li>       
        </ol>  
       </fieldset>
       </form>
    </div>

    <?php }else{
        
        if(isset($_POST['idTreino'])){
            
            $treino = new Treino($_POST['idTreino']);
            $treinoRetornado = $fachada->detalharTreino($treino, EAGER);
            
            $_SESSION['treinoRetornado']=$treinoRetornado;
            
            ?>
            
            <div class="form-container" style="margin-bottom:50px">
                <form class="forms" action="vincularTreinoAlunos.php" method="post" >
                      <fieldset>
                          <ol>
                              <li class="form-row text-input-row">
                                    <label>Data do Treino</label>
                                    <input type="text" id="dataPicked" maxlength="10" name="data" value="" class="text-input" style="width: 300px">
                              </li>

                              <li class="form-row text-input-row">
                              <label>Alunos</label>   
                              <table style="width:500px; margin-left:100px">
                                <tr>
                                  <th>Nome</th> 
                                  <th>Selecione</th>
                                </tr>

                                <?php foreach ($listaAlunos as $aluno) { ?>
                                     <tr>
                                         <td> <?php echo $aluno->getNome() ?> </td>
                                         <td> <input type="checkbox" name="aluno<?php echo $aluno->getIdAluno() ?>" value="true" style="width: 30px"> </td>
                                     </tr>

                                  <?php } ?>

                               </table>
                               </li>

                               <li class="button-row" style="margin-top:50px">
                                   <input type="submit" value="Vincular Alunos" name="submit" class="btn-submit">
                               </li>
                        </ol>
                    </fieldset>
                </form>
            <div class="response"></div>
        </div>

        <?php 
         }else{
             
             if($_POST['submit']=='Vincular Alunos'){
                 
                 $alunosSelecionados = array();
                 
                 foreach(array_keys($_POST) as $parametro){
                     
                    if(strpos($parametro,'aluno') !== false)
                    {
                        $idAluno = explode("aluno", $parametro);

                        foreach($listaAlunos as $aluno) 
                        {
                             if ($idAluno[1] == $aluno->getIdAluno()) 
                             {
                                 array_push($alunosSelecionados, $aluno);
                                 break;
                             }
                        }
                    }
                }
                
                try{
                    
                    $treinoRetornado = $_SESSION['treinoRetornado'];
                    $treinoRetornado->setData($_POST['data']);
                    
                    $fachada->vincularTreinoAlunos($treinoRetornado, $alunosSelecionados);
                    $mensagem = "Treino vinculado aos alunos com sucesso!!";
                } catch (Exception $ex) {
                    $mensagem = $ex->getMessage();
                }
        }else{
            $mensagem = "Não foi selecionado o treino!!";
        }
    }
}

if($camposPreenchidos && !isset($_POST['idTreino'])){
    
    ?>

    <h3>Mensagem</h3>
    <p><?php echo $mensagem ?></p>
    <?php 
    
        } 
    include('componentes/footerOne.php') 
    ?>