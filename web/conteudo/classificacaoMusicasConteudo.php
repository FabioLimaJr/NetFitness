<?php

//$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";


try 
{
    $listaAlunos = $fachada->listarAlunos(EAGER);
    $listaMusicas = $fachada->listarMusicas(EAGER);
    
} catch (Exception $exc) {
    echo $exc->getMessage();
}

function sortByValor($a, $b) {
    return $a['valor'] - $b['valor'];
}


$counts=array();

foreach ($listaAlunos as $aluno)
{
    
    if($aluno->getMusica()->getIdMusica()!="")
    {
        array_push($counts, $aluno->getMusica()->getIdMusica());
    }
    
   
}

$countIdsMusica = array_count_values($counts);

$listaMusicasRetornadas = array();

/*
while ($fruit_name = current($array)) {
    if ($fruit_name == 'apple') {
        echo key($array).'<br />';
    }
    next($array);
}
  */
    

$count = 0;
foreach ($listaMusicas as $musica)
{
    if(array_key_exists($musica->getIdMusica(), $countIdsMusica))
    {
        $listaMusicasRetornadas[$count]['musica'] = $musica;
        $listaMusicasRetornadas[$count]['valor'] = $countIdsMusica[$musica->getIdMusica()];
        $count++;
    }
}

usort($listaMusicasRetornadas, 'sortByValor');
$listaMusicasRetornadas = array_reverse($listaMusicasRetornadas);

$numVotos= sizeof($counts);

for($count = 0; $count<sizeof($listaMusicasRetornadas); $count++)
{
    $listaMusicasRetornadas[$count]['valor'] = 100/$numVotos*$listaMusicasRetornadas[$count]['valor'];
}

//var_dump($countIdsMusica);
?>

<h1 class="title">Classificação Músicas</h1>
    <div class="line"></div>
    Telefone:<?php echo $secretaria->getTelefone() ?> | Email:<?php echo $secretaria->getEmail() ?> | Endereço:<?php echo $secretaria->getEndereco() ?>
    <div class="intro" style="margin-bottom:50px"></div>

<h3>Usuário logado: <?php echo $secretaria->getNome() ?></h3>
   
    <div class="clear"></div>
    <div class="line"></div>

    <div style="margin-bottom: 50px">
        <table style="width: 100%">
            <tr>
               <th>Titulo</th>
               <th>Categoria</th>
               <th>Artista</th>
               <th>Votos</th>
            </tr>
            
            <?php foreach ($listaMusicasRetornadas as $musicaRetornada){ ?>
                    <tr>
                        <td><?php echo $musicaRetornada['musica']->getTitulo() ?></td>
                        <td><?php echo $musicaRetornada['musica']->getCategoria() ?></td>
                        <td><?php echo $musicaRetornada['musica']->getArtista() ?></td>
                        <td><?php echo $musicaRetornada['valor'] ?> %</td>
                    </tr>
                  
            <?php } ?>
        </table>
    </div>
    
     <?php include('componentes/footerOne.php') ?>