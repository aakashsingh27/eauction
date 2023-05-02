<?php
session_start();
if(isset($_SESSION['bddr_id']))
{
   session_destroy();
echo "<script>window.location='bidder_login.php';</script>";
}
  

?>