<?php 

$fachada = new Fachada();
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

<h1 class="title">Alterar Nutricionistas</h1>
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
                           <th>Endetreço</th>
                           <th>Telefone</th>
                           <th>E-mail</th>
                           <th>CRN</th>
                           <th>Selecionar</th>
                         </tr>

                         <?php foreach ($listaNutricionistas as $nutricionista){ ?>
                         <tr>
                             <td><?php echo $nutricionista->getNome() ?></td> 
                             <td><?php echo $nutricionista->getCpf() ?></td> 
                              <td><?php echo $nutricionista->getEndereco() ?></td>  
                             <td><?php echo $nutricionista->getTelefone() ?></td>
                             <td><?php echo $nutricionista->getEmail() ?></td>
                             <td><?php echo $nutricionista->getCRN() ?></td>
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
    }
    else
    {
         if(isset($_POST['idNutricionista']))
         {
            if($_POST['submit']=="Alterar")
              {
            $listaNutricionistaRetornada = $_SESSION['listaNutricionistas'];
            $nutricionistaSelecionada = null;
                        
             foreach ($listaNutricionistaRetornada as $nutricionista)
             {
                 if ($nutricionista->getIdNutricionista()==$_POST['idNutricionista']){
                 $nutricionistaSelecionada = $nutricionista;
                 break;
                     }
             }
                  
             ?>
    
                <div class="form-container" style="margin-bottom:50px">
                    <form class="forms" action="alterarNutricionista.php" method="POST" >
                    <fieldset>
                      <ol>
                         
                         <li class="form-row text-input-row">
                        <label>Nome</label>
                        <input type="text" name="nome" value="<?php 
                        if(isset($nutricionistaSelecionada)) echo $nutricionistaSelecionada->getNome() ?>" class="text-input" style="white: 300px">
                    </li>

                        <li class="form-row text-input-row">
                          <label>CPF</label>
                          <input type="text" name="cpf" value="<?php 
                        if(isset($nutricionistaSelecionada)) echo $nutricionistaSelecionada->getCpf() ?>" class="text-input" style="white: 300px">
                    </li>
                    
                    <li class="form-row text-input-row">
                          <label>Endereço</label>
                          <input type="text" name="endereco" value="<?php 
                        if(isset($nutricionistaSelecionada)) echo $nutricionistaSelecionada->getEndereco() ?>" class="text-input" style="white: 300px">
                    </li>
                        
                     <li class="form-row text-input-row">
                          <label>Telefone</label>
                          <input type="text" name="telefone" value="<?php 
                        if(isset($nutricionistaSelecionada)) echo $nutricionistaSelecionada->getTelefone() ?>" class="text-input" style="white: 300px">
                    </li>
                    
                     <li class="form-row text-input-row">
                          <label>E-mail</label>
                          <input type="text" name="email" value="<?php 
                        if(isset($nutricionistaSelecionada)) echo $nutricionistaSelecionada->getEmail() ?>" class="text-input" style="white: 300px">
                    </li>
                    
                     <li class="form-row text-input-row">
                          <label>CRN</label>
                          <input type="text" name="crn" value="<?php 
                        if(isset($nutricionistaSelecionada)) echo $nutricionistaSelecionada->getCrn() ?>" class="text-input" style="white: 300px">
                    </li>           

                   <li class="button-row" style="margin-top: 50px">
                        <input type="hidden" name="idNutricionista" value="<?php echo $_POST['idNutricionista'] ?>">
                        <input type="submit" name="submit" value="Confirmar" class="btn-submit">
                    </li> 
                      </ol>
            </fieldset>
        </form>
    </div>
                
             <?php
         }
        else
     {
          $nutricionista = new Nutricionista($_POST['idNutricionista'], 
                             $_POST['nome'], 
                             $_POST['cpf'],
                             $_POST['endereco'],
                             $_POST['telefone'],
                             $_POST['email'],
                             $_POST['crn'],
                             $_SESSION['Coordenador']);
    
                try
                {
                    $fachada->alterarNutricionista($nutricionista);
                    $mensagem = "O Registro foi alterado com Sucesso!";
                } 
                catch (Exception $exc)
                {
                    $mensagem = $exc->getMessage();
                }
     }
                    
    }
    }
    
    if(isset($_POST['submit']) && $_POST['submit']=="Confirmar"){ ?>
    
        <h3>Mensagem</h3>
        <p><?php echo $mensagem ?></p>
    
    <?php } 
    
    include('componentes/footerOne.php') ?>