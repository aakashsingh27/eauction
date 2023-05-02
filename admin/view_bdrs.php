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
<!--<h2 class="mt-30 page-title">All Bidders</h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">All Bidders</li>
</ol>
    <form action='' method="POST">
     <div class='col-md-4' style="float:right;">
        <select name='status' class='form-control' style="border: 1px solid black !important;" required>
        <option value="">Choose status</option>
        <option value="active">active</option>
        <option value="deactive">deactive</option>
        
        </select>
        </div>
<div class='col-md-12 table table-responsive' style="
    border: none !important;">
    

    <table class='table' id='myTable' style="border: 2px solid black !important;">
    <thead>   
<tr>

<th style="border-bottom:2px solid black !important;">S.No</th>
<th style="border-bottom:2px solid black !important;">Name</th>
<th style="border-bottom:2px solid black !important;">Email</th>
<th style="border-bottom:2px solid black !important;">Mobile</th>
<th style="border-bottom:2px solid black !important;">UID</th>

<th style="border-bottom:2px solid black !important;">Password</th>
<th style="border-bottom:2px solid black !important;">Status</th>
<th style="border-bottom:2px solid black !important;">Liquiditor Name</th>
<th style="border-bottom:2px solid black !important;">Email Send Status</th>
<th style="border-bottom:2px solid black !important;">Sent Email</th>
<th style="border-bottom:2px solid black !important;">Edit</th>
<th style="border-bottom:2px solid black !important;">Delete</th>
<th style="border-bottom:2px solid black !important;">Checkbox</th>


</tr>
</thead>
   <tbody>     
    <?php 
    $usr_lst="select * from newbidder_login ";
    $qst_usr_lst=$db->query($usr_lst);

$bedr_cmt=mysqli_num_rows($qst_usr_lst);



    $sno=1;
    while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
    {
        $bdr_nem=$clct_usr_lst['Bidder_Name'];
        $bdr_emnl=$clct_usr_lst['Bidder_Email'];
        $bdr_mnbl=$clct_usr_lst['bidder_mobile'];
        $bdr_pswd=$clct_usr_lst['Bidder_Password'];
        $bdr_sts=$clct_usr_lst['status'];
       $bdr_id=$clct_usr_lst['id'];
       $bdr_uid=$clct_usr_lst['uid'];
       $bdr_eml_sent_sts=$clct_usr_lst['email_sent_status'];

       $lqdtr_bdr_id=$clct_usr_lst['bidder_add_by_liquiditor_id'];

        
       $slt_lqdtr_dtl="select * from add_liquidator where id='$lqdtr_bdr_id'";
       $qst_slt_lqdtr_dtl=$db->query($slt_lqdtr_dtl);

       $clct_slt_lqdtr_dtl=$qst_slt_lqdtr_dtl->fetch_assoc();

       $lqdtr_nem=$clct_slt_lqdtr_dtl['liquidator_name'];

    ?><tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $bdr_nem;?></td>
       
        <td><?php echo $bdr_emnl;?></td>
        <td><?php echo $bdr_mnbl;?></td>
        <td><?php echo $bdr_uid;?></td>
        <td><?php echo $bdr_pswd;?></td>
        <td><?php echo $bdr_sts;?></td>
        <td><?php echo $lqdtr_nem;?></td>
        <td><?php if($bdr_eml_sent_sts!=NULL) { echo $bdr_eml_sent_sts; } else { echo "Not send";} ?></td>
        
        <td><a href='sent_bdr_emnl.php?id=<?php echo $bdr_id;?>' class='btn btn-success' style="width: 130px;" onclick="return confirm('Are you sure want to Send Credentials to <?php echo $bdr_nem;?> ?')";><i class="fa fa-envelope" aria-hidden="true"></i> Send Email </a> </td>
        <td><a href='edit_bdr.php?id=<?php echo $bdr_id;?>' class='btn btn-primary'>Edit</a> </td>
        <td><a href='dlt_bdr.php?id=<?php echo $bdr_id;?>' onclick="return confirm('Are you sure want to delete this bidder?')" class='btn btn-danger'>Delete </a>
        </td>
        
    <td><input type='checkbox' value="<?php echo $bdr_id;?>" name="for_status[]"></td>    
        
        
        
       
        
        </tr>
        
        
        
        
        <?php
    }
    ?>
        </tbody>
        
    </table>
    </div>
<button type='submit' name="sbmt" class='btn btn-primary' style="float:right;">submit</button>
</form>
<?php 
if(isset($_POST['sbmt']))
{
   $tick= $_POST['for_status'];
    $sttes= $_POST['status'];

     for($i=0;$i<$bedr_cmt;$i++)
    {
    if(isset($tick[$i]))
    {
       $upd_sts="update newbidder_login set status='$sttes' where id='$tick[$i]'"; 
      $qst_upd_sts=$db->query($upd_sts);
        
     
    }
    
    }
    
    if($qst_upd_sts)
    {
echo "<script>window.alert('Status updated successfully');window.location='';</script>";
    }
    
}
?>

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