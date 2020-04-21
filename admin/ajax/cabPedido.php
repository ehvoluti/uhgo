<?php
// Incluir aquivo de conexão
require("../../include/config.php");

// Recebe o valor enviado
$tabelas = $_GET['tabela'];
$dados = $_GET['dados'];
//var_dump($dados);
inserir($tabelas, $dados);
$onde = "idpedido=(SELECT MAX(idpedido) FROM pedido WHERE idlogin=".$_SESSION['idlogin'].") ORDER BY idpedido DESC";


//Ver dados de um registro apenas 
$busca = ver($tabelas, "*", $onde);
$nomeemp = ver("empresa", "nomeemp", "idempresa=".$busca[idempresa]);
$nomecli = ver("cliente", "nomecli", "idcliente=".$busca[idcliente]);
	echo $busca[idpedido]." : ".$nomeemp[nomeemp]." : ".$nomecli[nomecli]." : ".$busca[totalped];
?>