<?php 
include('config/config.php');
$id=$_POST['txt1'];

$dlt_llqdtr="delete from add_liquidator where id='$id'";
$qst_dlt_llqdtr=$db->query($dlt_llqdtr);




?>