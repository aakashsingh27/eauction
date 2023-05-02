<?php
include"config.php";
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$alluser = array();
$job_sql="select * from users";
$result_sql=$db->query($job_sql);
while($fetch_sql=$result_sql->fetch_assoc()){
          $id   =  $fetch_sql['id'];
         $name      = $fetch_sql['name'];
         $email   = $fetch_sql['email'];
         $mobile   = $fetch_sql['mobile'];
		 $profile   = $fetch_sql['profile'];
         
        
            
             $response['id'] = $id;
             $response['name'] = $name;
             $response['email'] = $email;
             $response['mobile'] = $mobile;
			 $response['profile'] = $profile;
            
            
             
    
   //$response=$fetch_sql;
    array_push($alluser,$response);




}
echo json_encode($alluser);

?>