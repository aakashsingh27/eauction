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


$actn_id=$_GET['id'];
?>

<?php include 'header.php'; ?>
<!----upper link start---->

<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<!----Upper links end---------------------->
<?php

?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<h2 class="mt-30 page-title">Dashboard</h2>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active">Dashboard</li>
</ol>

<?php 
if($usr_typ==1)
{
?>
<div class="row">
<div class='col-md-12'>
<center>
<h1>View bid details</h1>

</center>

<div class='row'>
    
    <div class='col-md-12'>
 <button type="button" class="btn btn-warning" onclick="window.history.back()" style="float: right;margin-bottom: 15px;">Back</button>
    </div>
</div>

<div class='col-md-12 table table-responsive'>
    <table class='table' id='myTable'>
        <thead>
        
<tr>

<th>sno</th>
<th>Auction name</th>
<th>Auction ID</th>
<th>Bid Amount</th>
<th>User UID</th>
<th>Date and Time</th>
<th>Ip Address</th>
</tr>
</thead>
<tbody>

    <?php 


$slt_sle_ntc_dtl="select * from create_sale where id='$actn_id'";
$qst_slt_sle_ntc_dtl=$db->query($slt_sle_ntc_dtl);
$clct_slt_sle_ntc_dtl=$qst_slt_sle_ntc_dtl->fetch_assoc();

$auciton_nem=$clct_slt_sle_ntc_dtl['Title'];



    $usr_lst="select * from livebidding where salenotice_id='$actn_id'";
    $qst_usr_lst=$db->query($usr_lst);
    $sno=1;
    while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
    {

        $rsrv_prec=$clct_usr_lst['reserver_Price'];
        $hgst_bid=$clct_usr_lst['highestBid'];
        $nxt_bid=$clct_usr_lst['nextBid'];
        $bdr_id=$clct_usr_lst['bidder_fid'];
        $incrmnt_vlu=$clct_usr_lst['incremental_val'];
        $ip_adrs=$clct_usr_lst['ipaddress'];
        $det_tem=$clct_usr_lst['datetime'];
        

$clt_bdr_dtl="select * from newbidder_login where id='$bdr_id'";
$qst_clt_bdr_dtl=$db->query($clt_bdr_dtl);
$clct_clt_bdr_dtl=$qst_clt_bdr_dtl->fetch_assoc();

$bdr_nem=$clct_clt_bdr_dtl['Bidder_Name'];
$bdr_uid=$clct_clt_bdr_dtl['uid'];

    ?><tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $auciton_nem;?></td>
        <td><?php echo $actn_id;?></td>
        <td><?php echo $hgst_bid;?></td>
        <td><?php echo $bdr_uid;?></td>
        <td><?php echo $det_tem;?></td>
        <td><?php echo $ip_adrs;?></td>
        
        </tr>
 
        <?php
    }
    ?>
        
</tbody>
    </table>
    </div>
</div>




</div>
<?php 
}
?>
</div>
</main>

<!-------------Downlink and script start--------------->


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<?php 
?>
<script>
    $(document).ready( function () {
         $('#myTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        
    } );
} );
    </script>

<!-------------Downlink and script end----------->

<?php include 'footer.php'; 

ob_flush();

?>