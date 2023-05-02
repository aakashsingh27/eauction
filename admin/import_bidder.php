<?php
include 'config/config.php';
if(isset($_POST["Import"])){
		
$lqdtr_id=$_POST['lqd_id'];

$stes=$_POST['sttes'];
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
	          
	          $uiid=rand(999999,9999999999);
	          $pswd=rand(9999,99999);
	          
	          
	          
	          
	          
	          //It wiil insert a row to our subject table from our csv file`
	          
	          $clt_dtl="select * from  newbidder_login where `uid`='$uiid'";
	          $qst_clt_dtl=$db->query($clt_dtl);
	          $cnt_clt_Dtl=mysqli_num_rows($qst_clt_dtl);
	          if($cnt_clt_Dtl==0)
	          {
	           $sql = "INSERT into newbidder_login (`uid`,`Bidder_Name`, `Bidder_Email`, `bidder_mobile`,`bidder_add_by_liquiditor_id`, `Bidder_Password`,`status`) 
	            	values('$uiid','$emapData[0]','$emapData[1]','$emapData[2]','$lqdtr_id','$pswd','$stes')";
	         //we are using mysql_query function. it returns a resource on true else False on error
	          $result = mysqli_query( $db, $sql );
				if(! $result )
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"view_bdrs.php\"
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