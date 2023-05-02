<?php 
include('config/config.php');
$id=$_GET['id'];


$clt_asg_lqdtr="select * from assign_liquidator where company_id='$id'";
$qst_clt_asg_lqdtr=$db->query($clt_asg_lqdtr);
$clt_asg_lqdct_cmt=mysqli_num_rows($qst_clt_asg_lqdtr);


$clt_asg_bddr="select * from assign_bidders_by_liquidator where company_id='$id'";
$qst_clt_asg_bddr=$db->query($clt_asg_bddr);
$clt_clt_asg_bddr=mysqli_num_rows($qst_clt_asg_bddr);

$clt__bdsle_netcdr="select * from create_sale where company_id='$id'";
$qst_clt__bdsle_netcdr=$db->query($clt__bdsle_netcdr);
$cnt_clt__bdsle_netcdr=mysqli_num_rows($qst_clt__bdsle_netcdr);



if($clt_asg_lqdct_cmt > 0)
{
     echo "<script>window.location='view_company.php';window.alert('This entry is exist in assign_liquidator first delete from there.');</script>";
}
else if($clt_clt_asg_bddr > 0)
{
     echo "<script>window.location='view_company.php';window.alert('This entry is exist in assign_bidders_by_liquidator first delete from there.');</script>";
}

else if($cnt_clt__bdsle_netcdr > 0)
{
     echo "<script>window.location='view_company.php';window.alert('This entry is exist in create_sale first delete from there.');</script>";
}
else if($clt_asg_lqdct_cmt==0 and $clt_clt_asg_bddr==0 and $cnt_clt__bdsle_netcdr==0)
{

$dlt_cmpy="delete from company where id='$id'";
$qst_dlt_cmpy=$db->query($dlt_cmpy);
if($qst_dlt_cmpy)
{
    echo "<script>window.location='view_company.php';window.alert('Company Deleted successfully');</script>";
}
}
?>