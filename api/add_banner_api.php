<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 


include("config.php");




$targetfolder = "slider/";
$file_name=$_FILES['doc']['name'];
$targetfolder = $targetfolder . basename( $_FILES['doc']['name']) ;
move_uploaded_file($_FILES['doc']['tmp_name'], $targetfolder);

$ad_usr="insert into slider set
slider_image='$file_name'";

$qst_ad_usr=$db->query($ad_usr);
if($qst_ad_usr)
{
    echo json_encode(["status"=>true,"response"=>"Slider added successfully"]);
}
else
{
    echo json_encode(["status"=>false,"response"=>"Went something wrong"]);
    
}


   
?>