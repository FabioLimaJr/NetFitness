<?php 
   
    include ('../classesBasicas/Pessoa.php');
    include ('../classesBasicas/Aluno.php');
    include ('../classesBasicas/Coordenador.php');
    include ('../classesBasicas/Nutricionista.php');
    include ('../classesBasicas/Instrutor.php');
    include ('../classesBasicas/Secretaria.php');   
    include ('../fachada/Fachada.php');
    
    
    if(isset($_POST['senha'])&&isset($_POST['login']))
    {

        $fachada = Fachada::getInstance();

        $pessoa = new Pessoa(null, null, null, null, $_POST['senha'], null, $_POST['login'], null);

        $mensagem = "";
        $tipoUsuario = "";
        $resposta = array();
        $usuarioLogado = null;
        $arrayMetodosLogar = ['logarAluno','logarCoordenador','logarNutricionista','logarInstrutor','logarSecretaria'];

        try
        {
            foreach ($arrayMetodosLogar as $metodoLogar)
            {
                $usuarioLogado = $fachada->{$metodoLogar}($pessoa);

                if($usuarioLogado!=null)
                {
                   $tipoUsuario =  get_class($usuarioLogado);
                   $resposta['tipoUsuario'] = $tipoUsuario;
                   $resposta['usuario'] = (array)$usuarioLogado;
                   $resposta['mensagem'] = "O usuário ".$usuarioLogado->getNome()." efetuou o login com sucesso.";
                   break;
                }
                else
                {
                    $tipoUsuario = "Desconhecido";
                    $resposta['tipoUsuario'] = $tipoUsuario;
                    $resposta['mensagem'] = "Usuário inexistente";
                }

            }
            echo json_encode($resposta,true);

        }
        catch (Exception $ex)
        {
           $tipoUsuario = "Desconhecido";
           $resposta['tipoUsuario'] = $tipoUsuario;
           $resposta['mensagem'] = $ex->getMessage();
           echo json_encode($resposta,true);
        }
    }