<?php
	session_start();
	include_once "../database.php";
	include_once "filtro/funciones.php";
	include_once "filtro/class/class.php";;
	include_once "filtro/class_buscar.php";
	$filtro=$_GET['filtro'];
	if($filtro!=''){

		$sql = "SELECT * FROM tbl_clients WHERE name='".$filtro."'";
		$rs  = mysql_query($sql,$dbConn);
		if(mysql_num_rows($rs)!=0){
			if($row=mysql_fetch_assoc($rs)){
				echo '<div class="col-sm-6 form-group">
							<label  class="control-label">DIRECCIÓN<span class="required-field">*</span></label>
							<input type="text"  name="Shipperaddress" id="Shipperaddress"class="form-control"  autocomplete="off" required value="'.$row['address'].' >
						</div>
						
						<div class="col-sm-3 form-group">
							<label  class="control-label"><i class="fa fa-phone icon text-default-lter"></i>&nbsp;TELÉFONO</label>
							<input type="tel" class="form-control" name="Shipperphone" id="Shipperphone" autocomplete="off" required value="'.$row['phone'].'>
						</div>
						
						<div class="col-sm-3 form-group">
							<label class="control-label">CÉDULA</i></label>
							<input type="text" name="Shippercc" id="Shippercc"class="form-control"  autocomplete="off" required value="'.$row['company'].'>
						</div>
						<div class="col-sm-3 form-group">
							<label class="text-info"><i class="fa fa-angle-double-right icon text-default-lter"></i>&nbsp;<strong>PAÍS ORIGEN</strong></label>															
								<input    name="Pickuptime" class="form-control" autocomplete="off" required value="'.$row['country'].'" > 														  							
						</div>
						<div class="col-sm-3 form-group">
							<label class="text-info"><strong>CÓDIGO</strong></label>															    
								<input   name="iso"  class="form-control" autocomplete="off" required value="'.$row['iso'].'>  
																
						</div>	
						<div class="col-sm-3 form-group">
							<label class="text-info"><strong>CIUDAD</strong></label>  
								<input  type="text"  name="ciudad"   class="form-control" autocomplete="off" required value="'.$row['state'].'> 								
						</div>';
			}else{
				echo '	<div class="col-sm-6 form-group">
						<label  class="control-label">DIRECCIÓN<span class="required-field">*</span></label>
						<input type="text"  name="Shipperaddress" id="Shipperaddress"class="form-control"  autocomplete="off" required placeholder="Dirección Remitente" >
					</div>
					
					<div class="col-sm-3 form-group">
						<label  class="control-label"><i class="fa fa-phone icon text-default-lter"></i>&nbsp;TELÉFONO</label>
						<input type="tel" class="form-control" name="Shipperphone" id="Shipperphone" autocomplete="off" required placeholder="Teléfono Remitente">
					</div>
					
					<div class="col-sm-3 form-group">
						<label class="control-label">CÉDULA</i></label>
						<input type="text" name="Shippercc" id="Shippercc"class="form-control"  maxlength="20" placeholder="Cédula Remitente" autocomplete=" off" required>
					</div>
					<div class="col-sm-3 form-group">
						<label class="text-info"><i class="fa fa-angle-double-right icon text-default-lter"></i>&nbsp;<strong>PAÍS ORIGEN</strong></label>															
							<input    name="Pickuptime" class="form-control" id="country" > 														  							
					</div>
					<div class="col-sm-3 form-group">
						<label class="text-info"><strong>CÓDIGO</strong></label>															    
							<input   name="iso"  id="iso" class="form-control">  
															
					</div>	
					<div class="col-sm-3 form-group">
						<label class="text-info"><strong>CIUDAD</strong></label>  
							<input  type="text"  name="ciudad"   class="form-control"> 								
					</div>';
			}
		}else{
			echo '	<div class="col-sm-6 form-group">
					<label  class="control-label">DIRECCIÓN<span class="required-field">*</span></label>
					<input type="text"  name="Shipperaddress" id="Shipperaddress"class="form-control"  autocomplete="off" required placeholder="Dirección Remitente" >
				</div>
				
				<div class="col-sm-3 form-group">
					<label  class="control-label"><i class="fa fa-phone icon text-default-lter"></i>&nbsp;TELÉFONO</label>
					<input type="tel" class="form-control" name="Shipperphone" id="Shipperphone" autocomplete="off" required placeholder="Teléfono Remitente">
				</div>
				
				<div class="col-sm-3 form-group">
					<label class="control-label">CÉDULA</i></label>
					<input type="text" name="Shippercc" id="Shippercc"class="form-control"  maxlength="20" placeholder="Cédula Remitente" autocomplete=" off" required>
				</div>
				<div class="col-sm-3 form-group">
					<label class="text-info"><i class="fa fa-angle-double-right icon text-default-lter"></i>&nbsp;<strong>PAÍS ORIGEN</strong></label>															
						<input    name="Pickuptime" class="form-control" id="country" > 														  							
				</div>
				<div class="col-sm-3 form-group">
					<label class="text-info"><strong>CÓDIGO</strong></label>															    
						<input   name="iso"  id="iso" class="form-control">  
														
				</div>	
				<div class="col-sm-3 form-group">
					<label class="text-info"><strong>CIUDAD</strong></label>  
						<input  type="text"  name="ciudad"   class="form-control"> 								
				</div>';
		}

	}else{
		echo '	<div class="col-sm-6 form-group">
				<label  class="control-label">DIRECCIÓN<span class="required-field">*</span></label>
				<input type="text"  name="Shipperaddress" id="Shipperaddress"class="form-control"  autocomplete="off" required placeholder="Dirección Remitente" >
			</div>
			
			<div class="col-sm-3 form-group">
				<label  class="control-label"><i class="fa fa-phone icon text-default-lter"></i>&nbsp;TELÉFONO</label>
				<input type="tel" class="form-control" name="Shipperphone" id="Shipperphone" autocomplete="off" required placeholder="Teléfono Remitente">
			</div>
			
			<div class="col-sm-3 form-group">
				<label class="control-label">CÉDULA</i></label>
				<input type="text" name="Shippercc" id="Shippercc"class="form-control"  maxlength="20" placeholder="Cédula Remitente" autocomplete=" off" required>
			</div>
			<div class="col-sm-3 form-group">
				<label class="text-info"><i class="fa fa-angle-double-right icon text-default-lter"></i>&nbsp;<strong>PAÍS ORIGEN</strong></label>															
					<input    name="Pickuptime" class="form-control" id="country" > 														  							
			</div>
			<div class="col-sm-3 form-group">
				<label class="text-info"><strong>CÓDIGO</strong></label>															    
					<input   name="iso"  id="iso" class="form-control">  
													
			</div>	
			<div class="col-sm-3 form-group">
				<label class="text-info"><strong>CIUDAD</strong></label>  
					<input  type="text"  name="ciudad"   class="form-control"> 								
			</div>';
	}

?>


