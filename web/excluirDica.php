<?php 
include ('../classesBasicas/Aluno.php');
include ('../classesBasicas/Musica.php');
include ('../classesBasicas/Nutricionista.php');
include ('../classesBasicas/Instrutor.php');
include ('../classesBasicas/Secretaria.php');
include ('../classesBasicas/Dieta.php');
include ('../classesBasicas/Alimento.php');
include ('../classesBasicas/Dica.php');
session_start();

$pessoa="";
if($_SESSION['tipoUsuario'] == "Nutricionista")
{
     $pessoa = $_SESSION['Nutricionista'];
   
}
elseif(($_SESSION['tipoUsuario'] == "Instrutor"))
{
     $pessoa = $_SESSION['Instrutor'];
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

    <?php include ("componentes/menu".$_SESSION['tipoUsuario'].".php");
     include ('componentes/leftIcons.php'); 
     include ('componentes/signature.php'); ?>   
    
  </div><!-- end sidebar -->
     
  <div id="content">
  
     <?php include('conteudo/excluirDicaConteudo.php'); ?>
    
  </div><!-- end content -->
  
</div><!-- end wrapper -->
    
<?php include ('componentes/clear.php'); ?> 

</body>
</html>

