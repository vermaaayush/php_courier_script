<?php 
		    $cid = $_GET['cid'];
			$consulta_mysql="SELECT cid,cons_no,deliveryboy,drs,receivedby
			FROM courier_online 
			WHERE  cid=cid";
			$resultado_consulta_mysql=mysql_query($consulta_mysql);	
			while($row=mysql_fetch_array($resultado_consulta_mysql)){											
			?>	
		  <div id="con-close-modal-online<?php echo $row[cid]; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">				
					<div class="modal-content">
					<form action="settings/add_courier_online/status_courier.php" method="post" name="frmShipment" id="frmShipment">
						<div class="modal-header"> 
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
							<h3 class="modal-title"><?php echo $actualizarestadoenvio; ?></h3> 
						</div>
						<div class="modal-body">
							<div class="row">  
								<div class="col-md-12">
									<div class="form-group">
										<div class="alert alert-danger alert-dismissible fade in" role="alert">
											<button type="button" class="close" data-dismiss="alert"
													aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h5><?php echo $importante; ?></h5>
										</div>
									</div>	
								</div>
							</div>
							
							<div class="row" style="display:none">  
								<div class="col-md-2"> 
									<div class="form-group">
									<label for="field-5" class="control-label">id</label> 									
										<input type="text" class="form-control" id="field-5" name="cid" value="<?php echo $row['cid']; ?>" readonly> 
									</div> 
								</div> 
								<div class="col-md-4"> 
									<div class="form-group"> 
										<label for="field-6" class="control-label">Tracking</label> 
										<input type="text" class="form-control" id="field-6"   value="<?php echo $row['cons_no']; ?>" readonly> 
									</div> 
								</div>
								<div class="col-md-6"> 
									<div class="form-group"> 
										<label for="field-6" class="control-label">Empleado</label> 
										<input type="text" class="form-control" id="field-6" name="deliveruser" value="<?php echo $_SESSION['user_name'] ;?>" readonly> 
									</div> 
								</div> 								
							</div> 
							<div class="row"> 
								<div class="col-md-6"> 
									<div class="form-group"> 
										<label for="field-1" class="control-label"><?php echo $REPARTIDOR; ?>:</label> 
										<input type="text"  name="deliveryboy" placeholder="<?php echo $commentsrepartidor; ?>" class="form-control" required>
									</div> 
								</div> 
								<div class="col-md-6"> 
									<div class="form-group"> 
										<label for="field-2" class="control-label"><?php echo $CEDULA; ?>:</label> 
										<input type="text" class="form-control" name="drs" placeholder="<?php echo $numbercedula; ?>"> 
									</div> 
								</div> 
							</div> 
							<div class="row"> 
								<div class="col-md-12"> 
									<div class="form-group"> 
										<label for="field-2" class="control-label"><?php echo $RECIBE; ?>:</label> 
										<input type="text" class="form-control" name="receivedby" placeholder="<?php echo $nameclient; ?>" >
									</div> 
								</div> 
							</div>  
						</div>
						
						<div class="col-md-6">
							<img src="img/delivery_time.png" border="0" height="80" width="122"></a>
						</div>							
						<div class="modal-footer">
							<button type="button" class="btn btn-white" data-dismiss="modal"><?php echo $cerrar; ?></button> 
							<input class="btn btn-success" name="Submit" type="submit"  value="<?php echo $delivershipment; ?>">
						</div>
						
					</form>	
					</div>				
				</div>
			</div><!-- /.modal -->
			<?php } ?>