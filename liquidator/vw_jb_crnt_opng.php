<?php
@ob_start();
//session_start();
require_once 'config/config.php';
require_once 'config/helper.php';




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
<h2 class="mt-30 page-title">All Result List</h2>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active">All Result List</li>
</ol>


<div class='col-md-12 table table-responsive'>
    <table class='table'>

<tr>
<th>Sno.</th>

<th>Title</th>
<th>Content</th>
<th>Action</th>

</tr>

<?php 
$usr_lst="select * from current_opening";
$qst_usr_lst=$db->query($usr_lst);
$sno=1;
while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
{
$jb_cnct=$clct_usr_lst['content'];

$prd_id=$clct_usr_lst['id'];
$rest_ttl=$clct_usr_lst['title'];

?><tr>
<td><?php echo $sno++;?></td>
<td><?php echo $rest_ttl;?></td>
<td><?php echo $jb_cnct;?></td>

<td><a href='edt_jb_cncnt.php?id=<?php echo $prd_id?>' class='btn btn-success'>Edit</a> <a href='dlt_jb.php?id=<?php echo $prd_id?>' class='btn btn-danger'>Delete</a></td>


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