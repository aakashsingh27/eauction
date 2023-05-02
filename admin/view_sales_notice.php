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
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Sales Notice</li>
</ol>
<form action='' method="POST">
<div class='row'>
<div class='col-md-4'>
<select id="lqdtsr_id" name='nem_lqdtr' required class='form-control' style="border:1px solid !important;">
    <option value="">-Choose Liquidator-</option>
<?php 
$clt_lqdtr_detl="select * from add_liquidator";
$qst_clt_lqdtr_detl=$db->query($clt_lqdtr_detl);
while($clct_clt_lqdtr_detl=$qst_clt_lqdtr_detl->fetch_assoc())
{
$lqdtr_id=$clct_clt_lqdtr_detl['id'];
$lqdtr_nem=$clct_clt_lqdtr_detl['liquidator_name'];
?>
<option value="<?php echo $lqdtr_id;?>"><?php echo $lqdtr_nem;?></option>
<?php
}
?>
</select>
</div>
<div class='col-md-4'>
    <select name='cemp_id' id='cmp_id' required class='form-control' style="border:1px solid !important;">
        <option value="">-Choose Asset-</option>
    </select>
    
    
</div>
<div class='col-md-4'>
<button type='submit' name="sbmmt" class='btn btn-primary'>Submit</button>

</div>
</div><br>
</form>


<?php 
if(isset($_POST['sbmmt']))
{
$lqdtr_iid=$_POST['nem_lqdtr'];
$coomp_id=$_POST['cemp_id'];

?>
<div class='col-md-12 table table-responsive' style="border: none !important;">
    <table class='table' id='myTable' style="border: 2px solid black !important;">
    <thead>  
<tr>

<th style="border-bottom:2px solid black !important;">Sno</th>

<th style="border-bottom:2px solid black !important;">Title</th>
<th style="border-bottom:2px solid black !important;">company name</th>
<th style="border-bottom:2px solid black !important;">Asset Name</th>
<th style="border-bottom:2px solid black !important;">Liquidator Name</th>
<th style="border-bottom:2px solid black !important;">Auction Type</th>
<th style="border-bottom:2px solid black !important;">Reserved Price</th>
<th style="border-bottom:2px solid black !important;">Increamental Price</th>
<th style="border-bottom:2px solid black !important;">Buffer Time (In Minutes)</th>
<th style="border-bottom:2px solid black !important;">Start Auction Date</th>
<th style="border-bottom:2px solid black !important;">End Auction Date</th>
<th style="border-bottom:2px solid black !important;">PDF</th>

<th style="border-bottom:2px solid black !important;">PDF 2</th>
<th style="border-bottom:2px solid black !important;">PDF 3</th>
<th style="border-bottom:2px solid black !important;">PDF 4</th>
<th style="border-bottom:2px solid black !important;">PDF 5</th>


<th style="border-bottom:2px solid black !important;">Edit</th>
<th style="border-bottom:2px solid black !important;">Delete</th>
<th style="border-bottom:2px solid black !important;">View Live Details</th>
<th style="border-bottom:2px solid black !important;">View Bid Details</th>
<th style="border-bottom:2px solid black !important;">View Bid Report</th>

</tr>
</thead>
   <tbody>    
    <?php 
$usr_lst="select * from create_sale where create_by_liquiditor_id='$lqdtr_iid' and company_id='$coomp_id'";
    $qst_usr_lst=$db->query($usr_lst);
    $sno=1;
    while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
    {
        $bfr_tem=$clct_usr_lst['buffer_time'];
        $title=$clct_usr_lst['Title'];
        $increamental=$clct_usr_lst['Incremental'];
        $rsvrd_prce=$clct_usr_lst['Reserve_Price'];
        $strt_det=$clct_usr_lst['Start_Date_Auction'];
        $end_det=$clct_usr_lst['End_Date_Auction'];
        $sl_ntc_id=$clct_usr_lst['id'];
        $pdf_fel=$clct_usr_lst['Pdf'];

        $pdf_fel1=$clct_usr_lst['pdf2'];
        $pdf_fel2=$clct_usr_lst['pdf3'];
        $pdf_fel3=$clct_usr_lst['pdf4'];
        $pdf_fel4=$clct_usr_lst['pdf5'];

        
         $sper_cmpy_neme=$clct_usr_lst['super_company_name'];


$clt_dsp_cmp_neme="select * from display_company where id='$sper_cmpy_neme'";
$qst_clt_dsp_cmp_neme=$db->query($clt_dsp_cmp_neme);
$clct_clt_dsp_cmp_neme=$qst_clt_dsp_cmp_neme->fetch_assoc();

$dasp_cmp_neme=$clct_clt_dsp_cmp_neme['company_name'];











        
$cmpny_id=$clct_usr_lst['company_id'];
$actn_type=$clct_usr_lst['auction_type'];

$lqdtr_id=$clct_usr_lst['create_by_liquiditor_id'];


$clt_dtl="select * from add_liquidator where id='$lqdtr_id'";
$qst_clt_dtl=$db->query($clt_dtl);
$clct_clt_dtl=$qst_clt_dtl->fetch_assoc();

$lqdtor_nem=$clct_clt_dtl['liquidator_name'];
$lqdtor_eml=$clct_clt_dtl['liquidator_email'];

$clt_cmp_dtl="select * from company where id='$cmpny_id'";
$qst_clt_cmp_dtl=$db->query($clt_cmp_dtl);
$clct_clt_cmp_dtl=$qst_clt_cmp_dtl->fetch_assoc();

$cmpy_nem=$clct_clt_cmp_dtl['company_name'];

    ?><tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $title;?></td>
        <td><?php echo $dasp_cmp_neme;?></td>
        <td><?php echo $cmpy_nem;?></td>
        <td><?php echo $lqdtor_nem;?> (<?php echo $lqdtor_eml;?>)</td>
        <td><?php echo $actn_type;?></td>
        <td><?php echo $rsvrd_prce;?></td>
        <td><?php echo $increamental;?></td>
        <td><?php echo $bfr_tem;?></td>
        <td><?php echo $strt_det;?></td>
        <td><?php echo $end_det;?></td>
<td><a href='../liquidator/sale_notice_pdf/<?php echo $pdf_fel;?>' traget="_blank" >View PDF</a></td>
<td><?php if($pdf_fel1!= NULL) {?><a href='../liquidator/sale_notice_pdf/<?php echo $pdf_fel1;?>' traget="_blank" >View PDF</a><?php }?></td>
<td><?php if($pdf_fel2!= NULL) {?><a href='../liquidator/sale_notice_pdf/<?php echo $pdf_fel2;?>' traget="_blank" >View PDF</a><?php }?></td>
<td><?php if($pdf_fel3!= NULL) {?><a href='../liquidator/sale_notice_pdf/<?php echo $pdf_fel3;?>' traget="_blank" >View PDF</a><?php }?></td>
<td><?php if($pdf_fel4!= NULL) {?><a href='../liquidator/sale_notice_pdf/<?php echo $pdf_fel4;?>' traget="_blank" >View PDF</a><?php }?></td>

        
<td><a href='edit_sale_notice.php?id=<?php echo $sl_ntc_id;?>' class='btn btn-primary' style="width:100%;">Edit</a></td>
<td><a href='delete_sale_notice.php?id=<?php echo $sl_ntc_id;?>' class='btn btn-danger' style="width:100%;" onclick="return confirm('Are you sure want to delete this sales notice?')">Delete</a></td> 
<td><a href='viw_live_bid.php?id=<?php echo $sl_ntc_id;?>' class='btn btn-primary'>View</a> </td>
<td><a href='viw_bd_bid.php?id=<?php echo $sl_ntc_id;?>' class='btn btn-danger'>View</a> </td>
<td><?php if($timestamp > $end_det){?><a href='viw_auction_report.php?id=<?php echo $sl_ntc_id;?>' class='btn btn-warning'>View</a><?php }else { ?><a href='#' onclick='alert("Bid is not over yet Please try again.");' class='btn btn-warning'>View</a><?php } ?></td>
        
        </tr>
        
        
        
        
        <?php
    }
    ?>
    </tbody>
        
        
    </table>
    </div>
<?php


}

