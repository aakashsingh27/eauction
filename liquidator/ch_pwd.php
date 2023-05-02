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
$comp_select = $db->query("SELECT * FROM `admin` where a_id='$a_idchk'");
$comp_fetch = $comp_select->fetch_assoc();
$old_pwsd=$comp_fetch['a_password'];

$a_new=$comp_fetch['a_name'];


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
<h2 class="mt-30 page-title">Change Password</h2>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active">Change Password</li>
</ol>

  
  
  
  
  <div class="card-body">
<form action='' method='POST'>

  <div class="form-group">
<label class="form-label" for="inputPasswordOld">Name*</label>
<input class="form-control py-3" id="inputPasswordOld" name='nme' type="text" placeholder="Enter name" value="<?php echo $a_new?>" required>
</div>
  
  <div class="form-group">
<label class="form-label" for="inputPasswordOld">Old Password*</label>
<input class="form-control py-3" id="inputPasswordOld" name='old_pwd' type="password" placeholder="Enter old password" required>
</div>
<div class="form-group">
<label class="form-label" for="inputPasswordNew">New Password*</label>
<input class="form-control py-3" id="inputPasswordNew" name='nw_pwd' type="password" placeholder="Enter new password" required>
</div>
<div class="form-group">
<label class="form-label" for="inputPasswordNewConfirm">Confirmation Password*</label>
<input class="form-control py-3" id="inputPasswordNewConfirm" name='cnfrm_pwd' type="password" placeholder="Enter New confirmation password" required>
</div>
<div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
<button type='submit' name='submit' class="btn btn-sign hover-btn">Change Password</button>
</div>
</form>
  <?php 
if(isset($_POST['submit']))
  {
  $old_pwd=$_POST['old_pwd'];  
   $nw_pwd=$_POST['nw_pwd'];  
   $nw_c_pwd=$_POST['cnfrm_pwd'];  
  $neem=$_POST['nme'];
  $nw_md_pwd=md5($nw_pwd);
  if(md5($old_pwd)==$old_pwsd)
    {
    
    if($nw_pwd==$nw_c_pwd)
      {
      
      $udt_pwd="update admin set a_password='$nw_md_pwd',a_name='$neem' where a_id='$a_idchk'";
      $qst_udt_pwd=$db->query($udt_pwd);
      if($qst_udt_pwd)
        {
       echo "<script>window.alert('Password Updated Successfully');</script>"; 
      }
    }
    else {
      
       echo "<script>window.alert('Password and confirm password not match !');</script>";
    }
    
  }
  else
    {
    echo "<script>window.alert('Old Password is not match !');</script>";
  }
  
  }
  
  ?>

</div>

  
  
  
  
</div>
</main>

<?php include 'footer.php'; 

ob_flush();

?>