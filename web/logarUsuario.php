<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/netFitness.css">

        <meta charset="UTF-8">
        <title>NetFitness : Login</title>
    </head>
    
    
    <body>
        <div id="boxLogin">
            <?php
               
                include("../classesBasicas/Pessoa.php");
                include("../classesBasicas/Coordenador.php");
                include("../classesBasicas/Secretaria.php");
                
                include("../fachada/IFachada.php");
                include("../fachada/Fachada.php");
                
                include("../interfaceRepositorio/IRepositorioGenerico.php");
                
                include("../conexao/Conexao.php");
                include("../repositorioGenerico/RepositorioGenerico.php");
                include("../repositorioGenerico/ConexaoBanco.php");
                
                include("../interfaceRepositorio/IRepositorioCoordenador.php");
                include("../repositorio/RepositorioCoordenador.php");
                
                include("../controlador/ControladorAluno.php");
                include("../interfaceRepositorio/IRepositorioAluno.php");
                include("../repositorio/RepositorioAluno.php");
                
                
                include("../interfaceRepositorio/IRepositorioInstrutor.php");
                include("../repositorio/RepositorioInstrutor.php");
                
                include("../interfaceRepositorio/IRepositorioSecretaria.php");
                include("../repositorio/RepositorioSecretaria.php");
                
                include("../controlador/controladorCoordenador.php");
                include("../controlador/controladorInstrutor.php");
                include("../controlador/controladorSecretaria.php");
                
                $fachada = Fachada::getInstance();
                
                 
                
                 $pessoa = new Pessoa(null, null, null, null, $_POST['senha'], null, $_POST['login'], null);
           
                 $usuarioLogado = $fachada->logarSecretaria($pessoa);
                 
                if($usuarioLogado!=null)
                {
                    echo ("Usuário logado: ".  get_class($usuarioLogado));
                    var_dump($usuarioLogado);
                }
                else
                {
                    echo ("Usuário não existe");
                }
               
            ?>
         </div>
        
    </body>
</html>
