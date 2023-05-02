<?php
@ob_start();
require_once 'config/config.php';
// $action = $_POST['submit'];
if (isset($_SESSION['ibc'])) {
header("location: index.php");
}
if (isset($_POST['admin_login'])) {
$a_email = $_POST['a_email'];
$a_password = $_POST['a_password'];
$results = $db->query("SELECT * FROM `add_liquidator` WHERE liquidator_email='$a_email' AND liquidator_password='$a_password'");
$row_select = $results->fetch_object();
$a_name = $row_select->liquidator_name;
$a_email = $row_select->liquidator_email;




$whois = $a_name;
// if ($a_name == 'Admin') {
//     $a_name = 'You have';
// } else {
//     $a_name = $a_name . ' has';
// }
$num_rows = $results->num_rows; //mysqli_num_rows($results);
if ($num_rows > 0) {
session_start();
$sid = session_id();
$_SESSION['ibc'] = $sid;
$_SESSION['logintype'] = $row_select->liquidator_name; // set user type
$_SESSION['a_id'] = $row_select->id;
$_SESSION['a_email'] = $row_select->liquidator_email;
$_SESSION['a_name'] = $row_select->liquidator_name;
$db->close();
header("Location:index.php");
exit;
} else {

echo "<script>window.location='login.php';window.alert('Wrong credentials please try again.');</script>";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="Cabelo Clinic" content="">
<meta name="Cabelo Clinic" content="">
<title>Online auction Liquidator</title>
<link href="css/styles.css" rel="stylesheet">
<link href="css/admin-style.css" rel="stylesheet">

<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-sign" style="background:black !important;">
<div id="layoutAuthentication">
<div id="layoutAuthentication_content">
<main>
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-5">
<div class="card shadow-lg border-0 rounded-lg mt-5">
<div class="card-header card-sign-header">
    <h3 class="text-center font-weight-light my-4"><span style="color:blue;font-weight:bold">E-AUCTION</span> <BR>Liquidator LOGIN</h3>
   

</div>
<div class="card-body">
<form method="POST" action="">
<div class="form-group">
<label class="form-label" for="inputEmailAddress">Email*</label>
<input class="form-control py-3" id="inputEmailAddress" name="a_email" type="email" placeholder="Enter email address">
</div>
<div class="form-group">
<label class="form-label" for="inputPassword">Password*</label>
<input class="form-control py-3" id="inputPassword" name="a_password" type="password" placeholder="Enter password">
</div>

<div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
<input type="submit" name="admin_login" class="btn btn-sign hover-btn" value="Login" />
</div>
</form>
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

<?php ob_flush();?>
</html>