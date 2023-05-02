<?php
date_default_timezone_set("Asia/Kolkata");
include("config/config.php");
$crt_det_tme=date('Y-m-d h:i:s');
if(isset($_GET['id']))
{
    $lqdtr_iid=$_GET['id'];
    
    $clt_bdr_dtl="select * from add_liquidator where id='$lqdtr_iid'";
  $qst_clt_bdr_dtl=$db->query($clt_bdr_dtl);
  $clct_clt_bdr_dtl=$qst_clt_bdr_dtl->fetch_assoc();
  
  
  $lqdtr_emnl=$clct_clt_bdr_dtl['liquidator_email'];
  $lqdtr_pswd=$clct_clt_bdr_dtl['liquidator_password'];
 
  
  
  //email start start

   
$to = "$lqdtr_emnl";                                                        
$subject = "IP Support (Liquidator Login Credentials)--Date-time ($crt_det_tme)";
$txt = "<p3>Dear Ma’am/Sir,</p3><br><br>
<p3>Greeting of the day !!</p3><br><br>
<p3>Your Liquidator Credentials are give below please check and login</p3><br><br>
<p3> <a href='https://eauction.ipsupport.in/liquidator'>click here to login </a></p3><br>
<p3><b>Username :- </b> $lqdtr_emnl</p3><br><br>
<p3><b>Password :- </b>$lqdtr_pswd</p3><br><br>

<p3>Thanks Regards</p3><br>
<hr></hr>
<p3><span style='color:blue;font-weight:bold;'>IPSupport Team</span></p3><br><br>
<p3 style='font-weight:bold;'>Sabre Edge IT Solutions</p3><br>
<p3><i>We work “Hard” so that you can work “Smart”</i></p3><br>


<p3><span style='font-weight:bold;'>Office :- </span>3208, 2 nd floor, Mahindra Park, Near Rani Bagh, Delhi-110034</p3> <br>
<p3><span style='font-weight:bold'>Desk:- </span> +91 11 4702-4666 | M: +91 93110 24666</p3><br>





<p3><span style='font-weight:bold'>Email :- </span> mail@ipsupport.in </p3><br>
<h3><span style='font-weight:bold'>Url:-</span><a href='https://www.ipsupport.in'> www.ipsupport.in</a></h3><br>

<p3><span style='font-weight:bold;'>DISCLAIMER: </span>This communication is confidential and privileged and is directed to and
for the use of the addressee only. The recipient if not the addressee should not use this
message if erroneously received, and access and use of this e-mail in any manner by
anyone other than the addressee is unauthorized. The recipient acknowledges
that <span style='font-weight:bold'>IPSupport </span> may be unable to exercise control or ensure or guarantee the integrity of
the text of the email message and the text is not warranted as to completeness and
accuracy. Before opening and accessing the attachment, if any, please check and scan
for virus.</p3>";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <support@ipsupport.in>' . "\r\n";
//$headers .= 'Bcc: saurabh@jigsaw.edu.in' . "\r\n";

if(mail($to,$subject,$txt,$headers))
{
     // echo "<script>window.alert('User mail sent successfully');window.location='view_bdrs.php';</script>";
    //  echo "<script>window.alert('Email sent successfully');window.location='view_bdrs.php';</script>";
    
    $upd_emnl_sts="update add_liquidator set email_sent_status='send' where id='$lqdtr_iid'";
    $qst_upd_emnl_sts=$db->query($upd_emnl_sts);
    if($qst_upd_emnl_sts)
    {
    ?>
    
    <script>window.alert('Liquidator mail send successfully');window.location='view_liquiditor.php';</script>
    <?php
}
}
//email end
}
?>