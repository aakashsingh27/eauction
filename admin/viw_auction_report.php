<?php
@ob_start();
//session_start();
require_once 'config/config.php';
require_once 'config/helper.php';

$actn_id=$_GET['id'];

$sls_notc_id="select * from create_sale where id='$actn_id'";
$qst_sls_notc_id=$db->query($sls_notc_id);
$clct_sls_notc_id=$qst_sls_notc_id->fetch_assoc();

$actn_nem=$clct_sls_notc_id['Title'];
$actn_type=$clct_sls_notc_id['auction_type'];
$actn_strt_det=$clct_sls_notc_id['Start_Date_Auction'];
$end_strt_det=$clct_sls_notc_id['End_Date_Auction'];


$lqdtr_id=$clct_sls_notc_id['create_by_liquiditor_id'];

$lqdtr_dtl="select * from add_liquidator where id='$lqdtr_id'";
$qst_lqdtr_dtl=$db->query($lqdtr_dtl);

$clct_lqdtr_dtl=$qst_lqdtr_dtl->fetch_assoc();

$lqdtr_nem=$clct_lqdtr_dtl['liquidator_name'];

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<!----upper link start---->
<!-- 
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> -->

<!----Upper links end---------------------->
<?php

?>

<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<h2 class="mt-30 page-title">View Bid Details</h2>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active">View Bid Details</li>
</ol>
<div class='col-md-12'>
<a href="#" onclick="asdsd();" class="btn  btn-primary" style="float:right">Generate pdf</a>
</div>
<div id='bdr_report'>
<div class='row' style="margin-bottom: 40px;margin-top: 100px;">
        <div class='col-md-3 col-xs-3'>
           
<img src="logo/Sabreedgelogo.png" style="width:170px;">

</div>
 <div class='col-md-9 col-xs-9' style='padding-top:5px;'>
 <span style="float:right"><b>Create by :-</b> <?php echo $lqdtr_nem?></span><br>
 <span style="float:right"><b>Start date :-</b> <?php echo $actn_strt_det;?></span><br>
<span style="float:right"><b>End date :-</b> <?php echo $end_strt_det;?></span><br>


<hr></hr>

</div> 

</div>

<h3>Winner (Auction type => <?php echo $actn_type;?>)</h3>
<div class='col-md-12 table table-responsive'>
    <table class='table' id='myTable'>
        <thead>
        
<tr>

<th>sno</th>
<th>Auction Id</th>
<th>Auction name </th>
<th>BIdder UID </th>

<th>Heighest BId</th>
<th>Bid date and time</th>

</tr>
</thead>
<tbody>
    <?php 

    if($actn_type=="forward")
    {
    $usr_lst="select max(highestBid) as hgst_bd from livebidding where salenotice_id='$actn_id'";
    $qst_usr_lst=$db->query($usr_lst);
    $sno=1;
    $clct_usr_lst=$qst_usr_lst->fetch_assoc();
    
        $hgest_bid=$clct_usr_lst['hgst_bd'];
       
    }
    else if($actn_type=="reverse")
    {
        $usr_lst="select min(highestBid) as hgst_bd from livebidding where salenotice_id='$actn_id'";
    $qst_usr_lst=$db->query($usr_lst);
    $sno=1;
    $clct_usr_lst=$qst_usr_lst->fetch_assoc();
    
        $hgest_bid=$clct_usr_lst['hgst_bd'];
       
    }
$clt_bdr_dtl="select * from livebidding where highestBid='$hgest_bid'";
$qst_clt_bdr_dtl=$db->query($clt_bdr_dtl);
$clct_clt_bdr_dtl=$qst_clt_bdr_dtl->fetch_assoc();

$bdr_id=$clct_clt_bdr_dtl['bidder_fid'];
$hgst_bd_det_tem=$clct_clt_bdr_dtl['datetime'];

$slt_bdr_dtl="select * from newbidder_login where id='$bdr_id'";
$qst_slt_bdr_dtl=$db->query($slt_bdr_dtl);
$clct_slt_bdr_dtl=$qst_slt_bdr_dtl->fetch_assoc();

$bder_nem=$clct_slt_bdr_dtl['Bidder_Name'];
$bder_uid=$clct_slt_bdr_dtl['uid'];

$bdder_emnl=$clct_slt_bdr_dtl['Bidder_Email'];
$bdder_mbl=$clct_slt_bdr_dtl['bidder_mobile'];


    ?><tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $actn_id;?></td>
        <td><?php echo $actn_nem;?></td>
    
        <td><?php echo $bder_uid;?></td>
        <td><?php echo $hgest_bid;?></td>
        <td><?php echo $hgst_bd_det_tem;?></td>
        
        </tr>
      
        <?php
    
    ?>
        
</tbody>
    </table>
    </div>


    <h3>Bidder Personal Details</h3>
<div class='col-md-12 table table-responsive'>
    <table class='table' id='myTable'>
        <thead>
        
<tr>

<th>sno</th>

<th>Name </th>
<th>BIdder UID </th>

<th>Email Id</th>
<th>Mobile No.</th>

</tr>
</thead>
<tbody>
   <tr><td>1</td>
   <td><?php echo $bder_nem?></td>
   <td><?php echo $bder_uid?></td>
   <td><?php echo $bdder_emnl?></td>
   <td><?php echo $bdder_mbl?></td>




</tr>        
</tbody>
    </table>
    </div>

<h3>Bidders bid</h3>
<div class='col-md-12 table table-responsive'>
    <table class='table' id='myTable'>
        <thead>
        
<tr>

<th>sno</th>
<th>Bid Amount</th>
<th>Bid Date and time </th>

<th>Ip Address</th>

</tr>
</thead>
<tbody>
    <?php 
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
        <td><?php echo $hgst_bid;?></td>
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





<script>
//     $(document).ready( function () {
//          $('#myTable').DataTable( {
//         dom: 'Bfrtip',
//         buttons: [
//             'copy', 'csv', 'excel', 'pdf', 'print'
//         ]
//     } );
// } );
    </script>

<script>
        function asdsd() {
            var pdf = new jsPDF('p', 'pt', 'a3');
           
            source = $('#bdr_report')[0];
    
          
            specialElementHandlers = {
               
                '#bypassme': function (element, renderer) {
                    
                    return true
                }
            };
            margins = {
                top: 80,
                bottom: 60,
                left: 40,
                right:0,
                width: 600
            };
           
            pdf.fromHTML(
                source, 
                margins.left,
                margins.top, {
                    'width': margins.width, 
                    'elementHandlers': specialElementHandlers
                },
    
                function (dispose) {
                   
                    pdf.save('auction_report.pdf');
                }, margins
            );
        }
    </script>

<!-------------Downlink and script end----------->

<?php include 'footer.php'; 

ob_flush();

?>