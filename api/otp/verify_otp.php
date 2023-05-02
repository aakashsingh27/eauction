<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

include('../config.php');

if(isset($_POST['mobile']))
{
$otp=$_POST['otp'];
$mebl=$_POST['mobile'];

$clt_dplc_mbl="select * from otp_integration where mobile='$mebl' and otp='$otp'";
$qst_clt_dplc_mbl=$db->query($clt_dplc_mbl);
$dplc_mbl_cnt=mysqli_num_rows($qst_clt_dplc_mbl);
if($dplc_mbl_cnt==1)
{

        echo json_encode(["status"=>true , "response"=>"Otp verified successfully","success"=>1]);
}
else
{
   
        echo json_encode(["status"=>true , "response"=>"wrong OTP" ,"success"=>0]);
    
}
}
else
{
    echo json_encode(["status"=>false,"response"=>"Invalid parameters"]);
}
?>