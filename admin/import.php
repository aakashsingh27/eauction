<?php
include 'config/config.php';
if(isset($_POST["Import"])){
		

		echo $filename=$_FILES["file"]["tmp_name"];
		

		 if($_FILES["file"]["size"] > 0)
		 {
$count=0;
		  	$file = fopen($filename, "r");
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
				$count++;	
	    if($count > 1)
	    {
	          //It wiil insert a row to our subject table from our csv file`
	          
	          $clt_dtl="select * from  add_liquidator where `liquidator_email`='$emapData[1]'";
	          $qst_clt_dtl=$db->query($clt_dtl);
	          $cnt_clt_Dtl=mysqli_num_rows($qst_clt_dtl);
	          if($cnt_clt_Dtl==0)
	          {
	           $sql = "INSERT into add_liquidator (`liquidator_name`, `liquidator_email`, `mobile`, `liquidator_password`,liquidator_address, `liquidator_address2`, `input_city`, `input_state`, `input_zip`) 
	            	values('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]','$emapData[6]','$emapData[7]','$emapData[8]')";
	         //we are using mysql_query function. it returns a resource on true else False on error
	          $result = mysqli_query( $db, $sql );
				if(! $result )
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"index.php\"
						</script>";
				
				}
				
}
	    }
		}
		
	         fclose($file);
	         //throws a message if data successfully imported to mysql database from excel file
	         echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"index.php\"
					</script>";
	        
			 

			 //close of connection
			mysqli_close($db); 
	
			
		 }
	}	 
?>		 