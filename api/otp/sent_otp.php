<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

include('../config.php');

if(isset($_POST['mobile']))
{
$otp=rand(9999,99999);
$mebl=$_POST['mobile'];

$clt_dplc_mbl="select * from otp_integration where mobile='$mebl'";
$qst_clt_dplc_mbl=$db->query($clt_dplc_mbl);
$dplc_mbl_cnt=mysqli_num_rows($qst_clt_dplc_mbl);
if($dplc_mbl_cnt==0)
{
    $add_mbl="insert into otp_integration set
    mobile='$mebl',
    otp='$otp' ";

    $qst_add_mbl=$db->query($add_mbl);
    if($qst_add_mbl)
    {
        echo json_encode(["status"=>true , "response"=>"Otp sent successfully"]);
    }
}
else
{
    $add_mbl="update otp_integration set
    otp='$otp' where  mobile='$mebl'";

    $qst_add_mbl=$db->query($add_mbl);
    if($qst_add_mbl)
    {
        echo json_encode(["status"=>true , "response"=>"Otp sent successfully"]);
    }
}
}
else
{
    echo json_encode(["status"=>false,"response"=>"Invalid parameters"]);
}
?>