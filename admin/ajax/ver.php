<?php
// Incluir aquivo de conexão
require("../../include/config.php");

// Recebe o valor enviado
$valor = $_GET['valor'];
$tabela = $_GET['tabela'];
$campos = $_GET['campos'];

//Ver dados de um registro apenas 
$busca = ver($tabela, $campos, $valor); 
switch ($tabela) {
	case "catlancto":
		echo $busca[codcatlancto]." : ".$busca[descricao];
		break;
	case "cliente":
		echo $busca[idcliente]." : ".$busca[nomecli];
		break;
	case "empresa":
		echo $busca[idempresa].":".$busca[nomeemp];
		break;		
}
?>