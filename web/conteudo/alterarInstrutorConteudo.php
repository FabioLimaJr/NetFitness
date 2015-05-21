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
    $listaInstrutores = $fachada->listarInstrutores(LAZY);
    $_SESSION['listaInstrutores'] = $listaInstrutores;
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   

?>

<h1 class="title">Alterar Instrutor</h1>
    <div class="line"></div>
    
    Telefone:<?php echo $coordenador->getTelefone() ?> | Email:<?php echo $coordenador->getEmail() ?> | Endereço:<?php echo $coordenador->getEndereco() ?>

    <div class="intro" style="margin-bottom:50px"></div>
    
    <h3>Usuário logado: <?php echo $coordenador->getNome() ?></h3>
   
    <div class="clear"></div>
    <div class="line"></div>
    
<?php 
     if(!$camposPreenchidos) 
     { ?>

    <div class="form-container" style="margin-bottom:50px">
      <form class="forms" action="alterarInstrutor.php" method="post" >
      <fieldset>
      
       <ol>
            <li class="form-row text-input-row">     
               <table style="width:100%;margin-bottom:50px">
                         <tr>
                           <th>Nome</th> 
                           <th>CPF</th>
                           <th>Telefone</th>
                           <th>E-mail</th>
                           <th>Selecionar</th>
                         </tr>

                         <?php foreach ($listaInstrutores as $instrutor){ ?>
                         <tr>
                             <td><?php echo $instrutor->getNome() ?></td> 
                             <td><?php echo $instrutor->getCpf() ?></td>   
                             <td><?php echo $instrutor->getTelefone() ?></td>
                             <td><?php echo $instrutor->getEmail() ?></td>
                             <td><input type="radio" name="idInstrutor" value="<?php echo $instrutor->getIdInstrutor() ?>"></td>
                         </tr>

                         <?php 
                         
                         } ?>

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
        
        if(isset($_POST['idInstrutor'])){
            
            if($_POST['submit']=="Alterar"){
                
                $instrutor = new Instrutor($_POST['idInstrutor']);
                $instrutorRetornado = $fachada->detalharInstrutor($instrutor, LAZY);
                $_SESSION['instrutorRetornado'] = $instrutorRetornado;
                
                ?>
                
                <div class="form-container" style="margin-bottom:50px">
                    <form class="forms" action="alterarInstrutor.php" method="POST" >
                    <fieldset>
                      <ol>
                         
                         <li class="form-row text-input-row">
                        <label>Nome</label>
                        <input type="text" name="nome" value="<?php 
                        if(isset($instrutorRetornado)) echo $instrutorRetornado->getNome() ?>" class="text-input" style="white: 300px">
                    </li>

                        <li class="form-row text-input-row">
                          <label>CPF</label>
                          <input type="text" name="cpf" value="<?php 
                        if(isset($instrutorRetornado)) echo $instrutorRetornado->getCpf() ?>" class="text-input" style="white: 300px">
                    </li>
                    
                    <li class="form-row text-input-row">
                          <label>Endereço</label>
                          <input type="text" name="endereco" value="<?php 
                        if(isset($instrutorRetornado)) echo $instrutorRetornado->getEndereco() ?>" class="text-input" style="white: 300px">
                    </li>
                        
                     <li class="form-row text-input-row">
                          <label>Telefone</label>
                          <input type="text" name="telefone" value="<?php 
                        if(isset($instrutorRetornado)) echo $instrutorRetornado->getTelefone() ?>" class="text-input" style="white: 300px">
                    </li>
                    
                     <li class="form-row text-input-row">
                          <label>E-mail</label>
                          <input type="text" name="email" value="<?php 
                        if(isset($instrutorRetornado)) echo $instrutorRetornado->getEmail() ?>" class="text-input" style="white: 300px">
                    </li>           

                   <li class="button-row" style="margin-top: 50px">
                        <input type="hidden" name="idInstrutor" value="<?php echo $_POST['idInstrutor'] ?>">
                        <input type="submit" name="submit" value="Salvar Alterações" class="btn-submit">
                    </li> 
                      </ol>
            </fieldset>
        </form>
    </div>
                
             <?php
         }else{
             
             //$idInstrutor, $coordenador, $listaTreinos, $listaExamesFisicos, $listaDicas, $nome, $cpf, $endereco, $senha, $telefone, $email, $login
             $instrutorAlterado = new Instrutor($_POST['idInstrutor'], 
                                        $coordenador, 
                                        null, 
                                        null, 
                                        null, 
                                        $_POST['nome'], 
                                        $_POST['cpf'], 
                                        $_POST['endereco'], 
                                        $_SESSION['instrutorRetornado']->getSenha(), 
                                        $_POST['telefone'], 
                                        $_POST['email'], 
                                        $_SESSION['instrutorRetornado']->getLogin());
             
             try{
                 
                 $fachada->alterarInstrutor($instrutorAlterado);
                 $mensagem = "O(A) instrutor(a) foi alterado(a) com sucesso!!";
                 
             } catch (Exception $ex) {
                 
                 $mensagem = $ex->getMessage();
                 
              }
            }
        }
    }
    
    if(isset($_POST['submit']) && $_POST['submit']=="Salvar Alterações"){ ?>
    
        <h3>Mensagem</h3>
        <p><?php echo $mensagem ?></p>
    
    <?php } 
    
    include('componentes/footerOne.php') ?>

