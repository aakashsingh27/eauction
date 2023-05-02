<?php

//index.php

$message = '';

//$db = new PDO("mysql:host=localhost;dbname=sahaipp5_eauction1", "sahaipp5_eauction1", "bG6XmB*E09S]");

$db=mysqli_connect("localhost","sahaipp5_eauction1","bG6XmB*E09S]","sahaipp5_eauction1");
//include("../admin/config/config.php");
function fetch_customer_data($db)
{
date_default_timezone_set('Asia/Kolkata');
    
$ctr_det=date('Y-m-d H:i:s');

echo $query = "SELECT * FROM create_sale where Start_Date_Auction < '$ctr_det' and End_Date_Auction < '$ctr_det' and liquidator_email_sent_status IS NOT NULL ORDER BY id ASC";
$qst_query=$db->query($query);
$clct_query=$qst_query->fetch_assoc();
$actn_id=$clct_query['id'];


$actn_nem=$clct_query['Title'];
$actn_type=$clct_query['auction_type'];
$actn_strt_det=$clct_query['Start_Date_Auction'];
$end_strt_det=$clct_query['End_Date_Auction'];
$lqdtr_id=$clct_query['create_by_liquiditor_id'];

$lqdtr_dtl="select * from add_liquidator where id='$lqdtr_id'";
$qst_lqdtr_dtl=$db->query($lqdtr_dtl);

$clct_lqdtr_dtl=$qst_lqdtr_dtl->fetch_assoc();

$lqdtr_nem=$clct_lqdtr_dtl['liquidator_name'];
$lqdtr_emnl=$clct_lqdtr_dtl['liquidator_email'];


//echo "kkdkdkk  $lqdtr_emnl ";

 if($actn_type=="forward")
    {
    $usr_lst="select max(highestBid) as hgst_bd from livebidding where salenotice_id='$actn_id'";
    $qst_usr_lst=$db->query($usr_lst);
    $sno=1;
    $clct_usr_lst=$qst_usr_lst->fetch_assoc();
    
        $hgest_bid=$clct_usr_lst['hgst_bd'];

    }
    else if($actn_type=="reverse")
    {
        $usr_lst="select min(highestBid) as hgst_bd from livebidding where salenotice_id='$actn_id'";
    $qst_usr_lst=$db->query($usr_lst);
    $sno=1;
    $clct_usr_lst=$qst_usr_lst->fetch_assoc();
    
        $hgest_bid=$clct_usr_lst['hgst_bd'];
    }


$clt_bdr_dtl="select * from livebidding where highestBid='$hgest_bid'";
$qst_clt_bdr_dtl=$db->query($clt_bdr_dtl);
$clct_clt_bdr_dtl=$qst_clt_bdr_dtl->fetch_assoc();

$bdr_id=$clct_clt_bdr_dtl['bidder_fid'];
$hgst_bd_det_tem=$clct_clt_bdr_dtl['datetime'];

$slt_bdr_dtl="select * from newbidder_login where id='$bdr_id'";
$qst_slt_bdr_dtl=$db->query($slt_bdr_dtl);
$clct_slt_bdr_dtl=$qst_slt_bdr_dtl->fetch_assoc();

$bder_nem=$clct_slt_bdr_dtl['Bidder_Name'];
$bder_uid=$clct_slt_bdr_dtl['uid'];

$bdder_emnl=$clct_slt_bdr_dtl['Bidder_Email'];
$bdder_mbl=$clct_slt_bdr_dtl['bidder_mobile'];



$output = '
<div id="bdr_report"> <div class="row" style="margin-bottom: 10px;"> 
<div class="col-md-2 col-xs-2"> <h3>Sabre Edge <span style="color:#ff4a17;">IT-Solution</h3></div>
<div class="col-md-8 col-xs-8" style="padding-top:10px;padding-right: 135px;"><br><br><span style="float:right;font-weight:bold !important;font-size:18px;" >SABRE EDGE IT SOLUTIONS</span><br><hr></div>
<div class="col-md-2 col-xs-2"></div> </div><div class="row"></div>
<div style="margin-top:15px;"><h3 style="padding-top:15px;">Auction Details:</h3></div>
<div class="col-md-12 table table-responsive">
<table class="table" id="myTable"> 
<tbody> 
<tr><th>Liquidator : </th><td>'.$lqdtr_nem.'</td></tr>
<tr><th>Start date : </th><td>'.$actn_strt_det.'</td></tr>
<tr><th>End date   : </th><td>'.$end_strt_det.'</td></tr>
<tr><th>Auction ID : </th><td>'.$actn_id.'</td></tr>
<tr><th>Asset Name : </th><td>'.$actn_nem.'</td></tr>
</tbody> </table> </div>

<div style="margin-top:15px;"><h3 style="padding-top:15px;">Winner Details:</h3></div>
<div class="col-md-12 table table-responsive"> 
<table class="table" id="myTable"> 
<tbody> 
<tr><th>Name        : </th><td>'.$bder_nem.'</td></tr>
<tr><th>UID         : </th><td>'.$bder_uid.'</td></tr>
<tr><th>E-mail-id   : </th><td>'.$bdder_emnl.'</td></tr>
<tr><th>Mobile      : </th><td>'.$bdder_mbl.'</td></tr>
</tbody>

</table> 

</div>






<h3>Bidders bid</h3>
<div class="col-md-12 table table-responsive"> <table class="table" id="myTable"> <thead>
<tr><th>sno</th><th>Bid Amount</th><th>Bid Date and time </th><th>Ip Address</th></tr>
</thead><tbody> ';

$usr_lst="select * from livebidding where salenotice_id='$actn_id'";
    $qst_usr_lst=$db->query($usr_lst);
    $sno=1;
     while($clct_usr_lst=$qst_usr_lst->fetch_assoc())
    {
        $rsrv_prec=$clct_usr_lst['reserver_Price'];
        $hgst_bid=$clct_usr_lst['highestBid'];
        $nxt_bid=$clct_usr_lst['nextBid'];
        $bdr_id=$clct_usr_lst['bidder_fid'];
        $incrmnt_vlu=$clct_usr_lst['incremental_val'];
        $ip_adrs=$clct_usr_lst['ipaddress'];
        $det_tem=$clct_usr_lst['datetime'];
        

$clt_bdr_dtl="select * from newbidder_login where id='$bdr_id'";
$qst_clt_bdr_dtl=$db->query($clt_bdr_dtl);
$clct_clt_bdr_dtl=$qst_clt_bdr_dtl->fetch_assoc();

$bdr_nem=$clct_clt_bdr_dtl['Bidder_Name'];
$bdr_uid=$clct_clt_bdr_dtl['uid'];

$output .='
<tr> <td>'.$sno++.'</td> <td>'.$hgst_bid.'</td> <td>'.$det_tem.'</td> <td>'.$ip_adrs.'</td> </tr>';


}
$output .='

</tbody> </table> </div>
<div class="row" style="margin-top:15px;"><span><b>Note :-</b> This is system generated auction details on safe and protected platform provided by Sabre Edge IT Solutions.</span></div></div>
		';

	$output .= '';
	return $output;
}

