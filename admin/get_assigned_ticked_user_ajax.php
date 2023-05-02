<?php 
@ob_start();
session_start();
include('config/config.php');

$cmp_id=$_POST['txt1'];
$lqdtr_iod=$_POST['txt2'];

?>

<!----upper link start---->

<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<!----Upper links end---------------------->







<div class='col-md-12 table table-responsive'>
    <table class='table' id='myTable'>
        <thead>
<tr>

<th>sno</th>
<th>name</th>
<th>Email</th>
<th>mobile</th>
<th>UID</th>
<th>Password</th>
<th>Status</th>
<th>Action <input type='checkbox' id="fr_slt_all" onclick="select_all();" ></th>


</tr>
</thead>
<tbody>
    <?php 
    $usr_lst="select * from newbidder_login where bidder_add_by_liquiditor_id='$lqdtr_iod'";
    $qst_usr_lst=$db->query($usr_lst);
    $bdr_cnt=mysqli_num_rows($qst_usr_lst);
    $sno=1;
    while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
    {
        $bdr_nem=$clct_usr_lst['Bidder_Name'];
        $bdr_emnl=$clct_usr_lst['Bidder_Email'];
        $bdr_mnbl=$clct_usr_lst['bidder_mobile'];
        $bdr_pswd=$clct_usr_lst['Bidder_Password'];
        $bdr_sts=$clct_usr_lst['status'];
        $bdrs_uid=$clct_usr_lst['uid'];
       $bdr_id=$clct_usr_lst['id'];

$slt_dplc_cnt="select * from assign_bidders_by_liquidator where liquidator_id='$lqdtr_iod' and bidder_id='$bdr_id' and company_id='$cmp_id'";

$qst_slt_dplc_cnt=$db->query($slt_dplc_cnt);

$dplc_ccnt=mysqli_num_rows($qst_slt_dplc_cnt);


    ?><tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $bdr_nem;?></td>
       
        <td><?php echo $bdr_emnl;?></td>
        <td><?php echo $bdr_mnbl;?></td>
        <td><?php echo $bdrs_uid;?></td>
        <td><?php echo $bdr_pswd;?></td>
        <td><?php echo $bdr_sts;?></td>
        
        <td><input type='checkbox' name='bdr_id[]' <?php if($dplc_ccnt==1)
{ ?> checked <?php } ?> value="<?php echo $bdr_id;?>" class='fr_slt'></td>
        
        </tr>
        
        
        
        
        <?php
    }
    ?>
        
</tbody> 
    </table>
    </div>








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
    });
});
    </script>
    
    

<!-------------Downlink and script end----------->


<?php 
ob_flush();
?>

