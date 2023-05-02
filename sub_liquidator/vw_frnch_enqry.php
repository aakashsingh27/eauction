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
<h2 class="mt-30 page-title">Frenchise Enquiry</h2>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active">Frenchise Enquiry</li>
</ol>


<div class='col-md-12 table table-responsive'>
    <table class='table'>
        
<tr>
<th>Sno.</th>
<th>Date</th>
<th>Customer name</th>
<th>Customer Email</th>
<th>Customer mobile</th>
<th>Customer gender</th>
<th>City</th>
<th>Service name</th>


</tr>
        
    <?php 
    $usr_lst="select * from frenchise_enquiry";
    $qst_usr_lst=$db->query($usr_lst);
    $sno=1;
    while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
    {
        $nem=$clct_usr_lst['name'];
         $eml=$clct_usr_lst['email'];
          $mbl=$clct_usr_lst['number'];
        //  $mssg=$clct_usr_lst['message'];
             $gndddr=$clct_usr_lst['gender'];
          $ccty=$clct_usr_lst['city'];
          $srvc_nem=$clct_usr_lst['service'];
          $deet=$clct_usr_lst['date'];
          

         
    ?><tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $deet;?></td>
        <td><?php echo $nem;?></td>
        <td><?php echo $eml;?></td>
        <td><?php echo $mbl;?></td>
        <td><?php echo $gndddr;?></td>
        <td><?php echo $ccty;?></td>
        <td><?php echo $srvc_nem;?></td>

     
        
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