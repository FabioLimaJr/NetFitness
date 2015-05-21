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
    $listaAlunos = $fachada->listarAlunos(LAZY);
    $_SESSION['listaAlunos'] = $listaAlunos;
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   

?>

<h1 class="title">Alterar Aluno</h1>
    <div class="line"></div>
    
    Telefone:<?php echo $secretaria->getTelefone() ?> | Email:<?php echo $secretaria->getEmail() ?> | Endereço:<?php echo $secretaria->getEndereco() ?>

    <div class="intro" style="margin-bottom:50px"></div>
    
    <h3>Usuário logado: <?php echo $secretaria->getNome() ?></h3>
   
    <div class="clear"></div>
    <div class="line"></div>
    
<?php 
     if(!$camposPreenchidos) 
     { ?>

    <div class="form-container" style="margin-bottom:50px">
      <form class="forms" action="alterarAluno.php" method="post" >
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

                         <?php foreach ($listaAlunos as $aluno){ ?>
                         <tr>
                             <td><?php echo $aluno->getNome() ?></td> 
                             <td><?php echo $aluno->getCpf() ?></td>   
                             <td><?php echo $aluno->getTelefone() ?></td>
                             <td><?php echo $aluno->getEmail() ?></td>
                             <td><input type="radio" name="idAluno" value="<?php echo $aluno->getIdAluno() ?>"></td>
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
        
        if(isset($_POST['idAluno'])){
            
            if($_POST['submit']=="Alterar"){
                
                $aluno = new Aluno($_POST['idAluno']);
                $alunoRetornado = $fachada->detalharAluno($aluno, LAZY);
                $_SESSION['alunoRetornado'] = $alunoRetornado;
                
                ?>
                
                <div class="form-container" style="margin-bottom:50px">
                    <form class="forms" enctype="multipart/form-data" action="alterarAluno.php" method="POST" >
                    <fieldset>
                      <ol>
                        
                          
                        <li class="form-row text-input-row">
                            <label>Sexo</label>
                            <input type="radio" name="sexo" value="m" style="margin-top: 10px" <?php 
                            if(isset($alunoRetornado) && $alunoRetornado->getSexo() == "m") echo "checked"?> >Masculino
                            <input type="radio" name="sexo" value="f" <?php 
                            if(isset($alunoRetornado) && $alunoRetornado->getSexo() == "f") echo "checked"?> >Feminino
                        </li>
                        <li class="form-row text-input-row">
                            <label>Nome</label>
                            <input type="text" name="nome" value="<?php 
                            if(isset($alunoRetornado)) echo $alunoRetornado->getNome() ?>" class="text-input" style="white: 300px">
                        </li>

                        <li class="form-row text-input-row">
                          <label>CPF</label>
                          <input type="text" name="cpf" value="<?php 
                        if(isset($alunoRetornado)) echo $alunoRetornado->getCpf() ?>" class="text-input" style="white: 300px">
                    </li>
                    
                    <li class="form-row text-input-row">
                          <label>Endereço</label>
                          <input type="text" name="endereco" value="<?php 
                        if(isset($alunoRetornado)) echo $alunoRetornado->getEndereco() ?>" class="text-input" style="white: 300px">
                    </li>
                        
                     <li class="form-row text-input-row">
                          <label>Telefone</label>
                          <input type="text" name="telefone" value="<?php 
                        if(isset($alunoRetornado)) echo $alunoRetornado->getTelefone() ?>" class="text-input" style="white: 300px">
                    </li>
                    
                     <li class="form-row text-input-row">
                          <label>E-mail</label>
                          <input type="text" name="email" value="<?php 
                        if(isset($alunoRetornado)) echo $alunoRetornado->getEmail() ?>" class="text-input" style="white: 300px">
                    </li>
                    
                    <li class="form-row text-input-row">
                        <label>Dt Nascimento</label>
                        <input type="text" id="dataPicked" name="dataNascimento" maxlength="10" name="data" value="<?php 
                        if(isset($alunoRetornado)) echo $alunoRetornado->getDataNascimento() ?>" class="text-input" style="width: 300px">
                    </li>

                   <li class="button-row" style="margin-top: 50px">
                        <input type="hidden" name="idAluno" value="<?php echo $_POST['idAluno'] ?>">
                        <input type="submit" name="submit" value="Salvar Alterações" class="btn-submit">
                    </li> 
                      </ol>
            </fieldset>
        </form>
    </div>
                
             <?php
         }else{
             
             $alunoAlterado = new Aluno($_POST['idAluno'], 
                                        $_POST['nome'],
                                        $_POST['cpf'], 
                                        $_POST['endereco'],
                                        $_SESSION['alunoRetornado']->getSenha(),
                                        $_POST['telefone'],
                                        $_SESSION['alunoRetornado']->getLogin(),
                                        $_POST['email'],
                                        $_POST['sexo'],
                                        $_POST['dataNascimento'],
                                        $secretaria,
                                        null/*$musica*/,
                                        null/*$dieta*/, 
                                        null/*$listaPagamentos*/, 
                                        null/*$listaTreinos*/,
                                        $_SESSION['alunoRetornado']->getFoto() );
             
             try{
                 
                 $fachada->alterarAluno($alunoAlterado);
                 $mensagem = "O(A) Aluno(a) foi alterado(a) com sucesso!!";
                 
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

