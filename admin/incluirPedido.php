<?php

require("../include/config.php");
$empresa = listar("empresa", "*", null, null, " nomeemp");
$cliente = listar("cliente", "*", null, null, " nomecli");
$produto = listar("produto", "*", null, null, " idproduto");

$var_get=0;
//array_push($_GET,$_SESSION['idlogin']);

//var_dump($_GET);

if(!$_GET) {
	//echo "Nada pode ser feito";
	$var_get = "Sem dados";
}
else {
	$_GET["idlogin"]=$_SESSION['idlogin'];
    if (inserir("pedido", $_GET)){
        header('Location: incluirPedido.php');
   }
}
$where = "idlogin = ".$_SESSION['idlogin'];

$dados_cab = listar("pedido", "*", $where , "" , "idpedido DESC", "1");

?>
<?php include('topo.php'); ?>




<script src="js/jquery.maskMoney.js" type="text/javascript"></script>

<div class="container">
<!--
	<div id="legend">
		<legend class=""><p>Comercial -> Pedido</p></legend>
	</div>
-->
		<div class="row">
			<div class="col">
				<table class="table table-sm table-responsive-sm table-responsive-md" id="cabPedido">
					<!--<thead class="thead-dark"> -->

					<!--</thead> -->
				</table>
			</div>
		</div>

		<!-- ----------------------------
		 Digitação dos produtos
		 ---------------------------->			
		<div class="row">
			<div class="col">
				<div class="form-group">
						<input type="text" id="idproduto" name="idproduto" list="dtlproduto" class="form-control col-5 col-xl-4 col-sm-5 form-group" onchange="getProduto();">
						<datalist id="dtlproduto" >
							<?php  foreach ($produto as $xproduto): ?>
							<option id="<?php echo $xproduto['idproduto'];?>" value="<?php echo $xproduto['idproduto']?>"><?php echo $xproduto['nomeprod'];?></option>
							<?php endforeach; ?>
						</datalist>	
				</div>
				<div class="col-xs-6 col-sm-4 col-lg-2 form-group-lg">
					<label for="produto-quantidade">Quantidade</label>
					<input type="number" id="quant" class="form-control align-right">
				</div>
				<div class="col-xs-6 col-sm-4 col-lg-2 form-group-lg">
					<label for="produto-preco">Preço</label>
					<input type="text" inputmode="numeric"  id="valor" class="form-control align-right" step="0.01">
				</div>

				<!-- Dados escondidos -->	
				<input type="text" name="idpedido" id="idpedido" value="" hidden="true">
				<input type="text" name="idlogin" id="idlogin" value="<? echo $_SESSION['idlogin'] ?>" hidden="true">

					<div>
						<div class="btn-toolbar">
							<button class="btn btn-info" style=" margin-left:50px; margin-top: 10px;" onclick="getIncluirItem();">Incluir Item</button>
						</div>
					</div>	
				</div>
			</div>
		</div>



	<div class="form-group">
		<table  class="table table-sm table-responsive-sm table-responsive-md" id="listaItens">
			<thead class="thead-dark">
				<tr>
					<th>Cod</th>
					<th>Produto</th>
					<th >Quant</th>
					<th>Valor</th>
					<th>Total</th>
					<!--<th style="text-align: right">Valor</th> -->
					<th style="width: 36px;">Ações</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
		<div>
			<div class="btn-toolbar">
				<button class="btn btn-success btn-lg"  onclick="fecharPedido();">Fechar Pedido</button>
			</div>
		</div>	
	
	</div>

</div>	

<!-------------------- 
	Modal Cabecalho 
--------------------->
<!--<form action="incluirPedido.php" method="get"> -->
	<div id="cabModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Dados do Pedido</h4>
					<button class="close" data-dismiss="modal" arial-label="Fechar">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				
				<div class="modal-body">
				<div class="row">
					<div class="col-8">
						<label>Empresa</label>
						<!-- <div class="row">  class col-5 col-xl-4 col-sm-5 -->
							<div class="form-group">
									<input type="text" id="idempresa" name="idempresa" list="dtlempresa" class="form-control col-5 col-xl-4 col-sm-5 form-group" onchange="getEmpresa();">
									<datalist id="dtlempresa" >
										<?php  foreach ($empresa as $xempresa): ?>
										<option id="<?php echo $xempresa['idempresa'];?>" value="<?php echo $xempresa['idempresa'];?>"><?php echo $xempresa['nomeemp'];?></option>
										<?php endforeach; ?>
									</datalist>	
							</div>
							
								<div class="form-group">
									<small id="empresa" class="form-text text-muted"></small>
								</div>
							

						<label>Cliente</label>
						<!-- <div class="row">  class col-5 col-xl-4 col-sm-5 -->
							<div class="form-group">
									<input type="text" id="idcliente" name="idcliente" list="dtlcliente" class="form-control col-5 col-xl-4 col-sm-5 form-group" onchange="getCliente();">
									<datalist id="dtlcliente" >
										<?php  foreach ($cliente as $xcliente): ?>
										<option id="<?php echo $xcliente['idcliente'];?>" value="<?php echo $xcliente['idcliente'];?>"><?php echo $xcliente['nomecli'];?></option>
										<?php endforeach; ?>
									</datalist>	
							</div>
							
								<div class="form-group">
									<small id="cliente" class="form-text text-muted"></small>
								</div>
								<!--<input type="text" id="idlogin" name="idlogin" value=""> --> 
					</div>
				</div>
				</div>
				
				<div class="modal-footer">
					<!--<input type="submit" value="Confirma" class="btn btn-primary" > -->
					<button class="btn btn-primary" data-dismiss="modal" onclick="incluirPedido();">Confirma</button>
				</div>
			</div>
		</div>
	</div>
<!-- Fim do Modal -->


<!-- Testando Modal
				<br>
				<input type="submit" value="Incluir" class="btn btn-primary" >	
			</div>	
		</div>		
	</form>
-->	
			



	<script type="text/javascript">
    $(function(){
        $("#valor").maskMoney();
    })
    </script>

<?php include("rodape.php"); ?>