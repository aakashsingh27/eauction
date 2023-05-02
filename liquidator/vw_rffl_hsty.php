<?php
@ob_start();
//session_start();
require_once 'config/config.php';
require_once 'config/helper.php';





if (isset($_GET['active'])) {
    
    $activate = $_GET['active'];
    $sql=$db->query("UPDATE users SET status='0' WHERE user_id=$activate ");
    echo "<script>alert(' Deactivate Successfully.'); window.location = 'users_list.php';</script>";
}
if (isset($_GET['deactivate'])) {
    $deactivate = $_GET['deactivate'];
    $sql1=$db->query("UPDATE users SET status='1' WHERE user_id=$deactivate");
    echo "<script>alert('Activate Successfully.'); window.location = 'users_list.php';</script>";
}






if (!empty($_SESSION['ibc'])) {
if ($_SESSION['ibc'] != session_id()) {
header('Location: index.php');
exit;
}
} else {
header('Location: login.php');
exit;
}
$logintype = $_SESSION['logintype'];
$a_idchk = $_SESSION['a_id'];

$ausernmae = $_SESSION['a_name'];
ob_start("ob_html_compress");
$comp_select = $db->query("SELECT * FROM `admin`");
$comp_fetch = $comp_select->fetch_object();
$a_company = $comp_fetch->a_company;
$check_a_name = $_SESSION['a_name'];
function facebook_time_ago($timestamp)
{
$time_ago = strtotime($timestamp);
$current_time = time();
$time_difference = $current_time - $time_ago;
$seconds = $time_difference;
$minutes      = round($seconds / 60);           // value 60 is seconds
$hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec
$days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;
$weeks          = round($seconds / 604800);          // 7*24*60*60;
$months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60
$years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60
if ($seconds <= 60) {
return "Just Now";
} else if ($minutes <= 60) {
if ($minutes == 1) {
return "one minute ago";
} else {
return "$minutes minutes ago";
}
} else if ($hours <= 24) {
if ($hours == 1) {
return "an hour ago";
} else {
return "$hours hrs ago";
}
} else if ($days <= 7) {
if ($days == 1) {
return "yesterday";
} else {
return "$days days ago";
}
} else if ($weeks <= 4.3) //4.3 == 52/12
{
if ($weeks == 1) {
return "a week ago";
} else {
return "$weeks weeks ago";
}
} else if ($months <= 12) {
if ($months == 1) {
return "a month ago";
} else {
return "$months months ago";
}
} else {
if ($years == 1) {
return "one year ago";
} else {
return "$years years ago";
}
}
}
?>

<?php include 'header.php'; ?>
<?php

?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<h2 class="mt-30 page-title">Refferal history</h2>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active">Refferal history</li>
</ol>

 <div class='table table-responsive border mt-5' >
    <table class='table table-bordered'>
        
        <tr>
            <th>Sno</th>
            
            <th>Date</th>
            
            <th>Name</th>
            <th>Refferal Code</th>
            <th>join Code</th>
            
            <th>Add Amount</th>
            <th>Join User Profit Amount</th>
            <th>Refferal User Profit Amount</th>
        </tr>
        
        <?php 
        $rfl_lst="select * from refferal_history ";
        $qst_rfl_lst=$db->query($rfl_lst);
    $sn=1;
        while($clct_rfl_lst=$qst_rfl_lst->fetch_assoc())
        {
    
    $jn_usr_rf_cd=$clct_rfl_lst['refferal_code'];
    $date=$clct_rfl_lst['date'];
       $jn_by_usr=$clct_rfl_lst['join_code'];
    
    $usr_nem="select * from users where invite_code='$jn_usr_rf_cd'";
    $qst_usr_nem=$db->query($usr_nem);
    $clct_usr_nem=$qst_usr_nem->fetch_assoc();
    
$us_nnm=$clct_usr_nem['full_name'];
    
    
    
    
     $aded_amnt=$clct_rfl_lst['add_amont'];
      $prft_amnt=$clct_rfl_lst['profit_amount'];
       $yr_prft_amnt=$clct_rfl_lst['join_by_user_amt'];
    
     ?>
        
        
        <tr>
            <td><?php echo $sn++; ?></td>
            <td><?php echo $date;?></td>
           
            <td><?php echo $us_nnm; ?></td>
             <td><?php echo $jn_usr_rf_cd;?></td>
             <td><?php echo $jn_by_usr;?></td>
            <td><?php echo $aded_amnt?></td>
            <td><?php echo $prft_amnt?></td>
            <td><?php echo $yr_prft_amnt?></td>
            
        </tr>
        
       <?php 
        }
        ?>
        
    </table>
    </div>




</div>
</main>

<?php include 'footer.php'; 

ob_flush();

?>