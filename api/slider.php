<?php
include"config.php";
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$alluser = array();
$job_sql="select * from slider";
$result_sql=$db->query($job_sql);
while($fetch_sql=$result_sql->fetch_assoc()){
$id=$fetch_sql['id'];
$image=$fetch_sql['slider_image'];
$response['id']=$id;
$response['image']=$image;
   //$response=$fetch_sql;
array_push($alluser,$response);
}
echo json_encode($alluser);

?>