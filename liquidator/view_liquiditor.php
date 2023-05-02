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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

<th>sno</th>
<th>Liquidator Name</th>
<th>Liquidator Email</th>
<th>Liquidator Password</th>
<th>Liquidator address</th>
<th>Liquidator address 2</th>
<th>City</th>
<th>State</th>
<th>Pincode</th>
<th>Action</th>

</tr>
        
    <?php 
    $usr_lst="select * from add_liquidator ";
    $qst_usr_lst=$db->query($usr_lst);
    $sno=1;
    while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
    {
        $lqdtr_nem=$clct_usr_lst['liquidator_name'];
        $lqdtr_emnl=$clct_usr_lst['liquidator_email'];
        $lqdtr_pwd=$clct_usr_lst['liquidator_password'];
        $lqdtr_adrs=$clct_usr_lst['liquidator_address'];
        $lqdtr_adrs_tw=$clct_usr_lst['liquidator_address2'];
        $inpty_cty=$clct_usr_lst['input_city'];
        $inpt_stet=$clct_usr_lst['input_state'];
        $inpt_zp=$clct_usr_lst['input_zip'];
       $iid=$clct_usr_lst['id'];
        

    ?><tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $lqdtr_nem;?></td>
       <!-- <td><?php //echo $us_eml;?></td>-->
        <td><?php echo $lqdtr_emnl;?></td>
        <td><?php echo $lqdtr_pwd;?></td>
        <td><?php echo $lqdtr_adrs;?></td>
        <td><?php echo $lqdtr_adrs_tw;?></td>
        <td><?php echo $inpty_cty;?></td>
        
        <td><?php echo $inpty_cty;?></td>
        
        <td>
             <?php echo $inpt_stet;?>
        </td>
        <td><a href='edt_lqdtor.php?id=<?php echo $iid;?>' class='btn btn-danger'>Edit</a><br> <a href='#' onclick='dlt_lqdtr(<?php echo $iid;?>);' value='' class='btn btn-primary mt-2' >Delete</a></td>
        
        </tr>
        
        
        
        
        <?php
    }
    ?>
        
        
    </table>
    </div>




</div>
</main>

<script>
    
    
    function dlt_lqdtr(txt)
    {
        var txt1=txt;
        alert(txt1);

 $.ajax({
url: "dlt_lqdtor.php",
type: "POST",
data    : {txt1:txt1},
cache: false,
success: function(data){
Swal.fire({

icon: 'success',
title: 'Your work has been saved',
showConfirmButton: false,
timer: 1500
});
window.location='';

}
});

       




    }
    
   
    </script>

<?php include 'footer.php'; 

ob_flush();

?>