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
    $listaSecretarias = $fachada->listarSecretarias(LAZY);
    $_SESSION['listaSecretarias'] = $listaSecretarias;
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   

?>

<h1 class="title">Alterar Secretaria</h1>
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
      <form class="forms" action="alterarSecretaria.php" method="post" >
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

                         <?php foreach ($listaSecretarias as $secretaria){ ?>
                         <tr>
                             <td><?php echo $secretaria->getNome() ?></td> 
                             <td><?php echo $secretaria->getCpf() ?></td>   
                             <td><?php echo $secretaria->getTelefone() ?></td>
                             <td><?php echo $secretaria->getEmail() ?></td>
                             <td><input type="radio" name="idSecretaria" value="<?php echo $secretaria->getIdSecretaria() ?>"></td>
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
        
        if(isset($_POST['idSecretaria'])){
            
            if($_POST['submit']=="Alterar"){
                
                $secretaria = new Secretaria($_POST['idSecretaria']);
                $secretariaRetornada = $fachada->detalharSecretaria($secretaria, EAGER);
                $_SESSION['secretariaRetornada'] = $secretariaRetornada;
                
                ?>
                
                <div class="form-container" style="margin-bottom:50px">
                    <form class="forms" action="alterarSecretaria.php" method="POST" >
                    <fieldset>
                      <ol>
                         
                         <li class="form-row text-input-row">
                        <label>Nome</label>
                        <input type="text" name="nome" value="<?php 
                        if(isset($secretariaRetornada)) echo $secretariaRetornada->getNome() ?>" class="text-input" style="white: 300px">
                    </li>

                        <li class="form-row text-input-row">
                          <label>CPF</label>
                          <input type="text" name="cpf" value="<?php 
                        if(isset($secretariaRetornada)) echo $secretariaRetornada->getCpf() ?>" class="text-input" style="white: 300px">
                    </li>
                    
                    <li class="form-row text-input-row">
                          <label>Endereço</label>
                          <input type="text" name="endereco" value="<?php 
                        if(isset($secretariaRetornada)) echo $secretariaRetornada->getEndereco() ?>" class="text-input" style="white: 300px">
                    </li>
                        
                     <li class="form-row text-input-row">
                          <label>Telefone</label>
                          <input type="text" name="telefone" value="<?php 
                        if(isset($secretariaRetornada)) echo $secretariaRetornada->getTelefone() ?>" class="text-input" style="white: 300px">
                    </li>
                    
                     <li class="form-row text-input-row">
                          <label>E-mail</label>
                          <input type="text" name="email" value="<?php 
                        if(isset($secretariaRetornada)) echo $secretariaRetornada->getEmail() ?>" class="text-input" style="white: 300px">
                    </li>           

                   <li class="button-row" style="margin-top: 50px">
                        <input type="hidden" name="idSecretaria" value="<?php echo $_POST['idSecretaria'] ?>">
                        <input type="submit" name="submit" value="Salvar Alterações" class="btn-submit">
                    </li> 
                      </ol>
            </fieldset>
        </form>
    </div>
                
             <?php
         }else{
             
             // $idSecretaria, $nome, $cpf, $endereco, $senha, $telefone, $login, $email, $coordenador
             $secretariaAlterada = new Secretaria($_POST['idSecretaria'], 
                                                  $_POST['nome'],
                                                  $_POST['cpf'], 
                                                  $_POST['endereco'], 
                                                  $_SESSION['secretariaRetornada']->getSenha(), 
                                                  $_POST['telefone'], 
                                                  $_SESSION['secretariaRetornada']->getLogin(), 
                                                  $_POST['email'], 
                                                  $_SESSION['secretariaRetornada']->getCoordenador());
             
             try{
                 
                 $fachada->alterarSecretaria($secretariaAlterada);
                 $mensagem = "A secretaria foi alterada com sucesso!!";
                 
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

