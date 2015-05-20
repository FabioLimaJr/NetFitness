<?php

include("phpgraphlib.php");

  
$data = unserialize($_GET['dados']);


$graph = new PHPGraphLib($_GET['largura'],$_GET['altura']);

if(isset($_GET['comp']))
{
    $legends = unserialize($_GET['legendas']);
    foreach($data as $element)
    {
        $graph->addData($element);
    }

    $graph->setTitleLocation("left");
    $graph->setDataValueColor ("#000000");
    $graph->setBarColor('#d3222f','#f9a33e','#ffe700','#71bf44','#007c37','#68aee0','#374ea1','#2e1950');
    $graph->setLegend(TRUE);
    call_user_func_array(array($graph, 'setLegendTitle'), $legends);
   
}
 else
{
    $graph->setGradient('#596d7f', '#b8c4f7');
    $graph->setDataValueColor ("#5d60e9");
    $graph->addData($data);
}

$graph->setTitle($_GET['titulo']);
$graph->setTextColor("#9a3b1a");
$graph->setDataValues(true);

$graph->setXValuesHorizontal(true);
$graph->createGraph();

