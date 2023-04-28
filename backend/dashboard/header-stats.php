     <?php if(isset($_SESSION['user_name']) && $_SESSION['user_type'] == 'Administrator') { ?>
	  <!-- stats -->
      <div class="row">

        <div class="col-md-5">
          <div class="row row-sm text-center">
            <div class="col-xs-6">
				<?php
					// Always first connect to the database mysql
					$sql = "SELECT * FROM courier WHERE  status='In_Transit' ";  // sentence sql
					$result = mysql_query($sql);
					$numero1 = mysql_num_rows($result); // get the number of rows
				?>
              <div class="panel padder-v item">
                <div class="h1 text-success font-thin h1"><?php echo $numero1; ?></div>
                <span class="text-muted text-xs"><?php echo $ENVIOSENTRANSITO; ?></span>
                <div class="top text-right w-full">	
				  <i class="icon-plane text-success m-r-sm"></i>				  
                </div>
              </div>
            </div>
            <div class="col-xs-6">
			<?php
				// Always first connect to the database mysql
				$sql = "SELECT * FROM courier_online WHERE  status='In_Transit' ";  // sentence sql
				$result = mysql_query($sql);
				$numero2 = mysql_num_rows($result); // get the number of rows
			?>
              <a href="online-bookings.php" class="block panel padder-v bg-primary item">
                <span class="text-white font-thin h1 block"><?php echo $numero2; ?></span>
                <span class="text-muted text-xs"><?php echo $RESERVAONLINE; ?></span>
                <span class="bottom text-right w-full">
				  <i class="icon-envelope-open text-muted m-r-sm"></i>
                </span>
              </a>
            </div>
            <div class="col-xs-6">
              <a href class="block panel padder-v bg-info item">
                <span class="text-white font-thin h1 block">
				<?php echo $_SESSION['ge_curr']; ?><span data-plugin="counterup"><?php
				$result = mysql_query("SELECT SUM(shipping_subtotal	) as total FROM courier WHERE book_mode='Debit_card'");   
				$row = mysql_fetch_array($result, MYSQL_ASSOC);
				echo $s.formato($row["total"]);	
					
				?></span></span>
                <span class="text-muted text-xs"><?php echo $ENVIOPAGOTD; ?></span>
                <span class="top">
				  <i class="icon-credit-card text-warning m-l-sm m-r-sm"></i>
                </span>
              </a>
            </div>
            <div class="col-xs-6">
              <div class="panel padder-v item">
                <div class="font-thin h1">
				<?php echo $_SESSION['ge_curr']; ?><span data-plugin="counterup"><?php
				$result = mysql_query("SELECT SUM(shipping_subtotal	) as total FROM courier WHERE book_mode='Credit_card'");   
				$row = mysql_fetch_array($result, MYSQL_ASSOC);
				echo $s.formato($row["total"]);	
					
				?></span></div>
                <span class="text-muted text-xs"><?php echo $ENVIOPAGOTC; ?></span>
                <div class="bottom">
				  <i class="icon-rocket text-danger m-l-sm m-r-sm"></i>
                </div>
              </div>
            </div>
            <div class="col-xs-6 m-b-md">
              <div class="r bg-light dker item hbox no-border">
                <div class="col dk padder-v r-r">
                  <div class="text-primary-dk font-thin h1"><span>
				 <?php echo $_SESSION['ge_curr']; ?><span data-plugin="counterup"><?php
					$result = mysql_query("SELECT SUM(shipping_subtotal	) as total FROM courier WHERE book_mode='Effective'");   
					$row = mysql_fetch_array($result, MYSQL_ASSOC);
					echo $s.formato($row["total"]);	
					?></span></div>
                  <span class="text-muted text-xs"><?php echo $ENVIOPAGOTE; ?></span>				  
                </div>
              </div>
            </div>
			<div class="col-xs-6 m-b-md">
              <div class="r bg-light dker item hbox no-border">
                <div class="col dk padder-v r-r">
                  <div class="text-primary-dk font-thin h1"><span>
				  <?php echo $_SESSION['ge_curr']; ?><span data-plugin="counterup"><?php
					$result = mysql_query("SELECT SUM(shipping_subtotal	) as total FROM courier WHERE book_mode='Transfer'");   
					$row = mysql_fetch_array($result, MYSQL_ASSOC);
					echo $s.formato($row["total"]);	
					?></span></div>
                  <span class="text-muted text-xs"><?php echo $PAGOSTRANSFERENCIA; ?></span>				  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="panel wrapper">
            <h4 class="font-thin m-t-none m-b text-muted"><?php echo $graficaventa; ?></h4>

				<div class="table-responsive">
					 <div id="curve_chart" style="width: 900px; height: 246px"></div>
				</div>	
				  <!-- the chart code -->
          </div>
        </div>
      </div>
      <!-- / stats -->
	 <?php } ?>