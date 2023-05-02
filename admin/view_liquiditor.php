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
<!--<h2 class="mt-30 page-title">Liquidator list</h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active"style="font-size: 18px;font-weight: bold;color: black !important;">Liquidator list</li>
</ol>

<div class='col-md-12 table table-responsive' style="
    border: none !important;">
    <table class='table' id='myTable' style="border: 2px solid black !important;">
    <thead>    
<tr>

<th style="border-bottom:2px solid black !important;">S.No.</th>
<th style="border-bottom:2px solid black !important;">Liquidator Name</th>
<th style="border-bottom:2px solid black !important;">Liquidator Email</th>
<th style="border-bottom:2px solid black !important;">Liquidator Mobile</th>

<th style="border-bottom:2px solid black !important;">Liquidator Password</th>
<th style="border-bottom:2px solid black !important;">Liquidator address</th>
<th style="border-bottom:2px solid black !important;">Liquidator address 2</th>
<th style="border-bottom:2px solid black !important;">City</th>
<th style="border-bottom:2px solid black !important;">State</th>
<th style="border-bottom:2px solid black !important;">Pincode</th>
<th style="border-bottom:2px solid black !important;">Email sent status</th>
<th style="border-bottom:2px solid black !important;">Email Send</th>
<th style="border-bottom:2px solid black !important;">Edit</th>
<th style="border-bottom:2px solid black !important;">Delete</th>
<th style="border-bottom:2px solid black !important;">view Sales notice</th>

</tr>
</thead>
<tbody>
    <?php 
    $usr_lst="select * from add_liquidator ";
    $qst_usr_lst=$db->query($usr_lst);
    $sno=1;
    while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
    {
        $lqdtr_nem=$clct_usr_lst['liquidator_name'];
        $lqdtr_emnl=$clct_usr_lst['liquidator_email'];
        $lqdtr_pwd=$clct_usr_lst['liquidator_password'];
        $lqdtr_adrs=$clct_usr_lst['liquidator_address'];
        $lqdtr_adrs_tw=$clct_usr_lst['liquidator_address2'];
        $inpty_cty=$clct_usr_lst['input_city'];
        $inpt_stet=$clct_usr_lst['input_state'];
        $inpt_zp=$clct_usr_lst['input_zip'];
        $iid=$clct_usr_lst['id'];
        $lqdtr_mbel=$clct_usr_lst['mobile'];
        $eml_sttes=$clct_usr_lst['email_sent_status'];
        
        

    ?><tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $lqdtr_nem;?></td>
       <!-- <td><?php //echo $us_eml;?></td>-->
        <td><?php echo $lqdtr_emnl;?></td>
        <td><?php echo $lqdtr_mbel;?></td>
        <td><?php echo $lqdtr_pwd;?></td>
        <td><?php echo $lqdtr_adrs;?></td>
        <td><?php echo $lqdtr_adrs_tw;?></td>
        <td><?php echo $inpty_cty;?></td>
        
        <td><?php echo $inpt_stet;?></td>
        
        <td>
             <?php echo $inpt_zp;?>
        </td>
        <td><?php if($eml_sttes!=NULL){ echo $eml_sttes; }else { echo "Not Sent"; }?></td>
        
        <td><a href="send_email_liquidator.php?id=<?php echo $iid;?>" class='btn btn-success' onclick="return confirm('Are you sure want to send email to <?php echo $lqdtr_nem; ?>');" style="width:130px;"><i class="fa fa-envelope" aria-hidden="true"></i> Send Email</a></td>
        
        <td><a href='edt_lqdtor.php?id=<?php echo $iid;?>' class='btn btn-danger' style="width:100%;">Edit</a></td>
        <td><a href='dlt_lqdtor.php?txt1=<?php echo $iid?>' onclick="return confirm('Are you sure want to delete this liquidator?')" value='' class='btn btn-primary' style="width:100%;">Delete</a></td>
    
        <td><a href='view_liquidator_auction.php?id=<?php echo $iid;?>' class='btn btn-warning' >View</a>
    
    
    
    </td>
        
        </tr>
        
        
        
        
        <?php
    }
    ?>
        </tbody>
        
    </table>
    </div>




</div>
</main>

<script>
    
    
    function dlt_lqdtr(txt)
    {
        var txt1=txt;
    Swal.fire({
  title: 'Do You Want To Delete This Liquidator?',
 icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Save',
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
 $.ajax({
url: "dlt_lqdtor.php",
type: "POST",
data    : {txt1:txt1},
cache: false,
success: function(data){
Swal.fire({

icon: 'success',
title: 'Liquidator Deleted successfully',
showConfirmButton: false,
timer: 1500
});
window.location='';

}
});
}
})   



       




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