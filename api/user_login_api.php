<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 




include("config.php");



if(isset($_POST['user_email']))
{
    $email=$_POST['user_email'];
$mobile=$_POST['user_mobile'];
$clt_dtl="select * from users where `email`='$email' and `mobile`='$mobile'";
$qst_clt_dtl=$db->query($clt_dtl);

$nmbr_rws=mysqli_num_rows($qst_clt_dtl);

if($nmbr_rws==0)
{
echo json_encode(["status"=>true,"response"=>"Wrong cridentials please try again","cred"=>"0"]);
}
else if($nmbr_rws==1)
{

$clt_ftch=$qst_clt_dtl->fetch_assoc();
$usr_id=$clt_ftch['id'];



echo json_encode(["status"=>true,"response"=>"$usr_id","cred"=>"1"]);

}
}
else
{
    echo json_encode(["status"=>true,"response"=>"Invalid parametres","cred"=>""]);
}
?>