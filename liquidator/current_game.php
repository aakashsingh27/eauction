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
$slt_cr_gme="select * from current_game_period where id='1'";
$qst_cr_gme=$db->query($slt_cr_gme);

$clct_cr_gme=$qst_cr_gme->fetch_assoc();
$crrt_gem=$clct_cr_gme['current_game']

?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<h2 class="mt-30 page-title">Current Game Period => <?php echo $crrt_gem;?></h2>

<!--<select id='gm_typ' onchange="gt_vl(this.value)" style="
    font-size: 25px;
    border-radius: 15px;
">
    <option>Choose game</option>
    <option value="Parity">Parity</option>
    <option value="Sapre">Sapre</option>
    <option value="Bcone">Bcone</option>
    <option value="Emerd">Emerd</option>
    </select>-->


<?php 
/*if(isset($_GET['gm_typ']))
{*/
    $g_typ=$_GET['gm_typ'];
  /* if($g_typ=='Parity')
   {*/
?>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active">Parity Game Transactions</li>
</ol>


<div class='col-md-12 table table-responsive'>
<table class='table'>
    
    <tr>
        <th>Sno.</th>
        <th>Game Type</th>
        <th>Game Period</th>
        <th>User name</th>
        <th>Selected Color</th>
        <th>Selected Number </th>
        <th>Bet Amount</th>
       
    </tr>
    
<?php 
$usr_lst="select * from game where game_type='Parity' and period='$crrt_gem'";
$qst_usr_lst=$db->query($usr_lst);
$sno=1;
while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
{
    $us_id=$clct_usr_lst['user_id'];
    
    
  $usr_dtls="select * from users where user_id='$us_id'";
    $qst_usr_dtls=$db->query($usr_dtls);
    $clct_usr_dtls=$qst_usr_dtls->fetch_assoc();
    
    $usre_nem=$clct_usr_dtls['user_name'];
       $gm_prd=$clct_usr_lst['period'];
       $us_chs_clr=$clct_usr_lst['selected_color'];
        $us_chs_nbr=$clct_usr_lst['selected_number'];
        $bttd_amnt=$clct_usr_lst['amount'];
        
        
        
?><tr>
    <td><?php echo $sno++;?></td>
    <td>Parity</td>
    <td><?php echo $gm_prd;?></td>
    <td><?php echo  $usre_nem;?></td>
    <td><?php echo $us_chs_clr;?></td>
    <td><?php echo $us_chs_nbr;?></td>
    <td><?php echo $bttd_amnt;?> <i class='fas fa-inr'></i></td>
     
   

    </tr>
    <?php
}
?>
    
    
</table>
</div>
<?php 
/*}*/
/*}*/
?>


<?php 
/*if(isset($_GET['gm_typ']))
{
    $g_typ=$_GET['gm_typ'];*/
/*   if($g_typ=='Sapre')
   {*/
?>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active">Sapre Game Transactions</li>
</ol>


<div class='col-md-12 table table-responsive'>
<table class='table'>
    
    <tr>
        <th>Sno.</th>
        <th>Game Type</th>
        <th>Game Period</th>
        <th>User name</th>
        <th>Selected Color</th>
        <th>Selected Number </th>
        <th>Bet Amount</th>
       
    </tr>
    
<?php 
$usr_lst="select * from game where game_type='Sapre' and period='$crrt_gem'";
$qst_usr_lst=$db->query($usr_lst);
$sno=1;
while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
{
    $us_id=$clct_usr_lst['user_id'];
    
    
  $usr_dtls="select * from users where user_id='$us_id'";
    $qst_usr_dtls=$db->query($usr_dtls);
    $clct_usr_dtls=$qst_usr_dtls->fetch_assoc();
    
    $usre_nem=$clct_usr_dtls['user_name'];
       $gm_prd=$clct_usr_lst['period'];
       $us_chs_clr=$clct_usr_lst['selected_color'];
        $us_chs_nbr=$clct_usr_lst['selected_number'];
        $bttd_amnt=$clct_usr_lst['amount'];
        
        
        
?><tr>
    <td><?php echo $sno++;?></td>
    <td>Sapre</td>
    <td><?php echo $gm_prd;?></td>
    <td><?php echo  $usre_nem;?></td>
    <td><?php echo $us_chs_clr;?></td>
    <td><?php echo $us_chs_nbr;?></td>
    <td><?php echo $bttd_amnt;?> <i class='fas fa-inr'></i></td>
     
   

    </tr>
    <?php
}
?>
    
    
</table>
</div>
<?php 
/*}*/
/*}*/
?>




