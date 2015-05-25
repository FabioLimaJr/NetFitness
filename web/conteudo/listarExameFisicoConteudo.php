<?php 

//$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";

try
{
    $listaExameFisico = $fachada-> listarExamesFisicos($_SESSION['Instrutor'], EAGER);
    //var_dump($listaDietas);
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
    
    
   
 
    
?>

<h1 class="title">Listar Exames Fisicos</h1>
    <div class="line"></div>
    Telefone:<?php echo $instrutor->getTelefone() ?> | Email:<?php echo $instrutor->getEmail() ?> | Endereço:<?php echo $instrutor->getEndereco() ?>
    <div class="intro" style="margin-bottom:50px"></div>
    
    
    
    <h3>Usuário logado: <?php echo $instrutor->getNome() ?></h3>
   
    <div class="clear"></div>
    <div class="line"></div>

    <div style="margin-bottom: 50px">
        
        <table style="width:100%">
                    <tr>
                      <th>Nome Aluno</th> 
                      <th>Descrição Exame</th>
                      <th>Data</th>
                      <th>IMC</th>
                    </tr>
                    
                    <?php foreach ($listaExameFisico as $exameFisico){ ?>
                    <tr>
                        <td><?php echo $exameFisico->getAluno()->getNome() ?></td> 
                        <td><?php echo $exameFisico->getDescricao() ?></td>  
                        <td><?php echo ExpressoesRegulares::inverterData($exameFisico->getData()) ?></td> 
                        <td><?php echo $exameFisico->getIMC() ?></td> 
                    </tr>
                  
                    <?php } ?>
                    
        </table>
    </div>

    
    <?php include('componentes/footerOne.php') ?>