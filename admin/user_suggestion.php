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

?>

<?php include 'header.php'; ?>
<?php
if (isset($_GET['activate'])) {
    $activate = $_GET['activate'];
    $sql=$db->query("UPDATE suggestion SET status='0' WHERE sugsn_id=$activate ");
    echo "<script>alert(' Deactivate Successfully.'); window.location = './user_suggestion.php';</script>";
}
if (isset($_GET['deactivate'])) {
    $deactivate = $_GET['deactivate'];
    $sql1=$db->query("UPDATE suggestion SET status='1' WHERE sugsn_id=$deactivate");
    echo "<script>alert('Activate Successfully.'); window.location = './user_suggestion.php';</script>";
}
?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<h2 class="mt-30 page-title">All Suggestion List</h2>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active">All Suggestion List</li>
</ol>


<div class='col-md-12 table table-responsive'>
    <table class='table'>
        
        <tr>
            <th>Sno.</th>
            <th>Suggestion Type</th>
            <th>OUT ID</th>
            <th>Whatsapp</th>
            <th>Date</th>
            <th>Status</th>
      
        </tr>
        
    <?php 
    $usr_lst="select * from suggestion";
    $qst_usr_lst=$db->query($usr_lst);
    $sno=1;
    while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
    {
        $sugsn_id=$clct_usr_lst['sugsn_id'];
         $suggestion_type=$clct_usr_lst['suggestion_type'];
          $out_id=$clct_usr_lst['out_id'];
           $whatsapp=$clct_usr_lst['whatsapp'];
           $description=$clct_usr_lst['description'];
           $date=$clct_usr_lst['date'];
            $status=$clct_usr_lst['status'];
                   
           
    
    ?><tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $suggestion_type;?></td>
        <td><?php echo $out_id;?></td>
        <td><?php echo $whatsapp;?></td>
        <td><?php echo $date;?></td>
        
        <td><?php if($status=='1')
        {
        ?>
        
        <a href="user_suggestion.php?activate=<?php echo $sugsn_id; ?>"
          class="btn btn-info btn-sm">Active</a>
        <?php
            
        }
        else 
        {
        ?>
       
    <a href="user_suggestion.php?deactivate=<?php echo $sugsn_id; ?>"
          class="btn btn-danger btn-sm">Deactivate</a>
         <?php
            
        }
        ?></td>
    
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