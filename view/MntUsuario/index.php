<?php 
  require_once("../../config/conexion.php");
  if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html>
	<?php require_once("../Template/MainHead/head.php");?>
	<title>Chris::Mantenimiento Usuario</title>
</head>
<body class="with-side-menu">
	<?php require_once("../Template/MainHeader/header.php");?>

	<div class="mobile-menu-left-overlay"></div>

	<?php require_once("../Template/MainNav/nav.php");?>

	<!-- Contenido -->
	<div class="page-content">
		<div class="container-fluid">
		<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Mantenimiento Usuario</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="#">Home</a></li>
								<li class="active">Mantenimiento Usuario</li>
							</ol>
						</div>
					</div>
				</div>
		</header>
		<div class="box-typical box-typical-padding">
		<button type="button" class="btn btn-inline btn-primary" id="btnnuevousuario">Nuevo Registro</button>
			<table id="usuario_data" class="table table-bordered table-striped table-vcenter js-dataTable-full" >
				<thead>
					<tr>
						<th style="width: 5%;">Nombre</th>
						<th style="width: 15%;">Apellido</th>
						<th class="d-none d-sm-table-cell" style="width: 40%;">Correo</th>
						<th class="d-none d-sm-table-cell" style="width: 5%;">Pass</th>
						<th style="width: 10%;">Rol</th>
						<th class="text-center" style="width: 5%;"></th>
						<th class="text-center" style="width: 5%;"></th>
					</tr>
				</thead>
			</table>
		</div>
		
		</div><!--.container-fluid-->
	</div><!--.page-content-->
	<!-- Contenido -->
	<?php require_once("modalmntusuario.php");?>
	<?php require_once("../Template/MainJs/js.php");?>
	<script type="text/javascript" src="mntusuario.js"></script>
</body>
</html>
<?php 
  }else{
	  header("Location:".Conectar::ruta()."/index.php");
  }
?>