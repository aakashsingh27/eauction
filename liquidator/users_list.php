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
<h2 class="mt-30 page-title">All Users List</h2>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active">All Users List</li>
</ol>


<div class='col-md-12 table table-responsive'>
    <table class='table'>
        
        <tr>
            <th>Sno.</th>
            <th>Name</th>
           <!-- <th>Email</th>-->
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
    $usr_lst="select * from users where user_name IS NOT NULL";
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
           
           
           
           $slt_dtl="select * from users where invite_code='$us_jn_rffrl'";
           $qst_slt_dtl=$db->query($slt_dtl);
           $clct_slt_dtl=$qst_slt_dtl->fetch_assoc();
           
           $us_ndm=$clct_slt_dtl['user_name'];

    ?><tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $us_nem;?></td>
       <!-- <td><?php //echo $us_eml;?></td>-->
        <td><?php echo $us_mbl;?></td>
        <td><?php echo $us_jn_rffrl;?> (<?php echo $us_ndm?>)</td>
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
    <td><a href='dlt_usr.php?id=<?php echo $us_id?>'><button type='button' class='btn btn-danger'><i class='fa fa-trash'></i></button></td>
        
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
    }
    ?>
        
        
    </table>
    </div>




</div>
</main>

<?php include 'footer.php'; 

ob_flush();

?>