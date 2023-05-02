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


<!----upper link start---->

<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<!----Upper links end---------------------->



<?php

?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid">

<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">View Sale Notice</li>
</ol>


<div class='col-md-12 table table-responsive' style="
    border: none !important;">
    <table class='table' id='myTable' style="border: 2px solid black !important;"> 
    <thead>   
<tr>

<th style="border-bottom: 2px solid black !important;">Sno</th>
<th style="border-bottom: 2px solid black !important;">company name</th>
<th style="border-bottom: 2px solid black !important;">Title</th>
<th style="border-bottom: 2px solid black !important;">Type Of Property</th>
<th style="border-bottom: 2px solid black !important;">Asset Name</th>
<th style="border-bottom: 2px solid black !important;">EMD (Earnest Money Deposit)</th>

<th style="border-bottom: 2px solid black !important;">Reserved Price</th>
<th style="border-bottom: 2px solid black !important;">Increamental Price</th>
<th style="border-bottom: 2px solid black !important;">Auction Type</th>
<th style="border-bottom: 2px solid black !important;">Buffer Time (In Minutes)</th>
<th style="border-bottom: 2px solid black !important;">Start Auction Date</th>
<th style="border-bottom: 2px solid black !important;">End Auction Date</th>
<th style="border-bottom: 2px solid black !important;">State</th>


<th style="border-bottom: 2px solid black !important;">PDF</th>

<th style="border-bottom: 2px solid black !important;">PDF 2</th>
<th style="border-bottom: 2px solid black !important;">PDF 3</th>
<th style="border-bottom: 2px solid black !important;">PDF 4</th>
<th style="border-bottom: 2px solid black !important;">PDF 5</th>









<th style="border-bottom: 2px solid black !important;">Action</th>

</tr>
</thead>
<tbody>  
    <?php 
    $usr_lst="select * from create_sale where create_by_liquiditor_id='$emp_id'";
    $qst_usr_lst=$db->query($usr_lst);
    $sno=1;
    while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
    {
        $bfr_tem=$clct_usr_lst['buffer_time'];


        $pdf_file=$clct_usr_lst['Pdf'];

        $pdf_file2=$clct_usr_lst['pdf2'];
        $pdf_file3=$clct_usr_lst['pdf3'];
        $pdf_file4=$clct_usr_lst['pdf4'];
        $pdf_file5=$clct_usr_lst['pdf5'];
        
         $spr_cmpy_neme=$clct_usr_lst['super_company_name'];


         

$clt_dsp_cmp_neme="select * from display_company where id='$spr_cmpy_neme'";
$qst_clt_dsp_cmp_neme=$db->query($clt_dsp_cmp_neme);
$clct_clt_dsp_cmp_neme=$qst_clt_dsp_cmp_neme->fetch_assoc();

$cmep_neem=$clct_clt_dsp_cmp_neme['company_name'];




$typ_of_prprty_id=$clct_usr_lst['property_type'];


$clt_prpty_dtl="select * from type_of_property where id='$typ_of_prprty_id'";
$qst_clt_prpty_dtl=$db->query($clt_prpty_dtl);
$clct_clt_prpty_dtl=$qst_clt_prpty_dtl->fetch_assoc();

$prprty_ttyp=$clct_clt_prpty_dtl['property_type'];



        $title=$clct_usr_lst['Title'];
        $increamental=$clct_usr_lst['Incremental'];
        $rsvrd_prce=$clct_usr_lst['Reserve_Price'];
        $strt_det=$clct_usr_lst['Start_Date_Auction'];
        $end_det=$clct_usr_lst['End_Date_Auction'];
        $sl_ntc_id=$clct_usr_lst['id'];
        
$cmpny_id=$clct_usr_lst['company_id'];
$actn_typ=$clct_usr_lst['auction_type'];

$emmp=$clct_usr_lst['emp'];
$cty_id=$clct_usr_lst['city_id'];
$seete_id=$clct_usr_lst['state_id'];


$clt_stet_dtl="select * from state where id='$seete_id'";
$qst_clt_stet_dtl=$db->query($clt_stet_dtl);
$clct_clt_stet_dtl=$qst_clt_stet_dtl->fetch_assoc();

$stet_neem=$clct_clt_stet_dtl['state_name'];


$clt_cty_dtl="select * from city where id='$cty_id'";
$qst_cty_dtl=$db->query($clt_cty_dtl);
$clct_clt_cty_dtl=$qst_cty_dtl->fetch_assoc();

$cty_nem=$clct_clt_cty_dtl['city_name'];





$clt_cmp_dtl="select * from company where id='$cmpny_id'";
$qst_clt_cmp_dtl=$db->query($clt_cmp_dtl);
$clct_clt_cmp_dtl=$qst_clt_cmp_dtl->fetch_assoc();

$cmpy_nem=$clct_clt_cmp_dtl['company_name'];

    ?><tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $cmep_neem;?></td>
        <td><?php echo $title;?></td>
        <td><?php echo $prprty_ttyp;?></td>
        <td><?php echo $cmpy_nem;?></td>
        <td><?php echo $emmp;?></td>
        <td><?php echo $rsvrd_prce;?></td>
        <td><?php echo $increamental;?></td>
        <td><?php echo $actn_typ;?></td>
        <td><?php echo $bfr_tem;?></td>
        <td><?php echo $strt_det;?></td>
        <td><?php echo $end_det;?></td>
        <td><?php echo $stet_neem?></td>
        <td><?php if($pdf_file!=NULL){?><a href='sale_notice_pdf/<?php echo $pdf_file;?>' target="_blank">View PDF</a><?php }?></td>
        <td><?php if($pdf_file2!=NULL){?><a href='sale_notice_pdf/<?php echo $pdf_file2;?>' target="_blank">View PDF</a><?php }?></td>
        <td><?php if($pdf_file3!=NULL){?><a href='sale_notice_pdf/<?php echo $pdf_file3;?>' target="_blank">View PDF</a><?php }?></td>
        <td><?php if($pdf_file4!=NULL){?><a href='sale_notice_pdf/<?php echo $pdf_file4;?>' target="_blank">View PDF</a><?php }?></td>
        <td><?php if($pdf_file5!=NULL){?><a href='sale_notice_pdf/<?php echo $pdf_file5;?>' target="_blank">View PDF</a><?php }?></td>
        <td><a href='update_sale_notice.php?id=<?php echo $sl_ntc_id;?>' class='btn btn-primary' style="
    width: 100%;
">Edit</a> <br><br><a href='delete_sale_notice.php?id=<?php echo $sl_ntc_id;?>' onclick="return confirm('Are you sure want to delete this sales notice?')" class='btn btn-danger'>Delete</a> <br><br></td>
        
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
        alert(txt1);

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