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
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">View Sub Liquidator</li>
</ol>


<div class='col-md-12 table table-responsive' style="
    border: none !important;">
    <table class='table' id='myTable' style="border: 2px solid black !important;"> 
    <thead>   
<tr>

<th style="border-bottom: 2px solid black !important;">Sno</th>
<th style="border-bottom: 2px solid black !important;">Name</th>
<th style="border-bottom: 2px solid black !important;">Email</th>
<th style="border-bottom: 2px solid black !important;">Mobile</th>
<th style="border-bottom: 2px solid black !important;">Password</th>

<th style="border-bottom: 2px solid black !important;">Action</th>

</tr>
</thead>
<tbody>  
    <?php 
   $usr_lst="select * from sub_liquidator where add_by_liquidator='$a_idchk'";
    $qst_usr_lst=$db->query($usr_lst);
    $sno=1;
    while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
    {
$nem=$clct_usr_lst['name'];
$emnl=$clct_usr_lst['email'];
$mbel=$clct_usr_lst['mobile'];
$psswd=$clct_usr_lst['password'];
$iiid=$clct_usr_lst['id'];


    ?><tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $nem;?></td>
        <td><?php echo $emnl;?></td>
        <td><?php echo $mbel;?></td>
        <td><?php echo $psswd;?></td>
        <td>
    <a href='update_sb_lqdtr.php?id=<?php echo $iiid;?>' class='btn btn-warning btn-sm' style="
    width: 65px;"><i class='fa fa-edit'></i> Edit</a> 
    
    <a href='dlt_sb_lqdtr.php?id=<?php echo $iiid;?>' onclick="return confirm('Are you sure want to delete this sub-user?')" class='btn btn-danger btn-sm' style="
    width: 75px;"><i class='fa fa-trash'></i> Delete</a> 
    
    
    
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