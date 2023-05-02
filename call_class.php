<?php 
include('class_testing.php');

//------table data start--------->
$tablesname="log";
$page_name="add_result.php";
$action="ADD";
$user_id="24";
//--------table data end------------->

//--------database details start--------------------->
$host="localhost";
$user="root";
$pass="";
$db="auction";

$database = array($host,$user,$pass,$db);
//----------database details end----------------------->

//call class start  host details shuld be in one variable var( myCon=host^|user^|pass^|db)

//method name (CreateLog(con,page,action,user))
$class_object = new log();
$class_object -> createlog($database,$page_name,$action,$user_id);
//call class end
?>