<?php 
@ob_start();
include("config/config.php");

if (!empty($_SESSION['ibc'])) {
if ($_SESSION['ibc'] != session_id()) {
header('Location: change_password.php');
exit;
}
} else {
header('Location: login.php');
exit;
}
$logintype = $_SESSION['logintype'];
$a_idchk = $_SESSION['a_id'];

$comp_select = $db->query("SELECT * FROM `admin` where a_id='$a_idchk'");
$comp_fetch = $comp_select->fetch_assoc();
$old_pwsd=$comp_fetch['a_password'];

?>
<!DOCTYPE html>
<html lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description-gambolthemes" content="">
<meta name="author-gambolthemes" content="">
<title>Gambo Supermarket Admin</title>
<link href="css/styles.css" rel="stylesheet">
<link href="css/admin-style.css" rel="stylesheet">

<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-sign">
<div id="layoutAuthentication">
<div id="layoutAuthentication_content">
<main>
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-5">
<div class="card shadow-lg border-0 rounded-lg mt-5">
<div class="card-header card-sign-header">
<h3 class="text-center font-weight-light my-4">Change Password</h3>
</div>
<div class="card-body">
<form action='' method='POST'>
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
  
  $nw_md_pwd=md5($nw_pwd);
  if(md5($old_pwd)==$old_pwsd)
    {
    
    if($nw_pwd==$nw_c_pwd)
      {
      
      $udt_pwd="update admin set a_password='$nw_md_pwd' where a_id='$a_idchk'";
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
</div>
</div>
</div>
</main>
</div>
</div>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js"></script>
</body>


</html>
<?php 

ob_flush();
?>