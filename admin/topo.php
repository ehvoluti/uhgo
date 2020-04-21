<!DOCTYPE html>
<html>
	<head>
		<title>uH Go</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/all.css" rel="stylesheet"> <!--load all styles -->
		<link href="css/style.css" rel="stylesheet">
		
		
			<!-- Ainda n�o esta em uso
			<link href="css/style_fluxo.css" rel="stylesheet">
			<link href="css/style.css" rel="stylesheet">
			-->
	</head>
    <body>
        <div class="container">
            <?php if(logado()): ?>
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			  <a class="navbar-brand" href="index.php">uH Go</a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			  </button>

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
				  <!-- Cadastro -->
				  <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					  Comercial
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					  <a class="dropdown-item" href="pedido.php">Pedidos</a>
					  <a class="dropdown-item" href="incluirPedido.php">Incluir Pedido</a>
					  <div class="dropdown-divider"></div>
					  <a class="dropdown-item" href="#">#</a>
					  <a class="dropdown-item" href="logout.php">Logout</a>
					</div>
				  </li>
					<!-- Controle -->
				  <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					  Relatórios
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					  <a class="dropdown-item" href="#">#</a>
					  <a class="dropdown-item" href="#">#</a>
					</div>  
				  </li>
					<!-- Relatorio -->
				  <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					  Relatórios
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					  <a class="dropdown-item" href="#">#</a>			
					</div>
				  </li>
				</ul>
			  </div>
			</nav>
			
			<!-- jQuery (necessario para os plugins Javascript Bootstrap) -->
				<footer>
					<script src="js/jquery.min.js"></script>
					<script src="js/bootstrap.bundle.min.js"></script>
					<script src="js/lancamento.js"></script>
				</footer>	
		</div>
	 <?php endif; ?>	
</body>		
</html>