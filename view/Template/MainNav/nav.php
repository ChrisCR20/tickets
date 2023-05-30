<?php 
	if($_SESSION["rol_id"] == 1){
		?>
		<nav class="side-menu">
			<ul class="side-menu-list">
				<li class="blue-dirty">
					<a href="..\Home\">
						<i class="font-icon font-icon-notebook"></i>
						<span class="lbl">Inicio</span>
					</a>
				</li>
				<li class="blue-dirty">
					<a href="..\NuevoTicket\">
						<i class="font-icon font-icon-notebook"></i>
						<span class="lbl">Nuevo Ticket</span>
					</a>
				</li>
				<li class="blue-dirty">
					<a href="..\ConsultarTicket\">
						<i class="font-icon font-icon-notebook"></i>
						<span class="lbl">Consultar Ticket</span>
					</a>
				</li>
			</ul>
		</nav><!--.side-menu-->
	<?php
	}
	else
	{
	?>
	<nav class="side-menu">
			<ul class="side-menu-list">
				<li class="blue-dirty">
					<a href="..\Home\">
						<i class="font-icon font-icon-notebook"></i>
						<span class="lbl">Inicio</span>
					</a>
				</li>
				<li class="blue-dirty">
					<a href="..\ConsultarTicket\">
						<i class="font-icon font-icon-notebook"></i>
						<span class="lbl">Consultar Ticket</span>
					</a>
				</li>
				<li class="blue-dirty">
					<a href="..\MntUsuario\">
						<i class="font-icon font-icon-notebook"></i>
						<span class="lbl">Mantenimiento Usuario</span>
					</a>
				</li>
			</ul>
		</nav><!--.side-menu-->
	<?php
	}
?>
