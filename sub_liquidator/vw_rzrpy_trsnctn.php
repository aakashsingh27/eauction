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

$comp_select = $db->query("SELECT * FROM `admin`");
$comp_fetch = $comp_select->fetch_object();
$a_company = $comp_fetch->a_company;
$check_a_name = $_SESSION['a_name'];

?>

<?php include 'header.php'; ?>
<?php

?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<h2 class="mt-30 page-title">All Users List</h2>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active">All Users List</li>
</ol>


<div class='col-md-12 table table-responsive'>
    <table class='table'>
        
        <tr>
            <th>Sno.</th>
            <th>Transaction Date</th>
            <th>User Name</th>
            <th>Amount</th>
            <th>Payment Id</th>
            <th>Order ID</th>
            <th>Signature hash</th>
        </tr>
        
    <?php 
    $onln_pymt="select * from online_payment";
    $qst_onln_pymt=$db->query($onln_pymt);
    $sno=1;
    while($clct_onln_pymt=$qst_onln_pymt->fetch_assoc())
    {
        $pym_id=$clct_onln_pymt['payment_id'];
         $ord_id=$clct_onln_pymt['order_id'];
          $sgntr_hsh=$clct_onln_pymt['signature_hash'];
           $us_id=$clct_onln_pymt['client_id'];
           $py_dte=$clct_onln_pymt['pay_date'];
            $py_amnt=$clct_onln_pymt['amount'];
        $usr_nem="select * from users where user_id='$us_id'";
        $qst_usr_nem=$db->query($usr_nem);
        $clct_usr_nem=$qst_usr_nem->fetch_assoc();
        
        $us_nems=$clct_usr_nem['user_name'];
    ?>
    <tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $py_dte;?></td>
        <td><?php echo $us_nems;?></td>
        <td><?php echo $py_amnt;?></td>
        <td><?php echo $pym_id;?></td>
        <td><?php echo $ord_id;?></td>
        <td><?php echo $sgntr_hsh;?></td>
        
        
    
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