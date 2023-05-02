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
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<?php

?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<h2 class="mt-30 page-title">Bcone Game Transactions</h2>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active">Bcone Game Transactions</li>
</ol>


<div class='col-md-12 table table-responsive'>
<table class='table'>
    
    <tr>
        <th>Sno.</th>
        <th>Date</th>
        <th>Game Period</th>
        <th>User name</th>
        <th>Selected Color</th>
        <th>Selected Number </th>
        <th>Bet Amount</th>
        <th>Win Amount </th>
       
    </tr>
    
<?php 
$usr_lst="select * from transaction_history where game_type='Bcone' order by id desc";
$qst_usr_lst=$db->query($usr_lst);
$sno=1;
while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
{
    $us_id=$clct_usr_lst['user_id'];
    
    
  $usr_dtls="select * from users where user_id='$us_id'";
    $qst_usr_dtls=$db->query($usr_dtls);
    $clct_usr_dtls=$qst_usr_dtls->fetch_assoc();
    
    $usre_nem=$clct_usr_dtls['user_name'];
    
    
    
     $prt_dt=$clct_usr_lst['date'];
      $us_dbt_amt=$clct_usr_lst['debit_amount'];
       $us_crd_amt=$clct_usr_lst['credit_amount'];
       $gm_prd=$clct_usr_lst['period'];
       $us_chs_clr=$clct_usr_lst['color'];
        $us_chs_nbr=$clct_usr_lst['number'];
        
?><tr>
    <td><?php echo $sno++;?></td>
    <td><?php echo $prt_dt;?></td>
    <td><?php echo $gm_prd;?></td>
    <td><?php echo  $usre_nem;?></td>
    <td><?php echo $us_chs_clr;?></td>
    <td><?php echo $us_chs_nbr;?></td>
    <td><?php echo $us_dbt_amt;?> <i class='fas fa-inr'></i></td>
        <td><?php echo $us_crd_amt;?></td>
   

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