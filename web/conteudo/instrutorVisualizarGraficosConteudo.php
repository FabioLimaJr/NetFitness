<?php 

$camposPreenchidos = false;
$mensagem = "";

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $camposPreenchidos = true;
}

if(!$camposPreenchidos)
{
    $fachada = Fachada::getInstance();
    try
    {
        $listaExamesFisicos = $fachada->listarExamesFisicos($_SESSION['Instrutor'], EAGER);
        $listaAlunos = array();

        foreach($listaExamesFisicos as $exameFisico)
        {
            if( !in_array($exameFisico->getAluno(), $listaAlunos) )
            {
                array_push($listaAlunos, $exameFisico->getAluno());
            }
        }
    }
    catch (Exception $ex)
    {
         $mensagem = $ex->getMessage();
    }
}
?>

<h1 class="title">Gráficos Exames Físicos</h1>
    <div class="line"></div>
    Telefone:<?php echo $instrutor->getTelefone() ?> | Email:<?php echo $instrutor->getEmail() ?> | Endereço:<?php echo $instrutor->getEndereco() ?>
    <div class="intro" style="margin-bottom:50px"></div>
    
    
    
    <h3>Usuário logado: <?php echo $instrutor->getNome() ?></h3>
   
    <div class="clear"></div>
    <div class="line"></div>
    
    <?php 
    
    if(!$camposPreenchidos)
    { ?>
    
        <div class="form-container" style="margin-bottom:50px">
            <form class="forms" action="instrutorVisualizarGraficos.php" method="post" >
                <fieldset>
                    <ol
                        <li class="form-row text-input-row">
                        <label>Alunos</label>   
                            <table style="width:500px; margin-left:100px; margin-top: 20px">
                                <tr>
                                  <th>Nome</th> 
                                  <th>Selecione</th>
                                </tr>

                                <?php foreach ($listaAlunos as $aluno) { ?>
                                    <tr>
                                        <td> <?php echo $aluno->getNome() ?> </td>
                                        <td> <input type="radio" name="aluno<?php echo $aluno->getIdAluno() ?>" value="true" style="width: 30px"> </td>                                   
                                    </tr>
                                <?php } ?>

                             </table>
                        </li>

                        <li class="button-row" style="margin-top:50px">
                            <input type="submit" value="Visualizar Gráficos" name="submit" class="btn-submit">
                        </li>
                    </ol>
                </fieldset>
            </form>
            <div class="response"></div>
        </div>
    
    <?php 
    }    
    else
    { 
        
        $fachada = Fachada::getInstance();
        $mensagem ="";
        
        foreach(array_keys($_POST) as $parametro)
        {                    
            if(strpos($parametro,'aluno') !== false)
            {
                $idAluno = explode("aluno", $parametro);
                $aluno = new Aluno($idAluno[1]);
                $aluno = $fachada->detalharAluno($aluno, LAZY);
                break;
            }
        }
        
        

        $listaIMC;
        $listaAltura;
        $listaPeso;
        $listaCircTorax;
        $listaCircAbdomen;
        $listaCircBraco;
        $listaCircAntebraco;
        $listaCircCoxa;
        $listaCircPanturrilha;
        
        
        $listaExamesFisicos = $fachada->listarExamesFisicos($aluno, EAGER); 
       
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
            
    ?>
        
        <div style="margin-bottom:50px">
            Aluno: <?php echo $aluno->getNome() ?>
            
            <image style="margin-bottom:50px;" src='../ferramentas/grafica/grafico.php?titulo=Peso&largura=730&altura=200&dados=<?php echo serialize($listaPeso) ?>'/>
            <image style="margin-bottom:50px;" src='../ferramentas/grafica/grafico.php?titulo=IMC&largura=730&altura=200&dados=<?php echo serialize($listaIMC) ?>'/>
            <image style="margin-bottom:50px;" src='../ferramentas/grafica/grafico.php?titulo=Circunferencia Torax&largura=730&altura=200&dados=<?php echo serialize($listaCircTorax) ?>'/>
            <image style="margin-bottom:50px;" src='../ferramentas/grafica/grafico.php?titulo=Circunferencia Abdomen&largura=730&altura=200&dados=<?php echo serialize($listaCircAbdomen) ?>'/>
            <image style="margin-bottom:50px;" src='../ferramentas/grafica/grafico.php?titulo=Circunferencia Braco&largura=730&altura=200&dados=<?php echo serialize($listaCircBraco) ?>'/>
            <image style="margin-bottom:50px;" src='../ferramentas/grafica/grafico.php?titulo=Circunferencia Antebraco&largura=730&altura=200&dados=<?php echo serialize($listaCircAntebraco) ?>'/>
            <image style="margin-bottom:50px;" src='../ferramentas/grafica/grafico.php?titulo=Circunferencia Coxa&largura=730&altura=200&dados=<?php echo serialize($listaCircCoxa) ?>'/>
            <image style="margin-bottom:50px;" src='../ferramentas/grafica/grafico.php?titulo=Circunferencia Panturrilha&largura=730&altura=200&dados=<?php echo serialize($listaCircPanturrilha) ?>'/>
            
        </div>
     
    <?php }
    
    if($mensagem!="") { ?>
    
        <h3>Mensagem</h3>
        <p><?php echo $mensagem ?></p>
    
    <?php }
    
    include('componentes/footerOne.php') ?>