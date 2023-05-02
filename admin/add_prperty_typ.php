<?php
@ob_start();
//session_start();
require_once 'config/config.php';
date_default_timezone_set("Asia/Kolkata");
$cr_dt_ymd=date('Y-m-d');

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php include 'header.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>





<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid" >
<!--<h2 class="mt-30 page-title" style="
    color: red;
    font-size: 30px;
    font-weight: 600;
">Add property type</h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Add property type</li>
</ol>

<div class="container-fluid">

<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
 



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Property type</label>
<input type='text' placeholder='Enter Property type' name="prprty_type" class="form-control" maxlength='50'  required style="border:1px solid black !important;">
</div>



<div class="form-group col-md-12">

<button type='submit' name="submit" class='btn btn-primary'>Submit</button> <button type="button" class="btn btn-warning" onclick="window.history.back()">Back</button>
</div>
</div>
</form>

<?php 


  
  if(isset($_POST['submit']))
  {

$propty_type =$_POST['prprty_type'];

$slt_dplc="select * from type_of_property where `property_type`='$propty_type'";
$qst_slt_dplc=$db->query($slt_dplc);
$bdr_cnt=mysqli_num_rows($qst_slt_dplc);  
if($bdr_cnt==0)
{



$sql="INSERT INTO `type_of_property` set 
`property_type`='$propty_type'";
$result=mysqli_query($db,$sql);
    
    // print_r($sql);
    if($result)
    {
      
       echo "<script>alert('Property added successfully');
         window.location.href='';
       </script>";
      // echo "check";
      
     
     
    } else { 
      echo "<script>alert(' Not inserted Please Try Again');
         window.location.href='';
       </script>";
      // echo "not check";
    }
}
else
{
    echo "<script>alert('This property type is already exist please try again !!!');
    window.location.href='';
  </script>";
}
}
?>

<div class='col-md-12 table table-responsive' style="border:none !important;">
    <table class='table' id='myTable' style="border:2px solid black !important;">
    <thead>   
<tr>

<th style="border-bottom:2px solid black !important;">Sno</th>
<th style="border-bottom:2px solid black !important;">Property Type</th>
<th style="border-bottom:2px solid black !important;">Action</th>
</tr>
</thead>
   <tbody>     
    <?php 
    $usr_lst="select * from type_of_property ";
    $qst_usr_lst=$db->query($usr_lst);
    $sno=1;
    while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
    {
        $stet_nem=$clct_usr_lst['property_type'];
        $stet_id=$clct_usr_lst['id'];
       
    ?><tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $stet_nem;?></td>
        <td><a href='edit_proprty_typ.php?id=<?php echo $stet_id;?>' class='btn btn-primary'>Edit</a> 
        <a href='dlt_prty_typ.php?id=<?php echo $stet_id;?>' onclick="return confirm('Are you sure want to delete?')" class='btn btn-danger'>Delete </a></td>
        </tr>

        <?php
    }
    ?>
        </tbody>
        
    </table>
    </div>

</div>
</div>
</main>


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
?>


<script>
$(document).ready(function() { 
 $("#ddsd").select2();
});
</script>


<script>
                        CKEDITOR.replace( 'srv_dtl' );
                </script>

<?php
ob_flush();

?>