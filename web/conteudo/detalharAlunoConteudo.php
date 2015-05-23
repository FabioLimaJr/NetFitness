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
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
    
?>

<h1 class="title">Detalhar Aluno</h1>
  <div class="line"></div>
    
        Telefone:<?php echo $secretaria->getTelefone() ?> | Email:<?php echo $secretaria->getEmail() ?> | Endereço:<?php echo $secretaria->getEndereco() ?>

    <div class="intro" style="margin-bottom:50px"></div>
    
    
    
    <h3>Usuário logado: <?php echo $secretaria->getNome() ?></h3>
   
   
    <div class="clear"></div>
    <div class="line"></div>
    
    <?php if(!$camposPreenchidos) {?>
    
    <div class="form-container" style="margin-bottom:50px">
      <form class="forms" action="detalharAluno.php" method="post" >
      <fieldset>
      
       <ol>
            <li class="form-row text-input-row">     
               <table style="width:100%;margin-bottom:50px">
                         <tr>
                           <th>Nome</th> 
                           <th>CPF</th>
                           <th>Selecionar</th>
                         </tr>

                         <?php foreach ($listaAlunos as $aluno){ ?>
                         <tr>
                             <td><?php echo $aluno->getNome() ?></td> 
                             <td><?php echo $aluno->getCpf() ?></td>
                             <td><input type="radio" name="idAluno" value="<?php echo $aluno->getIdAluno() ?>"></td>
                         </tr>

                         <?php 
                        
                         } ?>

               </table>
             </li>

             <li class="form-row text-input-row" style="text-align:center;margin-left:-100px">
                    <input type="submit" value="Detalhar" name="submit" class="btn-submit">

             </li>       
        </ol>  
       </fieldset>
       </form>
    </div>
    <?php 
           
        }else{
            
            if(count($_POST)>1){
                
                try{
                    
                    $aluno = new Aluno($_POST['idAluno']);
                    $alunoRetornado = $fachada->detalharAluno($aluno, LAZY);
                    
                    ?>
                    
                    <div style="margin-bottom: 50px">
        
                        <table style="width:100%">
                                    <tr>
                                        <td>Foto</td>
                                        <td><img src="images/usuarios/alunos/<?php echo $alunoRetornado->getFoto() ?>"></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Nome</td>
                                        <td><?php echo $alunoRetornado->getNome() ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>CPF</td>
                                        <td><?php echo $alunoRetornado->getCpf() ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Endereço</td>
                                        <td><?php echo $alunoRetornado->getEndereco() ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Telefone</td>
                                        <td><?php echo $alunoRetornado->getTelefone() ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Login</td>
                                        <td><?php echo $alunoRetornado->getLogin() ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Email</td>
                                        <td><?php echo $alunoRetornado->getEmail() ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Dt Nascimento</td>
                                        <td><?php echo ExpressoesRegulares::inverterData($alunoRetornado->getDataNascimento()) ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Sexo</td>
                                        <td><?php echo $alunoRetornado->getSexo() ?></td>
                                    </tr>

                        </table>
                    </div>
                <?php
                
                } catch (Exception $ex) {

                    $mensagem = $ex->getMessage();
                    ?> <h3>Mensagem</h3>
                    <p><?php echo $mensagem ?></p> <?php
              
                }
                
            }else{
                
                $mensagem = "Não foi selecionado(a) o(a) aluno(a)";
                ?> <h3>Mensagem</h3>
                <p><?php echo $mensagem ?></p> <?php
            }
        }
        
        include('componentes/footerOne.php') ?>

