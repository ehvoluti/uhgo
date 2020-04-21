/*
  Carregar referencia ao passar com o Mouse
  */
$(function(){
		$('[data-toggle="tooltip"]').tooltip()
	});


//Carregar modal ao abrir
$(document).ready(function() {
    $('#cabModal').modal('show');
})



/* Mostra nome do empresa após seleção do Código do mesmo */
function getEmpresa()
{
	var selector = document.getElementById('idempresa').value;
	var passavalor = document.getElementById('dtlempresa').options.namedItem(selector).text;
	document.getElementById("empresa").innerHTML = passavalor; 

	//Tratamento para recarregar banco
	/*
	$.ajax({
		url: 'ajax/ver.php',
		data:{tabela:'empresa',campos:'*',valor:`idempresa=`+selector},
		success:function(retorno){
			let retorno2 = retorno.split(":")
			document.getElementById('banco').value = retorno2[2]
		}
	}) */

}


/* Mostra nome do cliente após seleção do Código do mesmo */
function getCliente()
{
	var selector = document.getElementById('idcliente').value;
	var passavalor = document.getElementById('dtlcliente').options.namedItem(selector).text;
	document.getElementById("cliente").innerHTML = passavalor;
	document.getElementById("dtlcliente").innerHTML = passavalor;
}

/* Mostra nome do Produto após seleção do Código do mesmo */
function getProduto()
{
	var selector = document.getElementById('idproduto').value;
	var passavalor = document.getElementById('dtlproduto').options.namedItem(selector).text;
	//document.getElementById("produto").innerHTML = passavalor;
	//document.getElementById("dtlproduto").innerHTML = passavalor;
}

/* Inclui Cabeçalho do pedido */
function incluirPedido()
{
	var v_empresa = document.getElementById('idempresa').value;
	var v_cliente = document.getElementById('idcliente').value;
	var v_login	  = document.getElementById('idlogin').value;

	var ar_incluirpedido = {idempresa:v_empresa,
							idcliente:v_cliente,
							idlogin:v_login}
	console.log (ar_incluirpedido);	

	//Tratamento para gravar cabecalho do pedido
	$.ajax({
		type:'GET',
		dataType: 'html',
		url: 'ajax/cabPedido.php',
		data:{tabela:'pedido',dados:ar_incluirpedido},
		success:function(retorno){
			console.log(retorno)

			let retorno2 = retorno.split(":")
			console.log(retorno2[0])
			//console.log(ar_incluiritem[idpedido])

			//Monta table
			  //var x = document.createElement("TR");
			  //x.setAttribute("id", "cabecalho");
			  //document.getElementById("cabPedido").appendChild(x);


  			  var y = document.createElement("TH");
			  var t = document.createTextNode(`Pedido: `+retorno2[0]+ ` (`+retorno2[1]+`)`);
			  y.appendChild(t);
			  document.getElementById("cabPedido").appendChild(y);						

  			  var y = document.createElement("TH");
			  var t = document.createTextNode(`Cliente: `+retorno2[2]);
			  y.appendChild(t);
			  document.getElementById("cabPedido").appendChild(y);

			  document.getElementById('idpedido').value = retorno2[0];	



		}	
	})		
}



/* Inclui produtos no pedido */
function getIncluirItem()
{
	var v_idproduto = document.getElementById('idproduto').value;
	var v_quant = document.getElementById('quant').value;
	var v_valor = document.getElementById('valor').value;
	var v_idpedido = document.getElementById('idpedido').value;


	var ar_incluiritem = {idpedido:v_idpedido,
							idproduto:v_idproduto,
							quant:v_quant,
							valor:v_valor}
	console.log (ar_incluiritem);	



	//Tratamento para gravar itens
	$.ajax({
		type:'GET',
		dataType: 'html',
		url: 'ajax/incluirItem.php',
		data:{tabela:'itpedido',dados:ar_incluiritem},
		success:function(retorno){
			console.log(retorno)

			let retorno2 = retorno.split(":")
			console.log(retorno2[0])
			//console.log(ar_incluiritem[idpedido])
  
			  var x = document.createElement("TR");
			  x.setAttribute("id", retorno2[5]);
			  document.getElementById("listaItens").appendChild(x);

			  //Codigo Item
			  var y = document.createElement("TD");
			  var t = document.createTextNode(retorno2[0]);
			  y.appendChild(t);
			  document.getElementById(retorno2[5]).appendChild(y);						

			  //Descricao Item 
			  var y = document.createElement("TD");
			  var t = document.createTextNode(retorno2[1]);
			  y.appendChild(t);
			  document.getElementById(retorno2[5]).appendChild(y);

			  //Quant item
			  var y = document.createElement("TD");
			  var t = document.createTextNode(retorno2[2]);
			  y.appendChild(t);
			  document.getElementById(retorno2[5]).appendChild(y);

			  //valor item
			  var y = document.createElement("TD");
			  var t = document.createTextNode(retorno2[3]);
			  y.appendChild(t);
			  document.getElementById(retorno2[5]).appendChild(y);
			  //Total item
			  var y = document.createElement("TD");
			  var t = document.createTextNode(retorno2[4]);
			  y.appendChild(t);
			  document.getElementById(retorno2[5]).appendChild(y);


			  
			  //document.getElementById("dtlproduto").innerHTML = ``;
  		}
	})
	//Limpa campos para nova digitação
	//document.getElementById(idproduto).innerHTML=``;
	//document.getElementById(quant).value='0';
	//document.getElementById("dtlproduto").innerHTML = ``;
	document.getElementById('valor').value = '';
	document.getElementById('quant').value = '';
	document.getElementById('idproduto').value = '';
	document.getElementById('idproduto').focus();
}