<?php 
		    $cid = $_GET['cid'];
			$consulta_mysql="SELECT cid,cons_no,ship_name,email
				FROM courier_online 
				WHERE  cid=cid";
				$resultado_consulta_mysql=mysql_query($consulta_mysql);	
				while($row=mysql_fetch_array($resultado_consulta_mysql)){
						$fechai=date('Y-m-d');

			?>	
		  <div id="con-close-modal-status-online<?php echo $row[cid]; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">				
					<div class="modal-content">
					<form action="settings/add_courier_online/update_status.php" method="post" name="frmShipment" id="frmShipment">
						<div class="modal-header"> 
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
							<h3 class="modal-title"><?php echo $actualizarestadoenvioon; ?></h3> 
						</div>
						<div class="modal-body">
							<div class="row"> 
								<div class="col-md-4" style="display:none"> 
									<div class="form-group"> 
										<label for="field-6" class="control-label">Empleado</label> 
										<input type="text" class="form-control" id="field-6"  name="deliveruser" value="<?php echo $_SESSION['user_name'] ;?>" readonly> 
									</div> 
								</div>
								<div class="col-md-8" style="display:none"> 
									<div class="form-group"> 
										<label for="field-6" class="control-label">Cliente</label> 
										<input type="text" class="form-control" id="field-6"  name="ship_name" value="<?php echo $row['ship_name']; ?>" readonly> 
									</div> 
								</div>
								<div class="col-md-2" style="display:none"> 
									<div class="form-group">
									<label for="field-5" class="control-label">id</label> 									
										<input type="text" class="form-control" id="field-5"  name="cid" value="<?php echo $row['cid']; ?>" readonly> 
									</div> 
								</div> 
								<div class="col-md-4" style="display:none"> 
									<div class="form-group"> 
										<label for="field-6" class="control-label">Tracking</label> 
										<input type="text" class="form-control" id="field-6"   name="cons_no" value="<?php echo $row['cons_no']; ?>" readonly> 
									</div> 
								</div>
								<div class="col-md-6" style="display:none"> 
									<div class="form-group"> 
										<label for="field-6" class="control-label">Email Cliente</label> 
										<input type="text" class="form-control" id="field-6"   name="email" value="<?php echo $row['email']; ?>" readonly> 
									</div> 
								</div>					
								<div class="col-md-6"> 
									<div class="form-group">
									<label for="field-5" class="control-label"><i class="fa fa-sort-amount-asc icon text-default-lter"></i>&nbsp;<?php echo $ESTADO; ?></label> 									
										<select class="form-control" name="status" id="status">
											<?php
													$sql=mysql_query("SELECT servicemode FROM service_mode  GROUP BY servicemode");
													while($row=mysql_fetch_array($sql)){
													if($cliente==$row['servicemode']){
													echo '<option value="'.$row['servicemode'].'" selected>'.$row['servicemode'].'</option>';
													}else{
													echo '<option value="'.$row['servicemode'].'">'.$row['servicemode'].'</option>';
												 }
												}
											?>
										</select>
									</div> 
								</div> 
								<div class="col-md-6"> 
									<div class="form-group"> 
										<label for="field-6" class="control-label"><i class="fa fa-calendar icon text-default-lter"></i>&nbsp;<?php echo $FECHAPREVISTA; ?></i></label> 
										<input type="text" class="form-control" name="deliverydate" value="<?php echo $fechai; ?>" id="datepicker-autoclose" required> 
									</div> 
								</div>
								
								
								<div class="col-md-12"> 
									<div class="form-group"> 
										<label for="field-6" class="control-label"><i class="fa fa-file-text-o icon text-default-lter"></i>&nbsp;<?php echo $COMENTARIOENVIO; ?></i></label> 
										<textarea class="form-control" name="comments" placeholder="<?php echo $cometarioestadoonline; ?>"  required ></textarea>	
									</div> 
								</div>												
							</div>  
						</div>						
						<div class="modal-footer">
							<button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button> 
							<input class="btn btn-success" name="Submit" type="submit"  value="Update Shipment">
						</div>
					</form>	
					</div>				
				</div>
			</div><!-- /.modal -->
			<?php } ?>