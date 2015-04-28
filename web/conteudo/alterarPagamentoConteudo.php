<?php
$camposPreenchidos = false;
$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $camposPreenchidos = true;
}

try {
    $listaPagamentos = $fachada->listarPagamentos(EAGER);
    $listaPagamentosRetornada = array();
    foreach ($listaPagamentos as $pagamento)
    {
        if($pagamento->getSecretaria()->getIdSecretaria() == $_SESSION['Secretaria']->getIdSecretaria())
        {
            array_push($listaPagamentosRetornada, $pagamento);
        }
    }
    
    $_SESSION['listaPagamentos'] = $listaPagamentos;
} catch (Exception $exc) {
    echo $exc->getMessage();
}

?>

<h1 class="title">Alterar Pagamento</h1>

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
    <form class="forms" action="alterarPagamento.php" method="post" >
      <fieldset>
          <ol>
              <li class="form-row text-input-row">
                  <table style="width: 100%; margin-bottom: 50px">
                      <tr>
                          <th>Aluno</th>
                          <th>Valor</th>
                          <th>DataVencimento</th>
                          <th>DataPagamento</th>
                           <th>Selecionar</th>
                      </tr>
                      
                      <?php foreach ($listaPagamentosRetornada as $pagamento){ ?>
                        <tr>
                            <?php 
                               if($pagamento->getDataVencimento() != NULL){
                                  $pagamento->setDataVencimento(ExpressoesRegulares::inverterData($pagamento->getDataVencimento())); 
                               }
                               if($pagamento->getDataPagamento() != NULL){
                                  $pagamento->setDataPagamento(ExpressoesRegulares::inverterData($pagamento->getDataPagamento())); 
                               }
                            ?>
                            <td><?php echo $pagamento->getAluno()->getNome() ?></td>
                            <td><?php echo $pagamento->getValor() ?></td>
                            <td><?php echo $pagamento->getDataVencimento() ?></td>
                            <td><?php echo $pagamento->getDataPagamento() ?></td>
                            <td><input type="radio" name="idPagamento" value="<?php echo $pagamento->getIdPagamento() ?>"></td>
                        </tr>
                      <?php }?>
                  </table>
              </li>
              
              <li class="form-row text-input-row" style="text-align:center;margin-left:-100px">
                    <input type="submit" value="Alterar" name="submit" class="btn-submit">
             </li>
          </ol>
      </fieldset>
    </form>
    </div>
<?php //FALTA TERMINAR DAQUI PRA BAIXO-----------------------------------------
     }else{
         
         if(isset($_POST['idPagamento'])){
             
             $pagamento = new Pagamento($_POST['idPagamento']);
             $pagamentoRetornado = $fachada->detalharPagamento($pagamento, EAGER);
             
             //var_dump($pagamentoRetornado);
             $_SESSION['pagamentoRetornado'] = $pagamentoRetornado;

?>

    <div class="form-container" style="margin-bottom:50px">
        <form class="forms" action="alterarPagamento.php" method="post" >
            <fieldset>
                <ol>

                    <li class="form-row text-input-row">
                    <label>Valor</label>
                    <input type="text" name="valor" value="<?php if(isset($pagamentoRetornado)) echo $pagamentoRetornado->getValor() ?>" class="text-input" style="width: 300px">
                    </li>

                    <li class="form-row text-input-row">
                    <label>DataVencimento</label>                               
                    <input type="text" name="dataVencimento" value="<?php if(isset($pagamentoRetornado)) echo (ExpressoesRegulares::inverterData($pagamentoRetornado->getDataVencimento())) ?>" class="text-input" style="width: 300px">
                    </li>
                    
                    <li class="form-row text-input-row">
                    <label>DataPagamento</label>
                    <input type="text" name="dataPagamento" value="<?php if(isset($pagamentoRetornado)) echo $pagamentoRetornado->getDataPagamento() ?>" class="text-input" style="width: 300px">
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
            
                 /*
             $pagamentoAlterado = new Pagamento($_SESSION['pagamentoRetornado']->getIdPagamento());
             $pagamentoAlterado->setValor($_POST['valor']);
             $pagamentoAlterado->setDataVencimento(ExpressoesRegulares::inverterData(($_POST['dataVencimento'])));
             $pagamentoAlterado->setDataPagamento(ExpressoesRegulares::inverterData(($_POST['dataPagamento'])));
             $pagamentoAlterado->setSecretaria($_SESSION['Secretaria']);
              */       
                 
             $pagamentoAlterado = new Pagamento($_SESSION['pagamentoRetornado']->getIdPagamento(),
                                                $_POST['valor'],
                                                ExpressoesRegulares::inverterData($_POST['dataVencimento']),
                                                ExpressoesRegulares::inverterData($_POST['dataPagamento']),
                                                $_SESSION['Secretaria'],
                                                $_SESSION['pagamentoRetornado']->getAluno());    
                 
             try{
                 
                 $fachada->alterarPagamento($pagamentoAlterado);
                 $mensagem = "O pagamento foi alterado com sucesso!!";
                 
             } catch (Exception $ex) {
                 
                 $mensagem = $ex->getMessage();
                 
             }
        }else{
    
            $mensagem = "Não foi selecionado o Pagamento";
        }
      }
    }
    
    if($camposPreenchidos && !isset($_POST['idPagamento']) || isset($pagamentoAlterado)){
        
    ?>
    
        <h3>Mensagem</h3>
        <p><?php echo $mensagem ?></p>
    
    <?php } 
    
include('componentes/footerOne.php') ?>


