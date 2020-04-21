<?php
include('../include/config.php');

//Verifica se está logado
if(!logado()){
    header('Location: login.php');
}

?>
<?php include('topo.php'); ?>
<!-- Acesso rapido -->
<div class="container-fluid" style="margin:20px">
	<div class="row">
		<div class="span12">
			<h1>uH Go - Pedidos</h1>
			<p>App para digitação de pedidos de vendas</p>
			<a  href="incluirPedido.php"><i class="fas fa-edit"></i> Incluir Pedido</a>
		</div>
	</div>

	<? echo "Teste para pegar usuario da Sessao:  ".$_SESSION['usuario']."-->".$_SESSION['idlogin']; ?>
	<!-- Mostra Saldo 
	<div class="row">
		<div class="span12">
		<i class="fas fa-wallet" onclick="versaldo(4);"></i>
		<i class="fas fa-credit-card" onclick="versaldo(5);"></i>
		<span id="saldo4"></span>
		</div>
	</div>
	-->
	<!-- Grafico Inicial -->
	<div> ---
		<?php //include('../campari/grf_categoria.php');?>
	</div>
</div>	
<?php include("rodape.php"); ?>
