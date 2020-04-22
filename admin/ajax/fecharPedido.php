<?php
// Incluir aquivo de conexão
require("../../include/config.php");

// Recebe o valor enviado
$tabelas = $_GET['tabela'];
$dados[status] = "A";
$onde = $_GET['dados'];
//var_dump($dados);
alterar($tabelas, $onde, $dados);

//Ver dados de um registro apenas 
$busca = ver($tabelas, "idpedido, status", $onde);
	echo $busca[idpedido]." : ".$busca[status];
?>