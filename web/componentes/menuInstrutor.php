<div id="menu" class="menu-v">
<?
session_start();
if($_GET["logout"]){
    session_destroy();
    header("location: index.php");
    exit;
}
?>
      <ul>
        <li><a href="index.php?logout=1" class="active">Sair</a>
        </li>
        <li><a href="#">Exame Fisico</a>
          <ul>
            <li><a href="inserirExameFisico.php">Inserir</a></li>
            <li><a href="excluirExameFisico.php">Excluir</a></li>
            <li><a href="alterarExameFisico.php">Alterar</a></li>
            <li><a href="listarExamesFisicos.php">Listar</a></li>
            <li><a href="instrutorVisualizarGraficos.php">Visualizar Gráficos</a></li>
            <li><a href="instrutorCompararGraficos.php">Comparar Gráficos</a></li>
          </ul>
        </li>
        <li><a href="#">Exercício</a>
          <ul>
            <li><a href="inserirExercicio.php">Inserir</a></li>
            <li><a href="ExcluirExercicio.php">Excluir</a></li>
            <li><a href="alterarExercicio.php">Alterar</a></li>
            <li><a href="listarExercicios.php">Listar</a></li>
          </ul>
        </li>
        <li><a href="#">Treino</a>
          <ul>
            <li><a href="vincularTreinoAlunos.php">Vincular Treino</a></li>
            <li><a href="inserirTreino.php">Inserir</a></li>
            <li><a href="excluirTreino.php">Excluir</a></li>
            <li><a href="alterarTreino.php">Alterar</a></li>
            <li><a href="listarTreinos.php">Listar</a></li>
            <li><a href="detalharTreino.php">Detalhar</a></li>
          </ul>
        </li>
        <li><a href="#">Dica</a>
          <ul>
            <li><a href="inserirDica.php">Inserir</a></li>
            <li><a href="alterarDica.php">Alterar</a></li>
            <li><a href="excluirDica.php">Excluir</a></li>
            <li><a href="listarDica.php">Listar</a></li>
          </ul>
        </li>
      </ul>
    </div>
