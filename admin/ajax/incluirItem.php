<?php
// Incluir aquivo de conexão
require("../../include/config.php");

// Recebe o valor enviado
$tabelas = $_GET['tabela'];
$dados = $_GET['dados'];
//var_dump($dados);
inserir($tabelas, $dados);
$onde = "idpedido=(SELECT MAX(idpedido) FROM pedido WHERE idlogin=".$_SESSION['idlogin'].") ORDER BY seqitem DESC";


//Ver dados de um registro apenas 
$busca = ver($tabelas, "*", $onde);
$nomeprod = ver("produto", "nomeprod", "idproduto=".$busca[idproduto]);
	echo $busca[idproduto]." : ".$nomeprod[nomeprod]." : ".$busca[quant]." : ".$busca[valor]." : ".$busca[totalit]." : ".$busca[seqitem];
?>