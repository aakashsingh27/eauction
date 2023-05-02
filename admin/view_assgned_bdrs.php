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
<!--<h2 class="mt-30 page-title">View assigned bidders to a company</h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">View Assigned Bidders To A Company</li>
</ol>
<form action='' method="POST">
<div class='row'>
    <div class='col-md-4'>
<select name="lqdtr_id" class='form-control' id='lqdter' style='border:1px solid !important;' required><option value="">-Choose Liquidator-</option>


<?php 
$slt_lqdtr_dtl="select * from add_liquidator";
$qst_slt_lqdtr_dtl=$db->query($slt_lqdtr_dtl);
while($clct_slt_lqdtr_dtl=$qst_slt_lqdtr_dtl->fetch_assoc())
{
    $lqdetr_iid=$clct_slt_lqdtr_dtl['id'];
     $lqdetr_neem=$clct_slt_lqdtr_dtl['liquidator_name'];
     ?>
<option value="<?php echo $lqdetr_iid;?>"><?php echo $lqdetr_neem;?></option>
     <?php
}
?>


</select></div>
    <div class='col-md-4'>
        <select name="comp_id" id='cmpy_id' class='form-control' style='border:1px solid !important;'><option value="">-Choose Company-</option></select>
    </div>
    <div class='col-md-4'>
        <input type='submit' name='search' class='btn btn-primary'>
    </div>
</div>
</form>


<br>


<?php 
if(!isset($_POST['search']))
{
?>
<div class='col-md-12 table table-responsive' style="
    border: none !important;">
    <table class='table' id='myTable' style="border: 2px solid black !important;">
    <thead>   
<tr>

<th style="border-bottom:2px solid black !important;">sno</th>
<th style="border-bottom:2px solid black !important;">Bidder name</th>
<th style="border-bottom:2px solid black !important;">Company name</th>
<th style="border-bottom:2px solid black !important;">Liquidator name</th>
<th style="border-bottom:2px solid black !important;">Action</th>

</tr>
</thead>
<tbody>
        
    <?php 
    $usr_lst="select * from assign_bidders_by_liquidator";
    $qst_usr_lst=$db->query($usr_lst);
    $sno=1;
    while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
    {
        $cmp_id=$clct_usr_lst['company_id'];
        $bdder_id=$clct_usr_lst['bidder_id'];
        $iiidd=$clct_usr_lst['id'];

        $lqdtr_id=$clct_usr_lst['liquidator_id'];

        $clt_lqdtr_dtl="select * from add_liquidator where id='$lqdtr_id'";
        $qst_clt_lqdtr_dtl=$db->query($clt_lqdtr_dtl);
        $clct_clt_lqdtr_dtl=$qst_clt_lqdtr_dtl->fetch_assoc();

        $lqdtr_nem=$clct_clt_lqdtr_dtl['liquidator_name'];
        


$clt_bdr_dtl="select * from newbidder_login where id='$bdder_id'";
$qst_clt_bdr_dtl=$db->query($clt_bdr_dtl);
$clct_clt_bdr_dtl=$qst_clt_bdr_dtl->fetch_assoc();
$bdder_nem=$clct_clt_bdr_dtl['Bidder_Name'];
$bdr_uid=$clct_clt_bdr_dtl['uid'];


        $clt_cmp_dtl="select * from company where id='$cmp_id'";
        $qst_clt_cmp_dtl=$db->query($clt_cmp_dtl);
$clct_clt_cmp_dtl=$qst_clt_cmp_dtl->fetch_assoc();
$cmp_nem=$clct_clt_cmp_dtl['company_name'];

    ?><tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $bdder_nem;?> (<?php echo $bdr_uid;?>)</td>
        <td><?php echo $cmp_nem;?></td>
        <td><?php echo $lqdtr_nem;?></td>
        <td><a href='delete_assgned_bdder.php?id=<?php echo $iiidd;?>' class='btn btn-danger' onclick="return confirm('Are you sure want to delete ?')" >Delete</a></td>

        
        </tr>
        
        
        
        
        <?php
    }
    ?>
        
</tbody>
    </table>
    </div>
<?php 
}
if(isset($_POST['search']))
{
    $lqdet_id=$_POST['lqdtr_id'];
    $cemp_id=$_POST['comp_id'];
    
    $clt_dtl="select * from assign_bidders_by_liquidator where liquidator_id='$lqdet_id' and company_id='$cemp_id'";
    $qst_clt_dtl=$db->query($clt_dtl);
    ?>
    <div class='col-md-12 table table-responsive' style="
    border: none !important;">
         <table class='table' id='myTable' style="border: 2px solid black !important;">
    <thead>   
<tr>

<th style="border-bottom:2px solid black !important;">sno</th>
<th style="border-bottom:2px solid black !important;">Bidder name</th>
<th style="border-bottom:2px solid black !important;">Company name</th>
<th style="border-bottom:2px solid black !important;">Liquidator name</th>
<th style="border-bottom:2px solid black !important;">Action</th>

</tr>
</thead>
<tbody>
    <?php
while($clct_clt_dtl=$qst_clt_dtl->fetch_assoc())
{
?>
 <?php 
    $usr_lst="select * from assign_bidders_by_liquidator";
    $qst_usr_lst=$db->query($usr_lst);
    $sno=1;
   $clct_usr_lst=$qst_usr_lst->fetch_assoc();
    
        $cmp_id=$clct_usr_lst['company_id'];
        $bdder_id=$clct_usr_lst['bidder_id'];
        $iiidd=$clct_usr_lst['id'];

        $lqdtr_id=$clct_usr_lst['liquidator_id'];

        $clt_lqdtr_dtl="select * from add_liquidator where id='$lqdtr_id'";
        $qst_clt_lqdtr_dtl=$db->query($clt_lqdtr_dtl);
        $clct_clt_lqdtr_dtl=$qst_clt_lqdtr_dtl->fetch_assoc();

        $lqdtr_nem=$clct_clt_lqdtr_dtl['liquidator_name'];
        


$clt_bdr_dtl="select * from newbidder_login where id='$bdder_id'";
$qst_clt_bdr_dtl=$db->query($clt_bdr_dtl);
$clct_clt_bdr_dtl=$qst_clt_bdr_dtl->fetch_assoc();
$bdder_nem=$clct_clt_bdr_dtl['Bidder_Name'];
$bdr_uid=$clct_clt_bdr_dtl['uid'];


        $clt_cmp_dtl="select * from company where id='$cmp_id'";
        $qst_clt_cmp_dtl=$db->query($clt_cmp_dtl);
$clct_clt_cmp_dtl=$qst_clt_cmp_dtl->fetch_assoc();
$cmp_nem=$clct_clt_cmp_dtl['company_name'];

    ?>
    <tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $bdder_nem;?> (<?php echo $bdr_uid;?>)</td>
        <td><?php echo $cmp_nem;?></td>
        <td><?php echo $lqdtr_nem;?></td>
        <td><a href='delete_assgned_bdder.php?id=<?php echo $iiidd;?>' class='btn btn-danger' onclick="return confirm('Are you sure want to delete ?')" >Delete</a></td>

        
        </tr>
        
        
        
        
        <?php
}
    ?>
        
</tbody>
    </table>

        <?php
   
    ?>
        </div>
    <?php
}
?>



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


<script>
$(document).ready(function(){
$('#lqdter').change(function(){
var lqdetr_id=$('#lqdter').val();
$.ajax({
url: "get_cmp_ajax.php",
type: "POST",
data    : {txt1:lqdetr_id},
cache: false,
success: function(data)
{
$('#cmpy_id').html(data);

}
});
});
});
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