?>
<?php 
if(!isset($_POST['sbmmt']))
{
?>
    
<div class='col-md-12 table table-responsive' style="border: none !important;">
    <table class='table' id='myTable' style="border: 2px solid black !important;">
    <thead>  
<tr>

<th style="border-bottom:2px solid black !important;">Sno</th>

<th style="border-bottom:2px solid black !important;">Title</th>
<th style="border-bottom:2px solid black !important;">company name</th>
<th style="border-bottom:2px solid black !important;">Asset Name</th>
<th style="border-bottom:2px solid black !important;">Liquidator Name</th>
<th style="border-bottom:2px solid black !important;">Auction Type</th>
<th style="border-bottom:2px solid black !important;">Reserved Price</th>
<th style="border-bottom:2px solid black !important;">Increamental Price</th>
<th style="border-bottom:2px solid black !important;">Buffer Time (In Minutes)</th>
<th style="border-bottom:2px solid black !important;">Start Auction Date</th>
<th style="border-bottom:2px solid black !important;">End Auction Date</th>
<th style="border-bottom:2px solid black !important;">PDF</th>
<th style="border-bottom:2px solid black !important;">PDF 2</th>
<th style="border-bottom:2px solid black !important;">PDF 3</th>
<th style="border-bottom:2px solid black !important;">PDF 4</th>
<th style="border-bottom:2px solid black !important;">PDF 5</th>


<th style="border-bottom:2px solid black !important;">Edit</th>
<th style="border-bottom:2px solid black !important;">Delete</th>
<th style="border-bottom:2px solid black !important;">View Live Details</th>
<th style="border-bottom:2px solid black !important;">View Bid Details</th>
<th style="border-bottom:2px solid black !important;">View Bid Report</th>

</tr>
</thead>
   <tbody>    
    <?php 
    $usr_lst="select * from create_sale";
    $qst_usr_lst=$db->query($usr_lst);
    $sno=1;
    while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
    {
        $bfr_tem=$clct_usr_lst['buffer_time'];
        $title=$clct_usr_lst['Title'];
        $increamental=$clct_usr_lst['Incremental'];
        $rsvrd_prce=$clct_usr_lst['Reserve_Price'];
        $strt_det=$clct_usr_lst['Start_Date_Auction'];
        $end_det=$clct_usr_lst['End_Date_Auction'];
        $sl_ntc_id=$clct_usr_lst['id'];
        $pdf_fel=$clct_usr_lst['Pdf'];
        $pdf_fel2=$clct_usr_lst['pdf2'];
        $pdf_fel3=$clct_usr_lst['pdf3'];
        $pdf_fel4=$clct_usr_lst['pdf4'];
        $pdf_fel5=$clct_usr_lst['pdf5'];

    $sper_cmpy_neme=$clct_usr_lst['super_company_name'];




    $clt_dsp_cmp_neme="select * from display_company where id='$sper_cmpy_neme'";
    $qst_clt_dsp_cmp_neme=$db->query($clt_dsp_cmp_neme);
    $clct_clt_dsp_cmp_neme=$qst_clt_dsp_cmp_neme->fetch_assoc();
    
    $dasp_cmp_neme=$clct_clt_dsp_cmp_neme['company_name'];




$cmpny_id=$clct_usr_lst['company_id'];
$actn_type=$clct_usr_lst['auction_type'];

$lqdtr_id=$clct_usr_lst['create_by_liquiditor_id'];


$clt_dtl="select * from add_liquidator where id='$lqdtr_id'";
$qst_clt_dtl=$db->query($clt_dtl);
$clct_clt_dtl=$qst_clt_dtl->fetch_assoc();

$lqdtor_nem=$clct_clt_dtl['liquidator_name'];
$lqdtor_eml=$clct_clt_dtl['liquidator_email'];

$clt_cmp_dtl="select * from company where id='$cmpny_id'";
$qst_clt_cmp_dtl=$db->query($clt_cmp_dtl);
$clct_clt_cmp_dtl=$qst_clt_cmp_dtl->fetch_assoc();

$cmpy_nem=$clct_clt_cmp_dtl['company_name'];

    ?><tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $title;?></td>
        <td><?php echo $dasp_cmp_neme;?></td>
        <td><?php echo $cmpy_nem;?></td>
        <td><?php echo $lqdtor_nem;?> (<?php echo $lqdtor_eml;?>)</td>
        <td><?php echo $actn_type;?></td>
        <td><?php echo $rsvrd_prce;?></td>
        <td><?php echo $increamental;?></td>
        <td><?php echo $bfr_tem;?></td>
        <td><?php echo $strt_det;?></td>
        <td><?php echo $end_det;?></td>
<td><a href='../liquidator/sale_notice_pdf/<?php echo $pdf_fel;?>' traget="_blank" >View PDF</a></td>
<td><?php if($pdf_fel2!= NULL) {?><a href='../liquidator/sale_notice_pdf/<?php echo $pdf_fel2;?>' traget="_blank" >View PDF</a><?php }?></td>
<td><?php if($pdf_fel3!= NULL) {?><a href='../liquidator/sale_notice_pdf/<?php echo $pdf_fel3;?>' traget="_blank" >View PDF</a><?php }?></td>
<td><?php if($pdf_fel4!= NULL) {?><a href='../liquidator/sale_notice_pdf/<?php echo $pdf_fel4;?>' traget="_blank" >View PDF</a><?php }?></td>
<td><?php if($pdf_fel5!= NULL) {?><a href='../liquidator/sale_notice_pdf/<?php echo $pdf_fel5;?>' traget="_blank" >View PDF</a><?php }?></td>
        
<td><a href='edit_sale_notice.php?id=<?php echo $sl_ntc_id;?>' class='btn btn-primary' style="width:100%;">Edit</a></td>
<td><a href='delete_sale_notice.php?id=<?php echo $sl_ntc_id;?>' class='btn btn-danger' style="width:100%;" onclick="return confirm('Are you sure want to delete this sales notice?')">Delete</a></td> 
<td><a href='viw_live_bid.php?id=<?php echo $sl_ntc_id;?>' class='btn btn-primary'>View</a> </td>
<td><a href='viw_bd_bid.php?id=<?php echo $sl_ntc_id;?>' class='btn btn-danger'>View</a> </td>
<td><?php if($timestamp > $end_det){?><a href='viw_auction_report.php?id=<?php echo $sl_ntc_id;?>' class='btn btn-warning'>View</a><?php }else { ?><a href='#' onclick='alert("Bid is not over yet Please try again.");' class='btn btn-warning'>View</a><?php } ?></td>
        
        </tr>
        
        
        
        
        <?php
    }
    ?>
    </tbody>
        
        
    </table>
    </div>
<?php
}
?>



</div>
</main>




<script>
$(document).ready(function(){
$('#lqdtsr_id').change(function(){
var lqdtr_iid=$('#lqdtsr_id').val();
$.ajax({
url: "get_cmp_ajax.php",
type: "POST",
data    : {txt1:lqdtr_iid},
cache: false,
success: function(data){
$('#cmp_id').html(data);

}
});
});
});
</script>














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