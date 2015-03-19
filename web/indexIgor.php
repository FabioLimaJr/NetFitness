<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include('../classesBasicas/Instrutor.php');
 include('../classesBasicas/Coordenador.php');
 include('../classesBasicas/Musica.php');
 include('../classesBasicas/Dieta.php');
 include('../classesBasicas/Pagamento.php');
 include('../classesBasicas/Treino.php');
 include('../classesBasicas/ExameFisico.php');
 include('../classesBasicas/Dica.php');
 include('../classesBasicas/Aluno.php');
 include('../classesBasicas/Secretaria.php');
 include('../classesBasicas/Exercicio.php');
 
 include('../expressoesRegulares/ExpressoesRegulares.php');
 include('../excecoes/Excecoes.php');
                 
 include("../fachada/Fachada.php");
 
 $fachada = Fachada::getInstance();
 
 $exercicio = new Exercicio(1, "Supino inclinado", "Peito", "testando descricao de supino inclinado");
 
 $fachada->excluirExercicio($exercicio);

