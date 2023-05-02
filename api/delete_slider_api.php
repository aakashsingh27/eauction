<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 


include("config.php");

if(isset($_GET['id']))
{

$iid=$_GET['id'];




$ad_usr="delete  from slider where id='$iid'";

$qst_ad_usr=$db->query($ad_usr);
if($qst_ad_usr)
{
    echo json_encode(["status"=>true,"response"=>"slider Deleted successfully"]);
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