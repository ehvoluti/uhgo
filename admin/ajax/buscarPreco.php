<?php
// Incluir aquivo de conexão
require("../../include/config.php");

// Recebe o valor enviado
//$valor = $_GET['valor'];
//$tabela = $_GET['tabela'];
$onde = $_GET['dados'];

//Ver dados de um registro apenas 
$busca = buscapreco($onde);
//var_dump($busca); 
	echo $busca[buscapreco];
?>