<?php 
/*if(isset($_GET['gm_typ']))
{
    $g_typ=$_GET['gm_typ'];*/
  /* if($g_typ=='Bcone')
   {*/
?>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active">Bcone Game Transactions</li>
</ol>


<div class='col-md-12 table table-responsive'>
<table class='table'>
    
    <tr>
        <th>Sno.</th>
        <th>Game Type</th>
        <th>Game Period</th>
        <th>User name</th>
        <th>Selected Color</th>
        <th>Selected Number </th>
        <th>Bet Amount</th>
       
    </tr>
    
<?php 
$usr_lst="select * from game where game_type='Bcone' and period='$crrt_gem'";
$qst_usr_lst=$db->query($usr_lst);
$sno=1;
while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
{
    $us_id=$clct_usr_lst['user_id'];
    
    
  $usr_dtls="select * from users where user_id='$us_id'";
    $qst_usr_dtls=$db->query($usr_dtls);
    $clct_usr_dtls=$qst_usr_dtls->fetch_assoc();
    
    $usre_nem=$clct_usr_dtls['user_name'];
       $gm_prd=$clct_usr_lst['period'];
       $us_chs_clr=$clct_usr_lst['selected_color'];
        $us_chs_nbr=$clct_usr_lst['selected_number'];
        $bttd_amnt=$clct_usr_lst['amount'];
        
        
        
?><tr>
    <td><?php echo $sno++;?></td>
    <td>Bcone</td>
    <td><?php echo $gm_prd;?></td>
    <td><?php echo  $usre_nem;?></td>
    <td><?php echo $us_chs_clr;?></td>
    <td><?php echo $us_chs_nbr;?></td>
    <td><?php echo $bttd_amnt;?> <i class='fas fa-inr'></i></td>
     
   

    </tr>
    <?php
}
?>
    
    
</table>
</div>
<?php 
/*}*/
/*}*/
?>




<?php 
/*if(isset($_GET['gm_typ']))
{
    $g_typ=$_GET['gm_typ'];*/
  /* if($g_typ=='Emerd')
   {*/
?>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active">Emerd Game Transactions</li>
</ol>


<div class='col-md-12 table table-responsive'>
<table class='table'>
    
    <tr>
        <th>Sno.</th>
        <th>Game Type</th>
        <th>Game Period</th>
        <th>User name</th>
        <th>Selected Color</th>
        <th>Selected Number </th>
        <th>Bet Amount</th>
       
    </tr>
    
<?php 
$usr_lst="select * from game where game_type='Emerd' and period='$crrt_gem'";
$qst_usr_lst=$db->query($usr_lst);
$sno=1;
while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
{
    $us_id=$clct_usr_lst['user_id'];
    
    
  $usr_dtls="select * from users where user_id='$us_id'";
    $qst_usr_dtls=$db->query($usr_dtls);
    $clct_usr_dtls=$qst_usr_dtls->fetch_assoc();
    
    $usre_nem=$clct_usr_dtls['user_name'];
       $gm_prd=$clct_usr_lst['period'];
       $us_chs_clr=$clct_usr_lst['selected_color'];
        $us_chs_nbr=$clct_usr_lst['selected_number'];
        $bttd_amnt=$clct_usr_lst['amount'];
        
        
        
?><tr>
    <td><?php echo $sno++;?></td>
    <td>Emerd</td>
    <td><?php echo $gm_prd;?></td>
    <td><?php echo  $usre_nem;?></td>
    <td><?php echo $us_chs_clr;?></td>
    <td><?php echo $us_chs_nbr;?></td>
    <td><?php echo $bttd_amnt;?> <i class='fas fa-inr'></i></td>
     
   

    </tr>
    <?php
}
?>
    
    
</table>
</div>
<?php 
/*}*/
/*}*/
?>



</div>
</main>
<script>
function gt_vl(txt)
{
    window.location='current_game.php?gm_typ='+txt;
    
}
</script>
<?php include 'footer.php'; 
ob_flush();

?>