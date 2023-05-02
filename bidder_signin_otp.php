<?php
require("class.phpmailer.php");

$mail = new PHPMailer();

$mail->IsSMTP();
$mail->Host = "eauction.ipsupport.in";

$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Port = 465;

//$mail->Port = 587;
$mail->Username = "support@ipsupport.in";
$mail->Password = "jigsaw@3208";

$mail->From = "support@ipsupport.in";
$mail->FromName = "Bidder Otp";
$mail->AddAddress("$bidder_emnl");
//$mail->AddReplyTo("mail@mail.com");

$mail->IsHTML(true);

$mail->Subject = "IP Support (OTP VERIFCATION)--Date-time ($crt_det_tme)";
$mail->Body = "<p3>Dear Ma’am/Sir,</p3><br><br>
<p3>Greeting of the day !!</p3><br><br>
<p3>Your Email verification otp is $otp  </p3><br><br>
<p3>Please Enter OTP and verify your email.</p3><br><br>


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
//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

if(!$mail->Send())
{
echo "Message could not be sent. <p>";
echo "Mailer Error: " . $mail->ErrorInfo;
exit;
}

//echo "<script>window.alert('OTP sent on you Email Please check and verify');window.location='verify_signin_otp.php?bddr_id=$usrr_id';</script>";

?>