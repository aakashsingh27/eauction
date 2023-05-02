<?php
include"config.php";
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


if(isset($_GET['id']))
{
$usr_iid=$_GET['id'];
$job_sql="select * from users where id='$usr_iid'";
$result_sql=$db->query($job_sql);
$clt_cnt=mysqli_num_rows($result_sql);
if($clt_cnt==1)
{
    $fetch_usr=$result_sql->fetch_assoc();

$usr_neme=$fetch_usr['name'];

    echo json_encode(["status"=>true , "response"=>"$usr_neme"]);
}
else if($clt_cnt==0)
{
    echo json_encode(["status"=>false , "response"=>"Wrong ID"]);
}
}
else
{
    echo json_encode(["status"=>false , "response"=>"Wrong parameters"]);
}
    ?>