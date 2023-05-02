<?php 
@ob_start();
include("admin/config/config.php");


if(isset($_GET['id']))
{
$sel_netc_id=$_GET['id'];

}

if(isset($_SESSION['bddr_id']))
{
$lqdtr_id=$_SESSION['liquiditor_id'];
$bdr_iid=$_SESSION['bddr_id'];


$clt_bdr_dtl="select * from newbidder_login where id='$bdr_iid'";
$qst_clt_bdr_dtl=$db->query($clt_bdr_dtl);
$clct_clt_bdr_dtl=$qst_clt_bdr_dtl->fetch_assoc();

$bdr_emnl=$clct_clt_bdr_dtl['Bidder_Email'];



}


$clt_sel_ntec="select * from create_sale where id='$sel_netc_id'";
$qst_clt_sel_ntec=$db->query($clt_sel_ntec);
$clct_clt_sel_ntec=$qst_clt_sel_ntec->fetch_assoc();

$sale_netc_nem=$clct_clt_sel_ntec['Title'];


$clt_crt_actn="select * from livebidding where salenotice_id='$sel_netc_id'";
$qst_clt_crt_actn=$db->query($clt_crt_actn);
$clct_cnt=mysqli_num_rows($qst_clt_crt_actn);





$clt_mx_dtl="select max(highestBid) as high_bid from livebidding where salenotice_id='$sel_netc_id'";
$qst_clt_mx_dtl=$db->query($clt_mx_dtl);
$clct_clt_mx_dtl=$qst_clt_mx_dtl->fetch_assoc();

$hg_bid=$clct_clt_mx_dtl['high_bid'];


$clt_lggdn_dtl="select max(highestBid) as high_bid from livebidding where salenotice_id='$sel_netc_id' and bidder_fid='$bdr_iid'";
$qst_clt_lggdn_dtl=$db->query($clt_lggdn_dtl);
$clct_clt_lggdn_dtl=$qst_clt_lggdn_dtl->fetch_assoc();

$hg_lggn_bid=$clct_clt_lggdn_dtl['high_bid'];




?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Auction details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <!-- <h2>Modal Example</h2> -->
  <!-- Trigger the modal with a button -->
  <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
       
          <h4 class="modal-title" style="font-weight:bold;">Auction Details </h4>
        </div>
        <div class="modal-body"><br> 
        <?php
        if($clct_cnt !=0)
        {
         if($hg_bid==$hg_lggn_bid)
        {
            
//email start start

   
$to = "$bdr_emnl";
$subject = "Auction Details";
$txt = "<p3>Dear Ma’am/Sir,</p3><br><br>
<p3>Greeting of the day !!</p3><br><br>

<span style='font-weight:bold;'>Congratulations you won this auction</span>
The details are given below. of the winning auction</p3><br><br>

<p3><b>Auction title :- </b> $sale_netc_nem</p3><br><br>
<p3><b>Bid amount :- </b>$hg_bid</p3><br><br>  



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
     //  echo "<script>alert('User mail sent successfully');</script>";
}



//email end



        ?>
          <p style="color:green;font-weight:bold;font-size:30px;text-align:center">You won this Auction</p>
      
        <?php 
        }
        else if($hg_bid!=$hg_lggn_bid)
        {
            ?>
            <p style="color:red;font-weight:bold;font-size:30px;text-align:center">Auction is Closed</p>
            <?php
        }
    }
    else
    {
        ?>
             <p style="color:red;font-weight:bold;font-size:30px;text-align:center">Auction is Closed</p>
        <?php
    }
        ?> 
        <p style="font-weight:bold;text-align:center">Thanks for participating</p>
         
        </div>
        <div class="modal-footer">
          <a href="view_aution_details.php" class="btn btn-default" >Close</a>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

<script type="text/javascript">
    $(window).on('load', function() {
        $('#myModal').modal({backdrop: 'static', keyboard: false}, 'show');
    });
</script>
</body>
</html>

<?php 
ob_flush();
?>