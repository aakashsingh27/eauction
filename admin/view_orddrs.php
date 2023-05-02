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
<?php

?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<h2 class="mt-30 page-title">View Orders</h2>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active">View Orders</li>
</ol>


<div class='col-md-12 table table-responsive'>
    <table class='table'>
        
<tr>
<th>Sno.</th>
<th>Date</th>
<th>Product Name</th>
<th>image</th>
<th>Price</th>
<th>Quantity</th>
<th>Subtotal</th>
<th>Customer name</th>
<th>Mobile number</th>

</tr>
        
    <?php 
    $usr_lst="select * from product_orders";
    $qst_usr_lst=$db->query($usr_lst);
    $sno=1;
    while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
    {
        $prd_nem=$clct_usr_lst['product_name'];
         $prd_prc=$clct_usr_lst['price'];
          $prd_qty=$clct_usr_lst['quantity'];
    $prd_sbttl=$clct_usr_lst['subtotal'];
     $ord_det=$clct_usr_lst['date'];
          $ord_id_id=$clct_usr_lst['id'];
          $usr_mbl=$clct_usr_lst['user_mobile'];
          $prd_id=$clct_usr_lst['product_id'];
          
          
          
          
        $prd_dtl="select * from our_products where id='$prd_id'";
        $qst_prd_dtl=$db->query($prd_dtl);
        $clct_prd_dtl=$qst_prd_dtl->fetch_assoc();
        $prrd_img=$clct_prd_dtl['image'];
          
          
          
          
          
$slt_ddtl="select * from regsiter where mobile='$usr_mbl'";
$qst_slt_ddtl=$db->query($slt_ddtl);
$clct_slt_ddtl=$qst_slt_ddtl->fetch_assoc();

$cst_nem=$clct_slt_ddtl['name'];
  
         
    ?><tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $ord_det;?></td>
        <td><?php echo $prd_nem;?></td>
        <td><img src='product_image/<?php echo $prrd_img;?>' style="height:100px; width:100px;"></td>
        <td><?php echo $prd_prc;?></td>
        <td><?php echo $prd_qty;?></td>
            <td><?php echo $prd_sbttl;?></td>
                <td><?php echo $cst_nem;?></td>
                    <td><?php echo $usr_mbl;?></td>
                    
       
        
        </tr>
        
        
        
        
        <?php
    }
    ?>
        
        
    </table>
    </div>




</div>
</main>

<?php include 'footer.php'; 

ob_flush();

?>