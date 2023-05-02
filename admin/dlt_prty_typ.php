<?php 
include("config/config.php");
$iid=$_GET['id'];


$clt_sel_ntec="select * from create_sale where property_type='$iid'";
$qst_clt_sel_ntec=$db->query($clt_sel_ntec);
$sel_nect_cnt=mysqli_num_rows($qst_clt_sel_ntec);
if($sel_nect_cnt > 0)
{
        echo "<script>window.alert('This entry is exist in create_sale first delete from there');window.location='add_prperty_typ.php';</script>";
}
else if($sel_nect_cnt == 0)
{




$dlt_stet="delete from type_of_property where id='$iid'";
$qst_dlt_stet=$db->query($dlt_stet);

if($qst_dlt_stet)
{
    echo "<script>window.alert('Property type deleted successfully');window.location='add_prperty_typ.php';</script>";
}
}

?>