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
    $listaInstrutores = $fachada->listarInstrutores(LAZY);
    
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
  
?>

<h1 class="title">Excluir Instrutor</h1>
<div class="line"></div>
Telefone:<?php echo $coordenador->getTelefone() ?> | Email:<?php echo $coordenador->getEmail() ?> | Endereço:<?php echo $coordenador->getEndereco() ?>
<div class="intro" style="margin-bottom:50px"></div>
    
<h3>Usuário logado: <?php echo $coordenador->getNome() ?></h3>
   
<div class="clear"></div>
<div class="line"></div>

<?php if(!$camposPreenchidos) 
    { ?>
    <div style="margin-bottom: 50px">
        
 
        <div class="form-container" style="margin-bottom:50px">
         
            <form class="forms" action="excluirInstrutor.php" method="post" >
         <fieldset>
            <ol>


             <li class="form-row text-input-row">
               <label>Instrutores</label>
               <table style="width:100%">
                    <tr>
                      <th>Nome do Instrutor</th> 
                      <th>CPF</th>
                      <th>Selecionar</th>
                    </tr>
                    
                    <?php foreach ($listaInstrutores as $instrutor){ ?>
                    <tr>
                        <td><?php echo $instrutor->getNome() ?></td> 
                        <td><?php echo $instrutor->getCpf() ?></td>  
                        <td><input type="radio" name="idInstrutor" value="<?php echo $instrutor->getIdInstrutor() ?>"></td>  
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
            
            $instrutor = new Instrutor($_POST['idInstrutor']);
            $fachada->excluirInstrutor($instrutor);
            $mensagem = "O(A) Instrutor(a) foi excluido(a) com sucesso!!";
            
        } catch (Exception $ex) {

            $mensagem = $ex->getMessage();
            
        }
        
        ?>
        
        <h3>Mensagem</h3>
        <p><?php echo $mensagem ?></p>
    
    <?php     
    } 
    
    include('componentes/footerOne.php') ?>

