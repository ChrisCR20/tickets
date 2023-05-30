<?php 
  require_once("../../config/conexion.php");
  if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html>
	<?php require_once("../Template/MainHead/head.php");?>
	<title>Chris::Consultar Ticket</title>
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
							<h3 id="lblnomidticket"></h3>
							<div id="lblestado"></div>
							<span class="label label-pill label-primary" id="lblnomusuario"></span>
							<span class="label label-pill label-purple " id="lblfechcrea"></span>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="#">Home</a></li>
								<li class="active">Detalle Ticket</li>
							</ol>
						</div>
					</div>
				</div>
		</header>

		<div class="box-typical box-typical-padding">
			<div class="row">

				<div class="col-lg-6">
					<fieldset class="form-group">
						<label class="form-label semibold" for="cat_nom">Categoria</label>
						<input type="text" class="form-control" id="cat_nom" name="cat_nom" readonly>
					</fieldset>
				</div>
				<div class="col-lg-6">
					<fieldset class="form-group">
						<label class="form-label semibold" for="tick_titulo">Titulo</label>
						<input type="text" class="form-control" id="tick_titulo" name="tick_titulo" readonly>
					</fieldset>
				</div>
				<div class="col-lg-12">
					<fieldset class="form-group">
						<label class="form-label semibold" for="tick_descripcion">Descripción</label>
						<div class="summernote-theme-1" >
							<textarea id="tick_descripcion" name="tick_descripcion" class="summernote"  ></textarea>
						</div>
					</fieldset>
				</div>
			</div>
		</div>
		
        <section class="activity-line" id="lbldetalle">

		</section><!--.activity-line-->
		<div class="box-typical box-typical-padding" id="paneldetalle">
				<p>
					Ingrese su comentario. (*)
				</p>
				<div class="row">
						<form method="post" id="ticket_detalleform">
							<div class="col-lg-12">
								<div class="summernote-theme-1" >
									<textarea id="tickd_descrip" name="tickd_descrip" class="summernote"  ></textarea>
								</div>
							</div>
						
							<div class="col-lg-12">
								<button type="button" id="btncomentar" class="btn btn-rounded btn-inline btn-primary">Comentar</button>
								<button type="button" id="btncerrar" class="btn btn-rounded btn-inline btn-danger">Cerrar Ticket</button>
							</div>
 					 </form>
				</div><!--.row-->
			</div>	
		</div><!--.container-fluid-->
	</div><!--.page-content-->
	<!-- Contenido -->

	<?php require_once("../Template/MainJs/js.php");?>
    <script type="text/javascript" src="detalleticket.js"></script>
</body>
</html>
<?php 
  }else{
	  header("Location:".Conectar::ruta()."/index.php");
  }
?>