<?php
include"config.php";
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if(isset($_GET['id']))
{

$iid=$_GET['id'];

$job_sql="select * from users where id='$iid'";
$result_sql=$db->query($job_sql);
$fetch_sql=$result_sql->fetch_assoc();
          $id   =  $fetch_sql['id'];
         $name      = $fetch_sql['name'];
         $email   = $fetch_sql['email'];
         $mobile   = $fetch_sql['mobile'];
   //$response=$fetch_sql;
  
echo json_encode(['status'=>true,'id'=>$id,'name'=>$name,'email'=>$email,'mobile'=>$mobile]);
}
else
{
echo json_encode(['status'=>false,'response'=>"Wrong parameteres"]);

}
?>