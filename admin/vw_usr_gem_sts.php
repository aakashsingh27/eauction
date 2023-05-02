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
<h2 class="mt-30 page-title">All User Game Status</h2>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active">All User Game Status</li>
</ol>


<div class='col-md-12 table table-responsive'>
    <table class='table'>
        
        <tr>
            <th>Sno.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
          
          
            <th>Wallet Amount</th>
             <th>Register Date</th>
         
             
         <th>Game Status</th>
        
        </tr>
        
    <?php 
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
            $us_gem_sts=$clct_usr_lst['game_status'];
                    
                    
                    
                    
           
    
    ?><tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $us_nem;?></td>
        <td><?php echo $us_eml;?></td>
        <td><?php echo $us_mbl;?></td>
        
       
        <td><?php echo $us_wllt_amt;?></td>
        <td><?php echo $us_rgt_dt;?></td>
     
        <td>
            <form action='' method='POST'>
                <select name='gem_sts'>
                    <option value='<?php echo $us_gem_sts?>'><?php echo $us_gem_sts?></option>
                    <option value='active'>active</option>
                    <option value='deactive'>deactive</option>
                    </select>
                    <input type='hidden' name='us_id' value="<?php echo $us_id?>">
                <input type='submit' value='submit' name='gme_sts'>
 </form>
                
                
        </td>
        
           
        </tr>
        
        
        
        
        <?php
    }
    ?>
        
        
    </table>
    </div>

<?php 
if(isset($_POST['gme_sts']))
{
 $uuss_id= $_POST['us_id'];  
 $gem_stts=$_POST['gem_sts'];
 
 
 $upd_usr="update users set game_status='$gem_stts' where user_id='$uuss_id'";
 $qst_upd_usr=$db->query($upd_usr);
 if($qst_upd_usr)
 {
     echo "<script>window.alert('Status updated successfully');window.location='';</script>";
 }
 
 
}

?>


</div>
</main>

<?php include 'footer.php'; 

ob_flush();

?>