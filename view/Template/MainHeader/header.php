
	<header class="site-header">
	    <div class="container-fluid">
	
	        <a href="#" class="site-logo">
	            <img class="hidden-md-down" src="../../public/wnlc1.png" alt="">
	            <img class="hidden-lg-up" src="../../public/wnlc1.png" alt="">
	        </a>
	
	        <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
	            <span>toggle menu</span>
	        </button>
	
	        <button class="hamburger hamburger--htla">
	            <span>toggle menu</span>
	        </button>
	        <div class="site-header-content">
	            <div class="site-header-content-in">
	                <div class="site-header-shown">
	                    <div class="dropdown user-menu">
	                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                            <img src="../../public/p<?php echo $_SESSION["rol_id"] ?>.jpg">
	                        </button>
	                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
	                            <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-user"></span>Profile</a>
	                            <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-cog"></span>Settings</a>
	                            <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-question-sign"></span>Help</a>
	                            <div class="dropdown-divider"></div>
	                            <a class="dropdown-item" href="../Logout/logout.php"><span class="font-icon glyphicon glyphicon-log-out"></span>Cerrar Sesion</a>
	                        </div>
	                    </div>
	
<!-- 	                    <button type="button" class="burger-right">
	                        <i class="font-icon-menu-addl"></i>
	                    </button> -->
	                </div><!--.site-header-shown-->
	
	                <div class="mobile-menu-right-overlay"></div>

					<input type="hidden" id="user_idx" value="<?php echo $_SESSION["usu_id"] ?>"> 
					<input type="hidden" id="rol_idx" value="<?php echo $_SESSION["rol_id"] ?>">
					
					<div class="dropdown dropdown-typical">
						<a href="#" class="dropdown-toggle no-arr">
							<span class="front-icon font-icon-user"></span>
							<span class="lblcontactonomx"><?php echo $_SESSION["usu_nom"]?> <?php echo $_SESSION["usu_ape"]?></span>
						</a>
					</div>


	                </div><!--.site-header-collapsed-->
	            </div><!--site-header-content-in-->
	        </div><!--.site-header-content-->
	    </div><!--.container-fluid-->
	</header><!--.site-header-->
