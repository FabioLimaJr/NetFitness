<?php 
include ('../classesBasicas/Aluno.php');
include ('../classesBasicas/Musica.php');
include ('../classesBasicas/Nutricionista.php');
include ('../classesBasicas/Coordenador.php');
include ('../classesBasicas/Secretaria.php');
include ('../classesBasicas/Dieta.php');
include ('../classesBasicas/Alimento.php');
session_start();

if(isset($_SESSION['Coordenador']))
{
    $coordenador = $_SESSION['Coordenador'];
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

    <?php include ('componentes/menuCoordenador.php') ?>  
    <?php include ('componentes/leftIcons.php') ?>
    <?php include ('componentes/signature.php'); ?>   
    
  </div><!-- end sidebar -->
     
  <div id="content">
  
     <?php include('conteudo/listarSecretariasConteudo.php'); ?>
    
  </div><!-- end content -->
  
</div><!-- end wrapper -->
    
<?php include ('componentes/clear.php'); ?> 

</body>
</html>

