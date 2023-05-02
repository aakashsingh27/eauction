<?php 
@ob_start();
include('config/config.php');
if(isset($_GET['id']))
{
    $urr_id=$_GET['id'];
    
    $dlt_usr="delete from users where user_id='$urr_id' ";
    $qst_dlt_usr=$db->query($dlt_usr);
    if($qst_dlt_usr)
    {
        echo "<script>window.alert('User Deleted successfully');
                      window.location='users_list.php';</script>";
    }
}
ob_flush();

?>