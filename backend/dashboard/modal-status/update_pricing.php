<?php 
		    $cid = $_GET['cid'];
			$consulta_mysql="SELECT *
			FROM courier 
			WHERE  cid=cid";
			$resultado_consulta_mysql=mysql_query($consulta_mysql);	
			while($row=mysql_fetch_array($resultado_consulta_mysql)){											
			?>
		  <div id="update_price<?php echo $row[cid]; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">				
					<div class="modal-content">
					<form action="settings/add_courier/update_amount.php" method="post" name="frmShipment" id="frmShipment">
						<div class="modal-header"> 
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
							<h3 class="modal-title">Edit Amount Details</h3> 
						</div> 
						<div class="modal-body">
							
							
						
					<input type="hidden" class="form-control" id="field-5" name="cid" value="<?php echo $row['cid']; ?>"  > 		
						
							 <div class="row"> 
                <div class="col-md-6"> 
                  <div class="form-group"> 
                    <label for="field-3" class="control-label">Total Amount</label> 
                    <input type="text" class="form-control" id="field-6" name="t_price" value="<?php echo $row['shipping_subtotal']; ?>"  > 
                  </div> 
                </div> 
        
                <div class="col-md-6"> 
                  <div class="form-group"> 
                    <label for="field-3" class="control-label">Advanced Amount</label> 
                    <input type="text" class="form-control" id="field-6" name="a_price" value="<?php echo $row['advance_price']; ?>" > 
                  </div> 
                </div> 
                
                <div class="col-md-6"> 
                  <div class="form-group"> 
                    <label for="field-3" class="control-label">Pending Amount</label> 
                    <input type="text" class="form-control" id="field-6" name="p_price" value="<?php echo $row['pending_price']; ?>" > 
                  </div> 
                </div> 
                
                <div class="col-md-6"> 
                  <div class="form-group"> 
                    <label for="field-3" class="control-label">Select Payment Mode</label> 
                 
                    
                    <select name="payment_mode" class="control-label">
                       
  <option class="control-label" value="Bank transfer (cash payment)">Bank transfer (cash payment)</option>
  <option class="control-label" value="Bitcoin">Bitcoin </option>
  <option class="control-label" value="PayPal">PayPal</option>
  <option class="control-label" value="Credit card">Credit card</option>
</select>
                  </div> 
                </div> 

 </div> 

						</div> 
						<div class="modal-footer"> 
							<button type="button" class="btn btn-white" data-dismiss="modal"><?php echo $cerrar; ?></button> 
							<input name="submit" type="submit" class="btn btn-info" value="Update">
						</div>
					</form>	
					</div>				
				</div>
			</div><!-- /.modal -->
			<?php } ?>