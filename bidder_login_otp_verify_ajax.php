<?php 
include("admin/config/config.php");

$bidder_uid=$_POST['txt1'];
$otp=$_POST['txt2'];


 $clt_usr_dtl="select * from newbidder_login where uid='$bidder_uid' and otp='$otp' and status='active'";
                  
                 $qst_clt_usr_dtl=$db->query($clt_usr_dtl);
                $bderr_cnt=mysqli_num_rows($qst_clt_usr_dtl);

                if($bderr_cnt==1)
                {
                  $clct_clt_usr_dtl=$qst_clt_usr_dtl->fetch_assoc();
                $usrr_id=$clct_clt_usr_dtl['id'];
                $lqdtr_id=$clct_clt_usr_dtl['bidder_add_by_liquiditor_id'];

$rand_session=rand(99999,999999999);


$upd_bdr_ssn="update newbidder_login set user_logged_in_id='$rand_session' where id='$usrr_id'";
$qst_upd_bdr_ssn=$db->query($upd_bdr_ssn);

                @ob_start();
                
              
                session_start();
                $_SESSION['bddr_id']=$usrr_id;
                $_SESSION['liquiditor_id']=$lqdtr_id;
                $_SESSION['ssn_id']=$rand_session;
                if(isset($_SESSION['bddr_id']))
                {

              echo json_encode(array("status"=>1,"Response"=>"Logged in successfully"));
                }
                else
                {
                  echo "<script>window.alert('session no setted');</script>";
                }
                ob_flush();
}
else if($bderr_cnt==0)
{
    echo json_encode(array("status"=>0,"Response"=>"Wrong OTP please try again"));
}

?>