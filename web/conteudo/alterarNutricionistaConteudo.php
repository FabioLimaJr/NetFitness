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
    $listaNutricionistas = $fachada->listarNutricionistas(LAZY);
    $_SESSION['listaNutricionistas'] = $listaNutricionistas;
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   

?>

<h1 class="title">Alterar Nutricionista</h1>
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
      <form class="forms" action="alterarNutricionista.php" method="post" >
      <fieldset>
      
       <ol>
            <li class="form-row text-input-row">     
               <table style="width:100%;margin-bottom:50px">
                         <tr>
                           <th>Nome</th> 
                           <th>CPF</th>
                            <th>CRN</th>
                           <th>Telefone</th>
                           <th>E-mail</th>
                           <th>Selecionar</th>
                         </tr>

                         <?php foreach ($listaNutricionistas as $nutricionista){ ?>
                         <tr>
                            <td><?php echo $nutricionista->getNome() ?></td> 
                            <td><?php echo $nutricionista->getCpf() ?></td>
                            <td><?php echo $nutricionista->getCrn() ?></td>
                            <td><?php echo $nutricionista->getTelefone() ?></td>
                            <td><?php echo $nutricionista->getEmail() ?></td>
                            <td><input type="radio" name="idNutricionista" value="<?php echo $nutricionista->getIdNutricionista() ?>"></td>
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
        
        if(isset($_POST['idNutricionista'])){
            
            if($_POST['submit']=="Alterar"){
                
                $nutricionista = new Nutricionista($_POST['idNutricionista']);
                $nutricionistaRetornado = $fachada->detalharNutricionista($nutricionista, LAZY);
                $_SESSION['nutricionistaRetornado'] = $nutricionistaRetornado;
                
                ?>
                
                <div class="form-container" style="margin-bottom:50px">
                    <form class="forms" action="alterarNutricionista.php" method="POST" >
                    <fieldset>
                      <ol>
                         
                         <li class="form-row text-input-row">
                        <label>Nome</label>
                        <input type="text" name="nome" value="<?php 
                        if(isset($nutricionistaRetornado)) echo $nutricionistaRetornado->getNome() ?>" class="text-input" style="width: 300px">
                    </li>

                        <li class="form-row text-input-row">
                          <label>CPF</label>
                          <input type="text" name="cpf" value="<?php 
                        if(isset($nutricionistaRetornado)) echo $nutricionistaRetornado->getCpf() ?>" class="text-input" style="width: 300px">  &nbsp;&nbsp;<span style="color: #c4c4c4">Ex. 111.111.111-11</span>
                    </li>
                     <li class="form-row text-input-row">
                          <label>CRN</label>
                          <input type="text" name="crn" value="<?php 
                        if(isset($nutricionistaRetornado)) echo $nutricionistaRetornado->getCrn() ?>" class="text-input" style="width: 300px">  &nbsp;&nbsp;<span style="color: #c4c4c4">Ex. 111.111.111-11</span>
                    </li>
                                    
                    <li class="form-row text-input-row">
                          <label>Endereço</label>
                          <input type="text" name="endereco" value="<?php 
                        if(isset($nutricionistaRetornado)) echo $nutricionistaRetornado->getEndereco() ?>" class="text-input" style="width: 300px">
                    </li>
                        
                     <li class="form-row text-input-row">
                          <label>Telefone</label>
                          <input type="text" name="telefone" value="<?php 
                        if(isset($nutricionistaRetornado)) echo $nutricionistaRetornado->getTelefone() ?>" class="text-input" style="width: 300px"> <span style="color: #c4c4c4">&nbsp;&nbsp;Ex. (DD) 1111-1111</span>
                    </li>
                    
                     <li class="form-row text-input-row">
                          <label>E-mail</label>
                          <input type="text" name="email" value="<?php 
                        if(isset($nutricionistaRetornado)) echo $nutricionistaRetornado->getEmail() ?>" class="text-input" style="width: 300px">
                    </li>           

                   <li class="button-row" style="margin-top: 50px">
                        <input type="hidden" name="idNutricionista" value="<?php echo $_POST['idNutricionista'] ?>">
                        <input type="submit" name="submit" value="Salvar Alterações" class="btn-submit">
                    </li> 
                      </ol>
            </fieldset>
        </form>
    </div>
                
             <?php
         }else{
             //$idInstrutor, $coordenador, $listaDietas, $listaDicas, $nome, $cpf, $endereco, $senha, $telefone, $email, $login
             $nutricionistaAlterado = new Nutricionista($_POST['idNutricionista'], 
                                        $coordenador, 
                                        $_POST['crn'],
                                        null, 
                                        null, 
                                        $_POST['nome'], 
                                        $_POST['cpf'], 
                                        $_POST['endereco'], 
                                        $_SESSION['nutricionistaRetornado']->getSenha(), 
                                        $_POST['telefone'], 
                                        $_POST['email'], 
                                        $_SESSION['nutricionistaRetornado']->getLogin());
             
             try{
                 
                 $fachada->alterarNutricionista($nutricionistaAlterado);
                 $mensagem = "O(A) nutricionista foi alterado(a) com sucesso!!";
                 
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

