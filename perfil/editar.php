<div class="page-sidebar-wrapper">
	<div class="page-sidebar-wrapper">
		<?php 
		$activeClass = strtolower($_GET["s"]);
		include 'menu.php';
		?>
	</div>
</div>
<!-- END SIDEBAR -->
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					<?=ucfirst(separar($_GET["s"]));?> <small><?=ucfirst($_GET["a"]);?></small>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="home.php?s=dashboard">Dashboard</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#"><?=ucfirst(separar($_GET["s"]));?></a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#"><?=ucfirst($_GET["a"]);?></a>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-globe"></i><?=ucfirst($_GET["a"]);?> <?=ucfirst(separar($_GET["s"]));?>
							</div>
						</div>
						<?php
						$usuario = $db->get("s_usuarios", "*",["s_id" => $_GET["id"]]);
						?>
						<?php
						$error = isset($_GET["e"])?$_GET["e"]:"";
						if ( $error == 1 ) {
						?>
						
						<?php	
						}
						?>
						<div class="portlet-body form">
							<form class="form-horizontal" action="<?=strtolower($_GET["s"]);?>/funciones.php?s=<?=$_GET["a"];?>&id=<?=$_GET["id"];?>" method="post" role="form">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Usuario</label>
										<div class="col-md-9">
											<input type="text" name="txtUsuario" value="<?=$_SESSION["usuario"]["nombre"]?>" disabled="disabled" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Nueva Clave</label>
										<div class="col-md-9">
											<input type="password" name="txtPassword" value="" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Repita su Nueva Clave</label>
										<div class="col-md-9">
											<input type="password" name="txtRePassword" value="" class="form-control">
										</div>
									</div>
								</div>

								<div class="form-actions right">
									<button type="submit" class="btn btn-success">Editar</button>
								</div>

							</form>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
</div>

<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->