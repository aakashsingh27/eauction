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



<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<?php

?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<!--<h2 class="mt-30 page-title">All Bidders Request</h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">All Bidders Request</li>
</ol>

<div class='col-md-12 table table-responsive' style="
    border: none !important;">
    <table class='table' id='myTable' style="border: 2px solid black !important;">
    <thead>   
<tr>

<th style="border-bottom:2px solid black !important;">Sno</th>

<th style="border-bottom:2px solid black !important;">Liquidator Name</th>
<th style="border-bottom:2px solid black !important;">Name</th>
<th style="border-bottom:2px solid black !important;">Email</th>
<th style="border-bottom:2px solid black !important;">Mobile</th>
<th style="border-bottom:2px solid black !important;">Password</th>
<th style="border-bottom:2px solid black !important;">Request For Bid</th>
<th style="border-bottom:2px solid black !important;">Bid Start Date</th>
<th style="border-bottom:2px solid black !important;">Bid End Date</th>
<th style="border-bottom:2px solid black !important;">Action</th>

</tr>
</thead>
<tbody>  
    <?php 
    $usr_lst="select * from newbidder_login where otp IS NOT NULL and Bidder_Name IS NOT NULL";
    $qst_usr_lst=$db->query($usr_lst);
    $sno=1;
    while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
    {
$sel_ntec_id=$clct_usr_lst['register_for_sale_notice_id'];

$uuid=$clct_usr_lst['uid'];
$bdr_mbl=$clct_usr_lst['bidder_mobile'];
$bdr_nem=$clct_usr_lst['Bidder_Name'];
$bdr_emnl=$clct_usr_lst['Bidder_Email'];
$bfr_pswd=$clct_usr_lst['Bidder_Password'];
$bbdr_id=$clct_usr_lst['id'];

$rqt_apprvl=$clct_usr_lst['request_approval'];

$lqdter_iid=$clct_usr_lst['bidder_add_by_liquiditor_id'];


$clt_lqdtr_dtl="select * from add_liquidator where id='$lqdter_iid'";
$qst_clt_lqdtr_dtl=$db->query($clt_lqdtr_dtl);

$clct_clt_lqdtr_dtl=$qst_clt_lqdtr_dtl->fetch_assoc();

$lqddter_neem=$clct_clt_lqdtr_dtl['liquidator_name'];
$lqdtter_emnl=$clct_clt_lqdtr_dtl['liquidator_email'];

$clt_sel_netc_dtl="select * from create_sale where id='$sel_ntec_id'";
$qst_clt_sel_netc_dtl=$db->query($clt_sel_netc_dtl);
$clct_clt_sel_netc_dtl=$qst_clt_sel_netc_dtl->fetch_assoc();

$sel_notc_ttl=$clct_clt_sel_netc_dtl['Title'];

$strt_det_acttn=$clct_clt_sel_netc_dtl['Start_Date_Auction'];
$end_ddet_acctn=$clct_clt_sel_netc_dtl['End_Date_Auction'];
    ?>
<tr>
<td><?php echo $sno++;?></td>
<td><?php echo $lqddter_neem;?> (<?php echo $lqdtter_emnl;?>)</td>
<td><?php echo $bdr_nem;?></td>
<td><?php echo $bdr_emnl;?></td>
<td><?php echo $bdr_mbl;?></td>
<td><?php echo $bfr_pswd;?></td>
<td><?php echo $sel_notc_ttl;?></td>

<td><?php echo $strt_det_acttn;?></td>
<td><?php echo $end_ddet_acctn;?></td>



<td>
<?php 
if($rqt_apprvl ==NULL)
{
?>
<a href='apprv_request.php?sel_ntec_id=<?php echo $sel_ntec_id;?>&bdr_id=<?php echo $bbdr_id;?>&lqdtr_id=<?php echo $lqdter_iid;?>' class='btn btn-primary'>Approve</a> 



 <form action='diaprv_rqst.php' method="POST"><input type='text' name="dsaprv_rsn" placeholder='Enter disapprove reason' required style="
    height: 38px;
    margin-top: 15px;
"> <input type='text' name='sale_notice_id' value="<?php echo $sel_ntec_id;?>" style="display:none"><input type='hidden' name='bedr_id' value="<?php echo $bbdr_id;?>" style="display:block;"><button type='submit' name='dsaprv'class='btn btn-danger'>Disapprove</button></form>




<?php 
}
else
{
?>
<a href='#' class='btn btn-success'><?php echo $rqt_apprvl;?></a> 
<?php

}

?>
</td>

</tr>
    
        
        
        
        <?php
    }
    ?> </tbody>
        
        
    </table>
    </div>




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

<?php include 'footer.php'; 

ob_flush();

?>