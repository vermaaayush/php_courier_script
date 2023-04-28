<?php
// *************************************************************************
// *                                                                       *
// * DEPRIXA -  logistics Worldwide Software                               *
// * Copyright (c) JAOMWEB. All Rights Reserved                            *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: osorio2380@yahoo.es                                            *
// * Website: http://www.jaom.info                                         *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.                              *
// * If you Purchased from Codecanyon, Please read the full License from   *
// * here- http://codecanyon.net/licenses/standard                         *
// *                                                                       *
// *************************************************************************
 
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	session_start();
	require_once('database.php');
	require_once('database-settings.php');

     $today_date=date("Y-m-d");
     
     #echo $today_date;
    
     $x =  mysql_query("SELECT * FROM temp_courier_track WHERE future_date='$today_date' ");
     
     if(mysql_num_rows($x)>0){   
         
  
          
          while($row = mysql_fetch_array($x))
          {
    $id=  $row['id'];        
              
	$cid = $row['cid'];
    $cons_no = $row['cons_no'];
	$pre = $row['letra'];
	$pick_time = $row['pick_time'];

	$status = $row['status'];
	$comments = $row['comments'];
	$rev_name = $row['rev_name'];
	$email = $row['email'];
	$user = $row['user'];
	$t=$row['t'];
	$d=$row['d'];

	
   $sql = "INSERT INTO courier_track (cid, cons_no, letra, pick_time, status, comments, bk_time, rev_name, email, user, t, d)
			VALUES ($cid, '$cons_no', '$pre', '$pick_time | $citaddress', '$status', '$comments', NOW(), '$rev_name', '$email', '$user','$t', '$d')";
	         dbQuery($sql);
	         
	         
	         
	    $sql_1 = "UPDATE courier SET status='$status' WHERE cid = $cid AND cons_no = '$cons_no'";
        	dbQuery($sql_1);     
	         
  
	         
	         
      
	         
	    $sql_2 = "DELETE FROM temp_courier_track WHERE id = '$id'";
        	dbQuery($sql_2);           
	         
	         
	         
	         
	         
	         
	         
	         
	         
	         
	
		  }
         
     }
     
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
?>