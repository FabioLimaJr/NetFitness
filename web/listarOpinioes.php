<?php
include ('../classesBasicas/Aluno.php');
include ('../classesBasicas/Secretaria.php');
include ('../classesBasicas/Opiniao.php');

session_start();

if(isset($_SESSION['Secretaria']))
{
    $secretaria = $_SESSION['Secretaria'];
}
else
{
    header('location: erroAcesso.php');
}

include ('../expressoesRegulares/ExpressoesRegulares.php');
include ('../fachada/Fachada.php');
include ('componentes/header.php');
?>

<body>
<div id="wrapper">
    
  <div id="sidebar">
    
    <div id="logo"><a href="index.php"><img src="images/logo.png" alt=""></a></div>

    <?php include ('componentes/menuSecretaria.php') ?>  
    <?php include ('componentes/leftIcons.php') ?>
    <?php include ('componentes/signature.php'); ?>   
    
  </div><!-- end sidebar -->
     
  <div id="content">
  
     <?php include('conteudo/listarOpinioesConteudo.php'); ?>
    
  </div><!-- end content -->
  
</div><!-- end wrapper -->
    
<?php include ('componentes/clear.php'); ?> 

</body>
</html>
