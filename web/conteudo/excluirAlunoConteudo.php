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
    $listaAlunos = $fachada->listarAlunos(LAZY);
    
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
  
?>

<h1 class="title">Excluir Aluno</h1>
<div class="line"></div>
Telefone:<?php echo $secretaria->getTelefone() ?> | Email:<?php echo $secretaria->getEmail() ?> | Endereço:<?php echo $secretaria->getEndereco() ?>
<div class="intro" style="margin-bottom:50px"></div>
    
<h3>Usuário logado: <?php echo $secretaria->getNome() ?></h3>
   
<div class="clear"></div>
<div class="line"></div>

<?php if(!$camposPreenchidos) 
    { ?>
    <div style="margin-bottom: 50px">
        
 
        <div class="form-container" style="margin-bottom:50px">
         
            <form class="forms" action="excluirAluno.php" method="post" >
         <fieldset>
            <ol>


             <li class="form-row text-input-row">
               <label>Alunos</label>
               <table style="width:100%">
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
                    <?php } ?>
                    
                </table>
             </li>

              <li class="button-row" style="margin-top:50px;margin-left: -100px;text-align: center">
               <input type="submit" value="Excluir" name="submit" class="btn-submit">
             </li>
             
            </ol>

         </fieldset>
       </form>
    </div>
        
    <?php
    
    }else{
        
        try{
            
            $aluno = new Aluno($_POST['idAluno']);
            $fachada->excluirAluno($aluno);
            $mensagem = "O(A) Aluno(a) foi excluído(a) com sucesso!!";
            
        } catch (Exception $ex) {

            $mensagem = $ex->getMessage();
            
        }
        
        ?>
        
        <h3>Mensagem</h3>
        <p><?php echo $mensagem ?></p>
    
    <?php     
    } 
    
    include('componentes/footerOne.php') ?>

