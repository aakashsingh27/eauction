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
<h2 class="mt-30 page-title">All Withdraw Request</h2>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active">All Withdraw Request</li>
</ol>


<div class='col-md-12 table table-responsive'>
    <table class='table'>
        
        <tr>
            <th>Sno.</th>
            <th>Date</th>
            <th>User name</th>
            <th>Account number</th>
            <th>Ifsc Code</th>
            <th>Bank name</th>
            <th>A/c holder name</th>
            <th>Request Amount</th>
            <th>Paytm number</th>
            <th>Google pay number</th>
            <th>Phone pay number</th>
            <th>Payment Method</th>
            <th>Action</th>
              
            
        </tr>
        
    <?php 
    $usr_lst="select * from withdraw_request";
    $qst_usr_lst=$db->query($usr_lst);
    $sno=1;
    while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
    {
$ac_nbr=$clct_usr_lst['ac_number'];
$ifc=$clct_usr_lst['ifsc'];
$bnk_nem=$clct_usr_lst['bank_name'];
$ac_hld_nem=$clct_usr_lst['ac_hld_nme'];
$amnt=$clct_usr_lst['amount'];
$pytm_nbr=$clct_usr_lst['pay_tm'];
$gpy_nbr=$clct_usr_lst['google_pay'];
$ph_py_nbr=$clct_usr_lst['phone_pay'];
$py_mthd=$clct_usr_lst['payment_method'];
$usr_id=$clct_usr_lst['user_id'];
$dtte=$clct_usr_lst['date'];
$sts=$clct_usr_lst['status'];



$strrr=$clct_usr_lst['deactive_reason'];


    
    $iid=$clct_usr_lst['id'];
    
    $usr_dtl="select * from users where user_id='$usr_id'";
    $qst_usr_dtl=$db->query($usr_dtl);
    $clct_usr_dtl=$qst_usr_dtl->fetch_assoc();
    
    $us_nemm=$clct_usr_dtl['full_name'];
    
    
    ?><tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $dtte;?></td>
        <td><?php echo $us_nemm;?></td>
        <td><?php echo $ac_nbr;?></td>
        <td><?php echo $ifc;?></td>
        <td><?php echo $bnk_nem;?></td>
        
        
        <td><?php echo $ac_hld_nem;?></td>
        <td><?php echo $amnt;?></td>
        <td><?php echo $pytm_nbr;?></td>
        <td><?php echo $gpy_nbr;?></td>
        <td><?php echo $ph_py_nbr;?></td>
        <td><?php echo $py_mthd;?></td>
        
        <td><form action='' method='POST'><input type='hidden' value='<?php echo $iid ?>' name="iiid"><select name='py_sts'><option value="<?php echo $sts?>"><?php echo $sts?> </option><option value="active">active</option><option value="reject">reject</option></select>
        
        <input type='text' placeholder='Enter Deactive reason' value="<?php echo $strrr?>" name='dactive'>
        
        <input type='submit' value="update" name='upd_sts'></form></td>
        
        
 
        </tr>
        
        
        
        
        <?php
    }
    
    
    if(isset($_POST['upd_sts']))
    {
        
        $pym_sts=$_POST['py_sts'];
        $usrc_id=$_POST['iiid'];
        $usr_dect=$_POST['dactive'];
        
        $updt_wdr_st="update withdraw_request set status='$pym_sts',deactive_reason='$usr_dect' where id='$usrc_id'";
        $qst_updt_wdr_st=$db->query($updt_wdr_st);
        
        
        if($qst_updt_wdr_st)
        {
        echo "<script>window.alert('Status Updated Successfully');window.location='';</script>";
        
        }
    }
    
    
    
    ?>
        
        
    </table>
    </div>




</div>
</main>

<?php include 'footer.php'; 

ob_flush();

?>