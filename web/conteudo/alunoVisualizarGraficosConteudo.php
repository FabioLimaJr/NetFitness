<?php 

//$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";

$listaIMC;
$listaAltura;
$listaPeso;
$listaCircTorax;
$listaCircAbdomen;
$listaCircBraco;
$listaCircAntebraco;
$listaCircCoxa;
$listaCircPanturrilha;

try
{
    $listaExamesFisicos = $fachada->listarExamesFisicos($_SESSION['Aluno'], EAGER);
  
    if(sizeof($listaExamesFisicos)!=0)
    {
        foreach ($listaExamesFisicos as $exameFisico)
        {
            $dataConvertida = Texto::convertDataFormat("d-m-Y", "j/n/y", Texto::dataInvert($exameFisico->getData()));
            $listaPeso[$dataConvertida] = $exameFisico->getPeso();
            $listaIMC[$dataConvertida] = $exameFisico->getImc();
            $listaCircTorax[$dataConvertida] = $exameFisico->getCircTorax();
            $listaCircAbdomen[$dataConvertida] = $exameFisico->getCircAbdomen();
            $listaCircBraco[$dataConvertida] = $exameFisico->getCircBraco();
            $listaCircAntebraco[$dataConvertida] = $exameFisico->getCircAntebraco();
            $listaCircCoxa[$dataConvertida] = $exameFisico->getCircCoxa();
            $listaCircPanturrilha[$dataConvertida] = $exameFisico->getCircPanturrilha();
        }
    }
    else
    {
       $mensagem = "O aluno não realizou nenhum exame físico.";    
    }
   
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
    
    
   
 
    
?>

<h1 class="title">Gráficos Exames Físicos</h1>
    <div class="line"></div>
    Telefone:<?php echo $aluno->getTelefone() ?> | Email:<?php echo $aluno->getEmail() ?> | Endereço:<?php echo $aluno->getEndereco() ?>
    <div style="float:right"><image height = "80" src="<?php echo IMAGE_PATH_ALUNOS."/".$aluno->getFoto() ?>"> </div>
    <div class="intro" style="margin-bottom:50px"></div>
    
    
    
    <h3>Usuário logado: <?php echo $aluno->getNome() ?></h3>
   
    <div class="clear"></div>
    <div class="line"></div>
    
    <?php if(sizeof($listaExamesFisicos)!=0)
    {  ?>

    <div style="margin-bottom: 50px">
        <image style="margin-bottom:50px;" src='../ferramentas/grafica/grafico.php?titulo=Peso&largura=730&altura=200&dados=<?php echo serialize($listaPeso) ?>'/>
        <image style="margin-bottom:50px;" src='../ferramentas/grafica/grafico.php?titulo=IMC&largura=730&altura=200&dados=<?php echo serialize($listaIMC) ?>'/>
        <image style="margin-bottom:50px;" src='../ferramentas/grafica/grafico.php?titulo=Circunferencia Torax&largura=730&altura=200&dados=<?php echo serialize($listaCircTorax) ?>'/>
        <image style="margin-bottom:50px;" src='../ferramentas/grafica/grafico.php?titulo=Circunferencia Abdomen&largura=730&altura=200&dados=<?php echo serialize($listaCircAbdomen) ?>'/>
        <image style="margin-bottom:50px;" src='../ferramentas/grafica/grafico.php?titulo=Circunferencia Braco&largura=730&altura=200&dados=<?php echo serialize($listaCircBraco) ?>'/>
        <image style="margin-bottom:50px;" src='../ferramentas/grafica/grafico.php?titulo=Circunferencia Antebraco&largura=730&altura=200&dados=<?php echo serialize($listaCircAntebraco) ?>'/>
        <image style="margin-bottom:50px;" src='../ferramentas/grafica/grafico.php?titulo=Circunferencia Coxa&largura=730&altura=200&dados=<?php echo serialize($listaCircCoxa) ?>'/>
        <image style="margin-bottom:50px;" src='../ferramentas/grafica/grafico.php?titulo=Circunferencia Panturrilha&largura=730&altura=200&dados=<?php echo serialize($listaCircPanturrilha) ?>'/>
    </div>
    
    <?php
    }
     if($mensagem!="") { ?>
    
        <h3>Mensagem</h3>
        <p><?php echo $mensagem ?></p>
    
    <?php }
    
    include('componentes/footerOne.php') ?>