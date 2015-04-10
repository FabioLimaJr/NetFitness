<?php
$camposPreenchidos = false;
$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $camposPreenchidos = true;
}

try {
    $listaPagamentos = $fachada->ListarPagamento($_SESSION['Secretaria']);
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
                      
                      <?php foreach ($listaPagamentos as $pagamento){ ?>
                        <tr>
                            <td><?php echo $pagamento->getAluno()->getIdAluno() ?></td>
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
 <?php } 