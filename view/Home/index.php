<?php 
  require_once("../../config/conexion.php");
  if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html>
	<?php require_once("../Template/MainHead/head.php");?>
	<title>Chris::Home</title>
</head>
<body class="with-side-menu">
	<?php require_once("../Template/MainHeader/header.php");?>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<div class="mobile-menu-left-overlay"></div>

	<?php require_once("../Template/MainNav/nav.php");?>

	<!-- Contenido -->
	<div class="page-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="row">
						<div class="col-sm-4">
							<article class="statistic-box green">
								<div>
									<div class="number" id="lbltotal"></div>
									<div class="caption"><div>Total de Tickets</div></div>
								</div>
							</article>
						</div><!--.col-->
						<div class="col-sm-4">
							<article class="statistic-box yellow">
								<div>
									<div class="number" id="lbltotalabiertos"></div>
									<div class="caption"><div>Total de Tickets Abiertos</div></div>
								</div>
							</article>
						</div><!--.col-->
						<div class="col-sm-4">
							<article class="statistic-box red">
								<div>
									<div class="number" id="lbltotalcerrados"></div>
									<div class="caption"><div>Total de Tickets cerrados</div></div>
								</div>
							</article>
						</div><!--.col-->
					</div>
				</div>
					

				
			</div><!--.row-->
			<section class="card">
				<header class="card-header">
					Tickets por categoria
				</header>
				<div class="card-block">
				<div id="grafico" ></div>
				</div>
			</section>

		</div><!--.container-fluid-->
	</div><!--.page-content-->
	<!-- Contenido -->

	<?php require_once("../Template/MainJs/js.php");?>
	 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	<script type="text/javascript" src="home.js"></script>
</body>
</html>
<?php 
  }else{
	  header("Location:".Conectar::ruta()."/index.php");
  }
?>