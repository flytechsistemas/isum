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
			
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					<?=ucfirst(separar($_GET["s"]));?> <small> </small>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="home.php?s=inscripciones">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="home.php?s=<?=strtolower($_GET["s"]);?>"><?=ucfirst(separar($_GET["s"]));?></a>
							<i class="fa fa-angle-right"></i>
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
								<i class="fa fa-picture"></i><?=ucfirst(separar($_GET["s"]));?>
							</div>
						</div>
						<?php
						$datos = $db->get("s_inscripciones", "*", ["CEDULA" => $_SESSION["usuario"]["cedula"]]);
						?>
						<form action="#" class="form-horizontal">
							<div class="form-body">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label col-md-3">Alumno:</label>
											<div class="col-md-9">
												<p class="form-control-static"><?=$datos["CEDULA"];?></p>
											</div>
										</div>
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<div class="col-md-9">
												<p class="form-control-static"><?=$datos["NOMBRE"];?></p>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label col-md-3">Carrera:</label>
											<div class="col-md-9">
												<p class="form-control-static"><?=$datos["CARRERA"];?></p>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label col-md-3">Mencion:</label>
											<div class="col-md-9">
												<p class="form-control-static"><?=$datos["MENCION"];?></p>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label col-md-3">Turno:</label>
											<div class="col-md-9">
												<p class="form-control-static"><?=$datos["TURNO"];?></p>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label col-md-3">Periodo:</label>
											<div class="col-md-9">
												<p class="form-control-static"><?=$datos["MEDIOPER"];?></p>
											</div>
										</div>
									</div>
								</div>
								<h3 class="form-section">Modalidad de Inscripcion</h3>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label col-md-3">Contado:</label>
											<div class="col-md-9">
												<input type="radio" <?=($datos["MODALIDAD"]==1)?"checked='checked'":"";?>>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label col-md-3">Bs.</label>
											<div class="col-md-9">
												<input type="text" class="form-control" value="<?=$datos["CONTADO"]?>">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label col-md-3">Credito.</label>
											<div class="col-md-9">
												<input type="radio" <?=($datos["MODALIDAD"]==2)?"checked='checked'":"";?>>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label col-md-3">Bs.</label>
											<div class="col-md-9">
												<input type="text" class="form-control" value="<?=$datos["CREDITO"]?>">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label col-md-3">Inicial</label>
											<div class="col-md-9">
												<input type="text" class="form-control" value="<?=$datos["INICIAL"]?>">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label col-md-3"><?=number_format($datos["CTDCUOTAS"],0)?>&nbsp;Cuotas</label>
											<div class="col-md-9">
												<input type="text" class="form-control" value="<?=$datos["CUOTAS"]?>">
											</div>
										</div>
									</div>
								</div>

								<h3 class="form-section">Conceptos asociados a la Inscripcion</h3>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<div class="col-md-6">
												<label class="control-label">Concepto:</label>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<div class="col-md-6">
												<label class="control-label">Valor:</label>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<div class="col-md-6">
												<input type="text" readonly="readonly" class="form-control" value="<?=$datos["OTRO1NOM"]?>">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<div class="col-md-6">
												<input type="text" readonly="readonly" class="form-control" value="<?=$datos["OTRO1MONTO"]?>">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<div class="col-md-6">
												<input type="text" readonly="readonly" class="form-control" value="<?=$datos["OTRO2NOM"]?>">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<div class="col-md-6">
												<input type="text" readonly="readonly" class="form-control" value="<?=$datos["OTRO2MONTO"]?>">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<div class="col-md-6">
												<input type="text" readonly="readonly" class="form-control" value="<?=$datos["OTRO3NOM"]?>">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<div class="col-md-6">
												<input type="text" readonly="readonly" class="form-control" value="<?=$datos["OTRO3MONTO"]?>">
											</div>
										</div>
									</div>
								</div>

								<h3 class="form-section"></h3>
								<?php
								$subTotal = $datos["OTRO1MONTO"] + $datos["OTRO2MONTO"] + $datos["OTRO3MONTO"];
								$totalCuotasPendientes = 1200;
								$saldoFavor = 500;
								$totalPagar = 5000;
								?>
								<div class="row">
									<div class="form-group">
										<label class="control-label col-md-9">Sub Total Inscripcion:</label>
										<div class="col-md-3">
											<p class="form-control-static"><?=nf($subTotal)?></p>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<label class="control-label col-md-9">(+) Total Cuotas Pendientes:</label>
										<div class="col-md-3">
											<p class="form-control-static"><?=nf($totalCuotasPendientes)?></p>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<label class="control-label col-md-9">(-) Saldo a Favor:</label>
										<div class="col-md-3">
											<p class="form-control-static"><?=nf($saldoFavor)?></p>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<label class="control-label col-md-9">Total a Pagar:</label>
										<div class="col-md-3">
											<p class="form-control-static"><?=nf($totalPagar)?></p>
										</div>
									</div>
								</div>
								
								<h3 class="form-section">Pagos realizados con depositos</h3>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<div class="col-md-4">
												<label class="control-label">Banco</label>
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<div class="col-md-2">
												<label class="control-label">Fecha</label>
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<div class="col-md-2">
												<label class="control-label"></label>
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<div class="col-md-2">
												<label class="control-label">Numero</label>
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<div class="col-md-2">
												<label class="control-label">Monto</label>
											</div>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<div class="col-md-1">
												<label class="control-label"></label>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<div class="col-md-10">
												<select <?=disabled($datos["CODBANCO1"])?> name="cboBanco1" class="form-control">
												<?php
												$bancos = $db->select("s_bancos", "*");
												foreach ( $bancos as $banco ) {
												?>
													<option <?=($banco["CODIGO"]==$datos["CODBANCO1"])?"selected":"";?> value="<?=$banco["CODIGO"]?>"><?=$banco["NOMBRE"]?></option>
												<?php
												}
												?>												
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<div class="col-md-8">
												<input type="text" <?=disabled($datos["FECBANCO1"])?> name="txtFecBanco1" class="form-control" value="<?=($datos["FECBANCO1"]=="")?"":date("d-m-Y", strtotime($datos["FECBANCO1"]));?>">
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<div class="col-md-8">
												<input type="checkbox" <?=disabled($datos["EXTBANCO1"])?> <?=($datos["EXTBANCO1"]==1)?"checked='checked'":"";?> name="txtCajaExt1" class="form-control" value="1"> Caja Externa
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<div class="col-md-8">
												<input type="text" <?=disabled($datos["NUMBANCO1"])?> class="form-control" name="txtNumBanco1" value="<?=$datos["NUMBANCO1"]?>">
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<div class="col-md-8">
												<input type="text" <?=disabled($datos["MONBANCO1"])?> class="form-control" name="txtMonBanco1" value="<?=nf($datos["MONBANCO1"])?>">
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<div class="col-md-10">
												<select <?=disabled($datos["CODBANCO2"])?> name="cboBanco2" class="form-control">
												<?php
												$bancos = $db->select("s_bancos", "*");
												foreach ( $bancos as $banco ) {
												?>
													<option <?=($banco["CODIGO"]==$datos["CODBANCO2"])?"selected":"";?> value="<?=$banco["CODIGO"]?>"><?=$banco["NOMBRE"]?></option>
												<?php
												}
												?>												
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<div class="col-md-8">
												<input type="text" <?=disabled($datos["FECBANCO2"])?> name="txtFecBanco2" class="form-control" value="<?=($datos["FECBANCO2"]=="")?"":date("d-m-Y", strtotime($datos["FECBANCO2"]));?>">
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<div class="col-md-8">
												<input type="checkbox" <?=disabled($datos["EXTBANCO2"])?> <?=($datos["EXTBANCO2"]==1)?"checked='checked'":"";?> name="txtCajaExt2" class="form-control" value="1"> Caja Externa
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<div class="col-md-8">
												<input type="text" <?=disabled($datos["NUMBANCO2"])?> class="form-control" name="txtNumBanco2" value="<?=$datos["NUMBANCO2"]?>">
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<div class="col-md-8">
												<input type="text" <?=disabled($datos["MONBANCO2"])?> class="form-control" name="txtMonBanco2" value="<?=nf($datos["MONBANCO2"])?>">
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<div class="col-md-10">
												<select <?=disabled($datos["CODBANCO3"])?> name="cboBanco3" class="form-control">
												<?php
												$bancos = $db->select("s_bancos", "*");
												foreach ( $bancos as $banco ) {
												?>
													<option <?=($banco["CODIGO"]==$datos["CODBANCO3"])?"selected":"";?> value="<?=$banco["CODIGO"]?>"><?=$banco["NOMBRE"]?></option>
												<?php
												}
												?>												
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<div class="col-md-8">
												<input type="text" <?=disabled($datos["FECBANCO3"])?> name="txtFecBanco3" class="form-control" value="<?=($datos["FECBANCO3"]=="")?"":date("d-m-Y", strtotime($datos["FECBANCO3"]));?>">
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<div class="col-md-8">
												<input type="checkbox" <?=disabled($datos["EXTBANCO3"])?> <?=($datos["EXTBANCO3"]==1)?"checked='checked'":"";?> name="txtCajaExt3" class="form-control" value="1"> Caja Externa
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<div class="col-md-8">
												<input type="text" <?=disabled($datos["NUMBANCO3"])?> class="form-control" name="txtNumBanco3" value="<?=$datos["NUMBANCO3"]?>">
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<div class="col-md-8">
												<input type="text" <?=disabled($datos["MONBANCO3"])?> class="form-control" name="txtMonBanco3" value="<?=nf($datos["MONBANCO3"])?>">
											</div>
										</div>
									</div>
								</div>
								<?php
								$totalBanco = $datos["MONBANCO1"] + $datos["MONBANCO2"] + $datos["MONBANCO3"];
								?>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-10">Total Depositos:</label>
											<div class="col-md-2">
												<p class="form-control-static"><?=nf($totalBanco)?></p>
											</div>
										</div>
									</div>
								</div>
						</form>





						
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

<?php
function nf($val) {
	return number_format($val,2,',','.');
}

function disabled($val) {
	if ( ! is_null($val) ) {
		return "disabled='disabled'";
	} else {
		return "";
	}
}
?>

