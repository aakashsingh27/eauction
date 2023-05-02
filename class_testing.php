<?php 
class log
{
public function createlog($database,$page_name,$action,$user_id)
{

	date_default_timezone_set("Asia/kolkata"); 

	$det_tem=date('Y-m-d H:i:s');

	$arr_cnt= count($database);

if($arr_cnt >=4)
{
$host=$database[0];
	$user=$database[1];
	$pass=$database[2];
	$dtb=$database[3];

	$db=mysqli_connect($host,$user,$pass,$dtb);

	//table name should be static ==log
$tbl_cnt="SHOW TABLES LIKE 'log'";
$qst_tbl_cnt=$db->query($tbl_cnt);
$tbll_ccnt=mysqli_num_rows($qst_tbl_cnt);


 if($tbll_ccnt == 0)
{
$create_table="CREATE TABLE `log` (
	`id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	`page_name` varchar(500) DEFAULT NULL,
	`action` varchar(500) DEFAULT NULL,
	`user_id` varchar(500) DEFAULT NULL, 
	`remark` varchar(500) DEFAULT NULL
  )";

  $qst_create_table=$db->query($create_table);
  if($qst_create_table)
  {
	$flag=1;
  }
  
}
else if($tbll_ccnt == 1)
{
	$flag=1;
}
if($flag==1)
  {
	$crt_dtl="insert into log set page_name='$page_name',action='$action',user_id='$user_id',date_time='$det_tem'";
	$qst=$db->query($crt_dtl);

return true;
  }

}
else
{

return false;
}
  
}
}	 
 ?>


