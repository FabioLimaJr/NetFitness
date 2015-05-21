<?php 


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $camposPreenchidos = true;
}
 else
{
  $camposPreenchidos = false;    
}

$mensagem = "";
 
    
?>

<h1 class="title">Comparar Gráficos Exames Físicos</h1>
    <div class="line"></div>
    Telefone:<?php echo $aluno->getTelefone() ?> | Email:<?php echo $aluno->getEmail() ?> | Endereço:<?php echo $aluno->getEndereco() ?>
    <div style="float:right"><image height = "80" src="<?php echo IMAGE_PATH_ALUNOS."/".$aluno->getFoto() ?>"> </div>
    <div class="intro" style="margin-bottom:50px"></div>
    
    
    
    <h3>Usuário logado: <?php echo $aluno->getNome() ?></h3>
   
    <div class="clear"></div>
    <div class="line"></div>

    <?php if(!$camposPreenchidos) { ?>
     <label>Selecionar os gráficos a comparar:</label>
    <div style="margin-bottom: 30px; margin-top:30px">
        <form class="forms" enctype="multipart/form-data" action="alunoCompararGraficos.php" method="post" >
            <fieldset style="margin-left:50px;">
           <ol>
               

               <li class="form-row checkbox-row">
                
                  <input type="checkbox" name="peso" value="ok" checked>Peso
              </li>  
              
              <li class="form-row checkbox-row">
                 <input type="checkbox" name="imc" value="ok">IMC
              </li>   
                <li class="form-row checkbox-row"> 
                 <input type="checkbox" name="torax" value="ok">Circunferência Torax
               </li>  
               
                <li class="form-row checkbox-row"> 
                 <input type="checkbox" name="abdomen" value="ok">Circunferência Abdomen
               </li>  
               
                <li class="form-row checkbox-row"> 
                 <input type="checkbox" name="braco" value="ok">Circunferência Braço
               </li>  
               
               <li class="form-row checkbox-row">
                 <input type="checkbox" name="antebraco" value="ok">Circunferência Antebraço
               </li>
               
                <li class="form-row checkbox-row"> 
                 <input type="checkbox" name="coxa" value="ok">Circunferência Coxa
               </li>
               
                <li class="form-row checkbox-row"> 
                 <input type="checkbox" name="panturrilha" value="ok">Circunferência Panturrilha
                </li> 
           
             
              <li class="button-row" style="margin-top:50px">
                  <input type="submit" value="Comparar" name="submit" class="btn-submit" style="margin-left:0">
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

        $listaIMC;
        $listaAltura;
        $listaPeso;
        $listaCircTorax;
        $listaCircAbdomen;
        $listaCircBraco;
        $listaCircAntebraco;
        $listaCircCoxa;
        $listaCircPanturrilha;
        
        $matrixDados=array();
        $legendas=array();

        try
        {
            if(count($_POST)>2)             
            {
                if(count($_POST)<=6)
                {
                    $listaExamesFisicos = $fachada->listarExamesFisicos($_SESSION['Aluno'], EAGER);
                    
                    if(sizeof($listaExamesFisicos)!=0)
                    {

                        foreach ($listaExamesFisicos as $exameFisico)
                        {
                            $dataConvertida = Texto::convertDataFormat("d-m-Y", "j/n/y", Texto::dataInvert($exameFisico->getData()));            
                            if(isset($_POST['peso']))
                            {
                                $listaPeso[$dataConvertida] = $exameFisico->getPeso();
                            }
                            if(isset($_POST['imc']))
                            {
                                $listaIMC[$dataConvertida] = $exameFisico->getImc();    
                            }
                            if(isset($_POST['torax']))
                            {
                                $listaCircTorax[$dataConvertida] = $exameFisico->getCircTorax();    
                            }
                            if(isset($_POST['abdomen']))
                            {
                                $listaCircAbdomen[$dataConvertida] = $exameFisico->getCircAbdomen();    
                            }
                            if(isset($_POST['braco']))
                            {
                                $listaCircBraco[$dataConvertida] = $exameFisico->getCircBraco();    
                            }
                            if(isset($_POST['antebraco']))
                            {
                                $listaCircAntebraco[$dataConvertida] = $exameFisico->getCircAntebraco();    
                            }
                            if(isset($_POST['coxa']))
                            {
                                 $listaCircCoxa[$dataConvertida] = $exameFisico->getCircCoxa();    
                            }
                            if(isset($_POST['panturrilha']))
                            {
                                 $listaCircPanturrilha[$dataConvertida] = $exameFisico->getCircPanturrilha();    
                            }

                           // array_push ($matrixDados, )    
                        }

                        if(isset($_POST['peso']))
                        {
                            array_push($matrixDados, $listaPeso);
                            array_push($legendas, "Peso");
                        }
                        if(isset($_POST['imc']))
                        {
                            array_push($matrixDados, $listaIMC);
                            array_push($legendas, "IMC");
                        }
                        if(isset($_POST['torax']))
                        {
                            array_push($matrixDados, $listaCircTorax);
                            array_push($legendas, "Torax");
                        }
                        if(isset($_POST['abdomen']))
                        {
                            array_push($matrixDados, $listaCircAbdomen);
                            array_push($legendas, "Abdomen");
                        }
                        if(isset($_POST['braco']))
                        {
                            array_push($matrixDados, $listaCircBraco);
                            array_push($legendas, "Braco");
                        }
                        if(isset($_POST['antebraco']))
                        {
                            array_push($matrixDados, $listaCircAntebraco);
                            array_push($legendas, "Antebraco");
                        }
                        if(isset($_POST['coxa']))
                        {
                            array_push($matrixDados, $listaCircCoxa);
                            array_push($legendas, "Coxa");
                        }
                        if(isset($_POST['panturrilha']))
                        {
                            array_push($matrixDados, $listaCircPanturrilha);
                            array_push($legendas, "Panturrilha");
                        }
                        ?>
                        <div style="margin-bottom: 50px">
                            <image style="margin-bottom:50px;" src='../ferramentas/grafica/grafico.php?titulo=Comparar Graficos&largura=730&altura=350&dados=<?php echo serialize($matrixDados) ?>&legendas=<?php echo serialize($legendas)?>&comp=true'/>

                        </div>
                        <?php
                    }
                    else 
                    {
                         $mensagem = "O aluno não realizou nenhum exame físico.";
                    }
                }
                else 
                {
                    $mensagem = "O número máximo de gráficos que é possível comparar é 5.";                  
                }
            }
            else
            {
                $mensagem = "É preciso selecionar pelo menos dois gráficos para efetuar a comparação.";
            }
        } 
        catch (Exception $exc)
        {
            $mensagem = $exc->getMessage();
        }  
         
        
       }
     
     if($mensagem!="") { ?>
    
        <h3>Mensagem</h3>
        <p><?php echo $mensagem ?></p>
    
    <?php }
     
    include('componentes/footerOne.php') ?>