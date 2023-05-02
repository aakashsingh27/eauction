<?php
@ob_start();
//session_start();
require_once 'config/config.php';
require_once 'config/helper.php';

date_default_timezone_set('Asia/Kolkata');
$timestamp = date("Y-m-d H:i:s");



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

<!----upper link start---->

<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<!----Upper links end---------------------->
<?php

?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<!--<h2 class="mt-30 page-title">Sales Notice</h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;"><h3><strong>Release notes version (1.0)</strong></h3></li>
</ol>



<style>

    @import url('https://fonts.googleapis.com/css?family=Roboto');

body {
  background-color: #FFF;
  font-size: 16px;
  margin: 2em;
  font-family: Roboto;
}
/* wrap it all in a div to make the line shorter */
.wrapper{width: 50%;}

ul {
  padding: 0 0 0 2.75em;
}
ul li {
  list-style: none;
  line-height: 1.7rem;
  position: relative;
  padding-bottom: 1rem;
}

 ul li:before {
  content: "";
  display: inline-block;
  width: .75em;
  height: .75em;
  border-radius: 50%;
  background: brown;
  margin: 0 2em 0 -2.75em;
}
.enter_color{
    padding: 13px;
    font-size: 22px;
    background-color: deepskyblue ;
    border: skyblue;
    color: #fff;
    border-radius: 13px;
    text-decoration: none;
}

.enter_color:hover{
    padding-left:40px;
    padding-right:40px;
    border: black !important;

}


</style>


<div class="row border_design">


      
   <br><br>

<div class='col-md-12'>
<p>In this version we have released below modules :-</p>
</div>
<div class='col-md-12'>

<ul>
	<li>Add Liquidator</li>
	<li>View Liquidator</li>
	<li>Add Company</li>
	<li>View Company</li>
	<li>Assign company to liquidator</li>
	<li>Add Bidder</li>
	<li>View Bidder</li>
	<li>Assign company to a bidder</li>
	<li>View Bidders Request</li>
	<li>Create Sale Notice</li>
	<li>View Sale Notice</li>
	<li>View contact us</li>
	<li>Live bidding</li>
	<li>Closed Bid report</li>
	<li>Start soon bid</li>
	<li>Latest announcements</li>
	<li>Add State</li>
	<li>Add Property type</li>
	<li>View Property Type</li>
	<li>Bidder Login</li>
	<li>Bidder Dashboard</li>
	<li>Bidder Live Bidding page</li>

</ul>
</div>
<div class='col-md-12'>

</div>

<br><br>
<br>







</div>
</main>

<script>
    
    
    function dlt_lqdtr(txt)
    {
        var txt1=txt;
       

 $.ajax({
url: "dlt_lqdtor.php",
type: "POST",
data    : {txt1:txt1},
cache: false,
success: function(data)
{
Swal.fire({

icon: 'success',
title: 'Deleted Successfully',
showConfirmButton: false,
timer: 1500
});
window.location='';

}
});

       




    }
    
   
    </script>

<!-------------Downlink and script start--------------->


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>












<script>
    $(document).ready( function () {
         $('#myTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
    </script>

<!-------------Downlink and script end----------->
<?php include 'footer.php'; 

ob_flush();

?>