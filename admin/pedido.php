<?php
$filtro = '';

require("../include/config.php");

if (!$_GET){
	$where = " (EXTRACT(YEAR FROM dtneg))=(EXTRACT(YEAR FROM CURRENT_DATE)) AND EXTRACT(MONTH FROM dtneg)=EXTRACT(MONTH FROM CURRENT_DATE)".$filtro;	
} else {
	//$where = " (EXTRACT(YEAR FROM dtemissao))=(EXTRACT(YEAR FROM CURRENT_DATE)) AND EXTRACT(MONTH FROM dtemissao)=EXTRACT(MONTH FROM CURRENT_DATE)".$filtro;
	$where = "idpedido>0" .$filtro;

}
$order = "idpedido DESC";
$limit = "15";

//echo $filtro."<br>";
$tipos = listar("pedido", "idpedido, idempresa, to_char(dtneg, 'DD/MM/YY') AS dataneg, (SELECT SUBSTR(nomecli,1,20) FROM cliente WHERE idcliente=pedido.idcliente) AS cliente, totalped", $where , "" , $order, $limit);


?>
<?php include("topo.php"); ?>

<script src="js/jquery.maskMoney.js" type="text/javascript"></script>

<div class="container">
	<legend>
		<h6>Fluxo de Caixa -> Lançamentos</h6>
	</legend>
	<div class="btn-toolbar">
		<a href="incluirPedido.php"><button class="btn btn-primary">Novo</button></a>
		<button class="btn btn-primary" style=" margin-left:50px" data-toggle="modal" data-target="#filtrarModal">Mais Filtros</button>
	</div>
	<br>
	<div class="form-group">
		<table class="table table-sm table-responsive-sm table-responsive-md">
			<thead class="thead-dark">
				<tr>
					<th>Pedido</th>
					<th>Dia/Mês</th>
					<th>Cliente</th>
					<th style="text-align: right">Valor</th>
					<th style="width: 36px;">Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($tipos as $tipo): ?>
					<tr>
						<th><?php echo $tipo['idpedido']; ?></th>
						<th><?php echo $tipo['dataneg']; ?></th>
						<th><?php echo $tipo['cliente']; ?></th>
						<th style="text-align: right" ><?php echo number_format($tipo['totalped'],2); ?></th>
						<th>
							<a href="#"><i class="fas fa-trash-alt"></i></a>
						</th>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	
	<!-- Rodapé da tabela
	<div class="row">
		<label>Filtro aplicado: <?//echo str_replace($where,'AND','e'). " ORDEM ". $order." LIMITE ".$limit?><label>
	</div>
	-->
</div>

<!-- Modal de busca Botão filtrar -->
<form action="lancamento.php" method="get">
	<div id="filtrarModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Filtrar na Grade</h4>
					<button class="close" data-dismiss="modal" arial-label="Fechar">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				
				<div class="modal-body">
					<!--Referencia-->
					<div class="row">
						<div class="col-4">
							<span>Referencia</span>
						</div>	
						<div class="col-8">
							<input type="text" id="filtrar_referencia" name="filtrar_referencia" class="form-control col-6 col-xl-8 col-sm-8">
						</div>
					</div>

					<!--Valores-->
					<div class="row">
						<div class="col-4">
							<span>Valor</span>
						</div>	
						<div class="col-4">De:
							<input type="decimal" id="filtrar_valor_de" name="filtrar_valor_de" class="form-control col-6 col-xl-8 col-sm-8" inputmode="numeric">
						</div>
						<div class="col-4">Ate:
							<input type="decimal" id="filtrar_valor_ate" name="filtrar_valor_ate" class="form-control col-6 col-xl-8 col-sm-8" inputmode="numeric" step="0.01">
						</div>

					</div>


				</div>
				
				<div class="modal-footer">
					<input type="submit" value="Buscar" class="btn btn-primary" >
					<button class="btn btn-info" data-dismiss="modal">Fechar</button>
				</div>
			</div>
		</div>
	</div>
</form> 

	<script type="text/javascript">
    $(function(){
        $("#filtrar_valor_de").maskMoney();
        $("#filtrar_valor_ate").maskMoney();
    })
    </script>

<?php include("rodape.php"); ?>