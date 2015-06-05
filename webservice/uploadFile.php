<?php
include ('../fachada/Fachada.php');
include ('../classesBasicas/Aluno.php');
include ('../ferramentas/upload/Upload.php');
include ('../expressoesRegulares/ExpressoesRegulares.php');


if(isset($_POST['idAluno']) && isset($_POST['senha']) && isset($_POST['login']))
{

    $fachada = Fachada::getInstance();
    $aluno = new Aluno($_POST['login'],$_POST['senha']);
    
    if($fachada->conferirLoginSenha($aluno))     
    {    
        $fotoUpload = new Upload($_FILES['file'],'pt_BR'); 

        if ($fotoUpload->uploaded) 
        {
            $destDir = "../web/".IMAGE_PATH_ALUNOS;
            $filename = pathinfo($_POST['novoNomeFile'], PATHINFO_FILENAME); 
            $fotoUpload->file_new_name_body   = $filename;
            $fotoUpload->image_resize         = true;
            $fotoUpload->image_x              = 300;
            $fotoUpload->image_ratio_y        = true;
            $fotoUpload->process($destDir);

            if ($fotoUpload->processed) 
            {
                $resposta['mensagem'] = "Foto atualizada com sucesso.";           
                $nomeFotoUpload = $fotoUpload->file_dst_name;

                $alunoRetornado = $fachada->detalharAluno(new Aluno($_POST['idAluno']), LAZY);
                $alunoRetornado->setFoto($nomeFotoUpload);
                $alunoRetornado->setDataNascimento(ExpressoesRegulares::inverterData($alunoRetornado->getdataNascimento()));
                
                try
                {
                    $fachada->alterarAluno($alunoRetornado);
                } 
                catch (Exception $ex)
                {
                    $resposta['mensagem']="Não foi possível atualizar a foto.\nTentar novamente.";
                }

            } 
            else 
            {
              $resposta['mensagem'] = $fotoUpload->error;
            }
        }
        else 
        {
          $resposta['mensagem'] = $fotoUpload->error;
        }

        echo json_encode($resposta);
    
    }
}