/*if(isset($_POST['action']))
{
    */
    date_default_timezone_set('Asia/Kolkata');



    
 $ctr_det=date('Y-m-d H:i:s');
$query = "SELECT * FROM create_sale where End_Date_Auction < '$ctr_det' and liquidator_email_sent_status IS NULL ORDER BY id desc";
$qst_query=$db->query($query);
$clct_query=$qst_query->fetch_assoc();

$lqdtr_id=$clct_query['create_by_liquiditor_id'];
$actn_id=$clct_query['id'];
echo $lqdtr_dtl="select * from add_liquidator where id='$lqdtr_id'";
$qst_lqdtr_dtl=$db->query($lqdtr_dtl);

$clct_lqdtr_dtl=$qst_lqdtr_dtl->fetch_assoc();


echo $lqdtr_emnl=$clct_lqdtr_dtl['liquidator_email'];
   
  	include('pdf.php');
	$file_name = md5(rand()) . '.pdf';
	$html_code = '<link rel="stylesheet" href="https://eauction.ipsupport.in/pddf/bootstrap.min.css">';
	$html_code .= fetch_customer_data($db);
	$pdf = new Pdf();
	$pdf->load_html($html_code);
	$pdf->render();
	$file = $pdf->output();
	file_put_contents($file_name, $file);
	
	require 'class/class.phpmailer.php';
	$mail = new PHPMailer;
$mail->IsSMTP();
$mail->Host = "testauction.ipsupport.in";

$mail->SMTPAuth = true;
//$mail->SMTPSecure = "ssl";
$mail->Port = 587;
$mail->Username = "test@testauction.ipsupport.in";
$mail->Password = "+Q%9}Xma^{@T";

$mail->From = "test@testauction.ipsupport.in";
$mail->FromName = "Test from Info";
$mail->AddAddress("developer@jigsaw.edu.in");
//$mail->AddReplyTo("mail@mail.com");

$mail->IsHTML(true);
	$mail->AddAttachment($file_name);     				//Adds an attachment from a path on the filesystem
	$mail->Subject = 'Bid Final Reports';
	   

$mail->Body = "<p3>Dear Ma’am/Sir,</p3><br><br>
<p3>Greeting of the day !!</p3><br><br>
<p3>Your Bid Final Bid Report is attached below.</p3><br><br>
<p3> <a href='https://eauction.ipsupport.in/liquidator'>click here to login </a></p3><br>


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
if($mail->Send())
{
    
echo "Message has been sent ";

echo $upd_sel_netc="update create_sale set liquidator_email_sent_status='sent' where id='$actn_id'";
$qst_upd_sel_netc=$db->query($upd_sel_netc);

}

/*}*/



?>
<!DOCTYPE html>
<html>
	<head>
		<title>Create Dynamic PDF Send As Attachment with Email in PHP</title>
		<script src="jquery.min.js"></script>
		<!--<link rel="stylesheet" href="bootstrap.min.css" />-->
		<!--<script src="bootstrap.min.js"></script>-->
	</head>
	<body>
		<br />
		<div class="container">
			<h3 align="center">Create Dynamic PDF Send As Attachment with Email in PHP</h3>
			<br />
			<form method="post">
				<input type="submit" name="action" class="btn btn-danger" value="PDF Send" /><?php echo $message; ?>
			</form>
			<br />
			<?php
			echo fetch_customer_data($db);
			?>			
		</div>
		<br />
		<br />
	</body>
</html>





