<?php
@ob_start();
//session_start();
require_once 'config/config.php';
require_once 'config/helper.php';

date_default_timezone_set("Asia/Kolkata");
$cr_dt_ymd=date('Y-m-d');



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
<h2 class="mt-30 page-title">All Manager Users List</h2>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active">All manager Users List</li>
</ol>


<div class='col-md-12 table table-responsive'>
    <table class='table'>
        
        <tr>
            <th>Sno.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Join By Refferal Code</th>
            <th>Invite Code</th>
            <th>Wallet Amount</th>
             <th>Register Date</th>
            <th>Daily Trade Profit</th>
              <th>Action</th>
         <th>User Status</th>
        
        </tr>
        
        
        
        
        
        
        
        
    <?php
    
    //manage code start
    
   
/*

if($rfrf_cnt >=15 and $ttl_sm_amtn>=50000 and $ttl_wlt_bsns>=150000 and $dly_trd_prft_dt<$cr_dt_ymd)*/
    //manager code end
    
    
    
$usr_lst="select * from users";
    $qst_usr_lst=$db->query($usr_lst);
    $sno=1;
    while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
    {
        $us_nem=$clct_usr_lst['user_name'];
         $us_eml=$clct_usr_lst['user_email'];
          $us_mbl=$clct_usr_lst['user_mobile'];
           $us_jn_rffrl=$clct_usr_lst['join_by_refferal'];
           $us_invt_cd=$clct_usr_lst['invite_code'];
           $us_rgt_dt=$clct_usr_lst['create_date'];
            $us_wllt_amt=$clct_usr_lst['wallet_amount'];
                   $us_dly_trd_prft=$clct_usr_lst['daily_auto_trade_profit'];
                   
                     
                     $us_id=$clct_usr_lst['user_id'];
                     
                          $us_sts=$clct_usr_lst['status'];

$drct_mmbr="select count(user_id) as drt_mmbr from users where join_by_refferal='$us_invt_cd'";
$qst_drct_mmbr=$db->query($drct_mmbr);
$clct_drct_mmbr=$qst_drct_mmbr->fetch_assoc();

 $ttl_drty_mmbr=$clct_drct_mmbr['drt_mmbr'];
                     
     $drc_wlt_sm_mmbr="select sum(wallet_amount) as us_wllt_amt from users where join_by_refferal='$us_invt_cd'";
$qst_drc_wlt_sm_mmbr=$db->query($drc_wlt_sm_mmbr);
$clct_drc_wlt_sm_mmbr=$qst_drc_wlt_sm_mmbr->fetch_assoc();

$ttl_wlt_bsns=$clct_drc_wlt_sm_mmbr['us_wllt_amt'];
                
       $sm_amt="select sum(amount) as sm_amnt from online_payment where client_id='$us_id'";
$qst_sm_amt=$db->query($sm_amt);
$clct_sm_amt=$qst_sm_amt->fetch_assoc();

$ttl_sm_amtn=$clct_sm_amt['sm_amnt'];              
                     
               
          if($ttl_drty_mmbr>=15 and $ttl_sm_amtn>=50000 and $ttl_wlt_bsns>=150000 and $us_dly_trd_prft) 
      {
    
    ?>
    <tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $us_nem;?></td>
        <td><?php echo $us_eml;?></td>
        <td><?php echo $us_mbl;?></td>
        <td><?php echo $us_jn_rffrl;?></td>
        <td><?php echo $us_invt_cd;?></td>
        <td><?php echo $us_wllt_amt;?></td>
        <td><?php echo $us_rgt_dt;?></td>
        <td><?php if($us_dly_trd_prft!='')
        {
        echo "<span style='color:green;font-weight:900;'>Started</span>";
        }
        else 
        {
        echo "<span style='color:red;font-weight:900;'>Not Started";
        }
        ?></td>
    <td><a href='dlt_usr.php?id=<?php echo $us_id?>'>
        <button type='button' class='btn btn-danger'><i class='fa fa-trash'></i></button></a></td>
        
        <td>
              <?php 
              if($us_sts==0)
{
              ?>
                <a href="users_list.php?deactivate=<?php echo $us_id?>" class="btn btn-danger btn-sm">Deactivate</a>
                <?php
}
                ?>
 
              <?php 
              if($us_sts==1)
{
              ?>
                
                <a href="users_list.php?active=<?php echo $us_id?>" class="btn btn-success btn-sm">Active</a>
        <?php 
}
        ?>
        </td>
        
        </tr>
        
        
        
        
        <?php
    }}
    ?>
        
        
    </table>
    </div>




</div>
</main>

<?php include 'footer.php'; 

ob_flush();

?>