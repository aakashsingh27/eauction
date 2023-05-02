<?php 
include('config/config.php');
$id=$_GET['txt1'];



$clt_lqdtr_cnt_bddr="select * from newbidder_login where bidder_add_by_liquiditor_id='$id'";
$qst_clt_lqdtr_cnt_bddr=$db->query($clt_lqdtr_cnt_bddr);
$lqdtr_cnt=mysqli_num_rows($qst_clt_lqdtr_cnt_bddr);


$clt_lqdtr_cnt_assg="select * from assign_liquidator where liquidator_id='$id'";
$qst_clt_lqdtr_cnt_assg=$db->query($clt_lqdtr_cnt_assg);
$lqdtr_assg_cnt=mysqli_num_rows($qst_clt_lqdtr_cnt_assg);


if($lqdtr_cnt > 0)
{
        echo "<script>window.alert('This liquidator entry is found in newbidder_login first delete from here.');window.location='view_liquiditor.php';</script>";
}
else if($lqdtr_assg_cnt > 0)
{
        echo "<script>window.alert('This liquidator entry is found in assign_liquidator first delete from here.');window.location='view_liquiditor.php';</script>";
}
else if($lqdtr_cnt==0 and $lqdtr_assg_cnt==0)
{


$dlt_llqdtr="delete from add_liquidator where id='$id'";
$qst_dlt_llqdtr=$db->query($dlt_llqdtr);
if($qst_dlt_llqdtr)
{
    echo "<script>window.alert('Liquidator deleted successfully');window.location='view_liquiditor.php';</script>";
}
}
?>