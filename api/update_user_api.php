<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 


include("config.php");

if(isset($_POST['id']))
{
$neme=$_POST['name'];
$emnl=$_POST['email'];
$mbel=$_POST['mobile'];
$iid=$_POST['id'];

$ad_usr="update users set
name='$neme',
email='$emnl',
mobile='$mbel' where id='$iid'";

$qst_ad_usr=$db->query($ad_usr);
if($qst_ad_usr)
{
    echo json_encode(["status"=>true,"response"=>"User Updated successfully"]);
}
else
{
    echo json_encode(["status"=>false,"response"=>"Went something wrong"]);
    
}

}
else
{
    echo json_encode(["status"=>false,"response"=>"Wrong parameteres"]);
}
   
?>