<?php 
@ob_start();
include('admin/config/config.php');
 date_default_timezone_set('Asia/Kolkata');
$date_time=date('Y-m-d H:i:s');
 
$stet_id=$_POST['txt1'];
$prty_ttyp=$_POST['txt2'];
$budget_value=$_POST['txt3'];
$bedgt_ferm=$_POST['txt4'];
$bedgt_to=$_POST['txt5'];
?>

<?php
if($prty_ttyp!='' and $stet_id!='' and $budget_value=='' )
{
 $clt_sl_netc_dtl="select * from create_sale where state_id='$stet_id' and property_type='$prty_ttyp'";
}

if($prty_ttyp!='' and $stet_id=='' and $budget_value=='' )
{
$clt_sl_netc_dtl="select * from create_sale where property_type='$prty_ttyp'";
}

if($stet_id!='' and $budget_value=='' and $prty_ttyp=="")
{
  $clt_sl_netc_dtl="select * from create_sale where state_id='$stet_id'";
}
if($budget_value!='')
{
    
if($prty_ttyp=='' and $stet_id=='' and $budget_value=='equal' and $bedgt_ferm!='')
{
$clt_sl_netc_dtl="select * from create_sale where Reserve_Price='$bedgt_ferm'";
}
if($prty_ttyp=='' and $stet_id=='' and $budget_value=='not_equal' and $bedgt_ferm!='')
{
$clt_sl_netc_dtl="select * from create_sale where Reserve_Price!='$bedgt_ferm'";
}
if($prty_ttyp=='' and $stet_id=='' and $budget_value=='less' and $bedgt_ferm!='')
{
$clt_sl_netc_dtl="select * from create_sale where Reserve_Price < '$bedgt_ferm'";
}

if($prty_ttyp=='' and $stet_id=='' and $budget_value=='less_or_equal' and $bedgt_ferm!='')
{
$clt_sl_netc_dtl="select * from create_sale where Reserve_Price < '$bedgt_ferm' or Reserve_Price = '$bedgt_ferm'";
}

if($prty_ttyp=='' and $stet_id=='' and $budget_value=='greater' and $bedgt_ferm!='')
{
$clt_sl_netc_dtl="select * from create_sale where Reserve_Price > '$bedgt_ferm'";
}
if($prty_ttyp=='' and $stet_id=='' and $budget_value=='greater_or_equal' and $bedgt_ferm!='')
{
$clt_sl_netc_dtl="select * from create_sale where Reserve_Price > '$bedgt_ferm' or Reserve_Price = '$bedgt_ferm'";
}
if($prty_ttyp=='' and $stet_id=='' and $budget_value=='between' and $bedgt_ferm!='')
{
$clt_sl_netc_dtl="select * from create_sale where Reserve_Price BETWEEN '$bedgt_ferm' AND '$bedgt_to'";
}


if($budget_value=='equal' and $prty_ttyp!='' and $stet_id!='')
{
$clt_sl_netc_dtl="select * from create_sale where state_id='$stet_id' and property_type='$prty_ttyp' and Reserve_Price='$bedgt_ferm'";
}
if($budget_value=='not_equal' and $prty_ttyp!='' and $stet_id!='')
{
$clt_sl_netc_dtl="select * from create_sale where state_id='$stet_id' and property_type='$prty_ttyp' and Reserve_Price!='$bedgt_ferm'";
}
if($budget_value=='less' and $prty_ttyp!='' and $stet_id!='')
{
    $clt_sl_netc_dtl="select * from create_sale where state_id='$stet_id' and property_type='$prty_ttyp' and Reserve_Price < '$bedgt_ferm'";
}
if($budget_value=='less_or_equal' and $prty_ttyp!='' and $stet_id!='')
{
    $clt_sl_netc_dtl="select * from create_sale where state_id='$stet_id' and property_type='$prty_ttyp' and Reserve_Price < '$bedgt_ferm' or Reserve_Price = '$bedgt_ferm'";
}

if($budget_value=='greater' and $prty_ttyp!='' and $stet_id!='')
{
    $clt_sl_netc_dtl="select * from create_sale where state_id='$stet_id' and property_type='$prty_ttyp' and Reserve_Price > '$bedgt_ferm'";
}

if($budget_value=='greater_or_equal' and $prty_ttyp!='' and $stet_id!='')
{
    $clt_sl_netc_dtl="select * from create_sale where state_id='$stet_id' and property_type='$prty_ttyp' and Reserve_Price > '$bedgt_ferm' or Reserve_Price = '$bedgt_ferm'";
}


if($budget_value=='between' and $prty_ttyp!='' and $stet_id!='')
{
    $clt_sl_netc_dtl="select * from create_sale where state_id='$stet_id' and property_type='$prty_ttyp' and Reserve_Price BETWEEN '$bedgt_ferm' AND '$bedgt_to'";
}
}
// $clt_sl_netc_dtl="select * from create_sale where Start_Date_Auction > '$date_time' and End_Date_Auction > '$date_time'";
$qst_clt_sl_netc_dtl=$db->query($clt_sl_netc_dtl);
$tbl_cnt=mysqli_num_rows($qst_clt_sl_netc_dtl);
if($tbl_cnt > 0)
{
?>

<table class='table' >
<tr style="
background: #f76767;">
<th class="text-white">Sno</th>
<th class="text-white">Name Of The Company</th>
<th class="text-white">Auction Items</th>
<th class="text-white">Auction Date</th>

<th class="text-white">Contact Person</th>
<th class="text-white">Contact Email</th>

<!-- <th class="text-white">Contact Details</th> -->
<th class="text-white">Auction price</th>
<th class="text-white">File</th>
<th class="text-white">File 2</th>
<th class="text-white">File 3</th>
<th class="text-white">File 4</th>
<th class="text-white">File 5</th>
<th class="text-white">File Name</th>
<th class="text-white">Action</th>

</tr>

<?php 

$sno=1;
while($clct_clt_sl_netc_dtl=$qst_clt_sl_netc_dtl->fetch_assoc())
{

$asst_name=$clct_clt_sl_netc_dtl['Title'];
$lqdtr_id=$clct_clt_sl_netc_dtl['create_by_liquiditor_id'];
$sel_id=$clct_clt_sl_netc_dtl['id'];
$cmp_id=$clct_clt_sl_netc_dtl['company_id'];
$supr_cmpp_neme=$clct_clt_sl_netc_dtl['super_company_name'];



$clt_dsp_cmpny="select * from display_company where id='$supr_cmpp_neme'";
$qst_clt_dsp_cmpny=$db->query($clt_dsp_cmpny);
$clclt_clt_dsp_cmpny=$qst_clt_dsp_cmpny->fetch_assoc();

$sup_cmpy=$clclt_clt_dsp_cmpny['company_name'];


$clt_cmp_dtl="select * from company where id='$cmp_id'";
$qst_clt_cmp_dtl=$db->query($clt_cmp_dtl);
$cclt_clt_cmp_dtl=$qst_clt_cmp_dtl->fetch_assoc();

$cmpny_nem=$cclt_clt_cmp_dtl['company_name'];


$clt_dtl="select * from add_liquidator where id='$lqdtr_id'";
$qst_clt_dtl=$db->query($clt_dtl);
$clct_clt_dtl=$qst_clt_dtl->fetch_assoc();

$lqdter_nem=$clct_clt_dtl['liquidator_name'];
$lqdter_emnll=$clct_clt_dtl['liquidator_email'];

$rsrve_prec=$clct_clt_sl_netc_dtl['Reserve_Price'];
$emd=$clct_clt_sl_netc_dtl['emp'];

$strt_det=$clct_clt_sl_netc_dtl['Start_Date_Auction'];
$end_det=$clct_clt_sl_netc_dtl['End_Date_Auction'];
$pdfs=$clct_clt_sl_netc_dtl['Pdf'];


$pdf_file2=$clct_clt_sl_netc_dtl['pdf2'];
$pdf_file3=$clct_clt_sl_netc_dtl['pdf3'];
$pdf_file4=$clct_clt_sl_netc_dtl['pdf4'];
$pdf_file5=$clct_clt_sl_netc_dtl['pdf5'];

?>

<tr style="border:1px solid #8a8a8a;background:white;">
<td><?php echo $sno++;?></td>
<td><?php echo $sup_cmpy;?></td>
<td><?php echo $asst_name;?></td>
<td><?php echo $end_det;?></td>
<td><?php echo $lqdter_nem;?></td>
<td><?php echo $lqdter_emnll;?></td>
<td><?php echo $rsrve_prec;?>₹</td>
                  
                 
<td><?php if($pdfs!=NULL) {?><a href='liquidator/sale_notice_pdf/<?php echo $pdfs;?>' traget="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;font-size: 25px;"></i></a> <?php } ?>
                
</td>

<td><?php if($pdf_file2!=NULL) {?> <a href='liquidator/sale_notice_pdf/<?php echo $pdf_file2;?>' traget="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;font-size: 25px;"></i></a> <?php } ?>
                
</td>

<td><?php if($pdf_file3!=NULL) {?> <a href='liquidator/sale_notice_pdf/<?php echo $pdf_file3;?>' traget="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;font-size: 25px;"></i></a> <?php }?>
                 
</td>

<td><?php if($pdf_file4!=NULL) {?><a href='liquidator/sale_notice_pdf/<?php echo $pdf_file4;?>' traget="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;font-size: 25px;"></i></a> <?php }?>
                    


</td>
<td><?php if($pdf_file5!=NULL) {?><a href='liquidator/sale_notice_pdf/<?php echo $pdf_file5;?>' traget="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;font-size: 25px;"></i></a> <?php } ?>
</td>

<td><?php echo $pdfs;?></td>
                    
<td> <?php 
if($end_det > $date_time and  $strt_det > $date_time)
{
?>
<?php if(isset($_SESSION['bddr_id'])){?><a href='bideshboard.php?id=<?php echo $sel_id;?>' class='btn btn-primary' style="width:120px;">Bid</a><?php } else if(!isset($_SESSION['bddr_id'])){ ?> <a href='signup_bidder.php?ntc_id=<?php echo $sel_id;?>' class='btn btn-primary' style="width:120px;">Bid</a><?php } ?>
<?php 
}
else
{
?>
<a href="#" class='btn btn-danger'>Closed Bid</a>
<?php
}
?>
</td>
</tr>
<?php }?>


</table>
<?php 
}
else
{
?>
<h3>There is no result found please try again</h3><br><br>
<?php
}
?>
<?php 
ob_flush();
?>