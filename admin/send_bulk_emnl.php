<?php
@ob_start();
//session_start();
require_once 'config/config.php';
date_default_timezone_set("Asia/Kolkata");
$cr_dt_ymd=date('Y-m-d');
$crt_det_tme= date('Y-m-d h:i:s');
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


<?php include 'header.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!--<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>-->

   <!-- include summernote css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" />
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
    <!-- include summernote js-->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<!---------Modal links start------------>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <!--<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>-->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<!--------Modal links end------------->

<div id="layoutSidenav_content">
<main>
<div class="container-fluid" >
<!--<h2 class="mt-30 page-title" style="
    color: red;
    font-size: 30px;
    font-weight: 600;
">Send Email</h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Send Email</li>
</ol>

<div class="container-fluid">

<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
 



<div class="form-group col-md-12 col-xs-12">
<label class="form-label" style="font-size:16px !important;font-weight:bold;">Choose Liquidator <span style='color:red'>*</span></label>
<select name="lqdetr" id="lqddtr" class="form-control" required style="border:1px solid black !important;">
<option value="" disabled selected>-Choose Liquidator-</option>
<?php 
$clt_dtl="select * from add_liquidator";
$qst_clt_dtl=$db->query($clt_dtl);
while($clct_clt_dtl=$qst_clt_dtl->fetch_assoc())
{
    $lqdtr_id=$clct_clt_dtl['id'];
    $lqdtr_nem=$clct_clt_dtl['liquidator_name'];
    
    ?>
<option value="<?php echo $lqdtr_id;?>"><?php echo $lqdtr_nem;?></option>
    <?php
}



?>

</select>
</div>

<div class="form-group col-md-12 col-xs-12">
<label class="form-label" style="font-size:16px !important;font-weight:bold;">Choose Bidder <span style='color:red'>*</span><!-- &nbsp &nbsp<input id="chkall" type="checkbox">Select All--></label>
<select name="bdder_id[]" id="bdr_idd" multiple="multiple" id="bddere" class="form-control" required style="border:1px solid black !important;">
<option value="" disabled>-Choose Bidder-</option>

</select>
</div>

<div class="form-group col-md-12 col-xs-12">
<label class="form-label" style="font-size:16px !important;font-weight:bold;">Subject <span style="color:red">*</span></label>
<input type="text" name="sbjct"   class="form-control" placeholder="Enter subject" required style="border:1px solid black !important;">
</div>



<div class="form-group col-md-12 col-xs-12">
<label class="form-label" style="font-size:16px !important;font-weight:bold">Description <span style="color:red">*</span></label>
<textarea  id="makeMeSummernote" class="form-control" name="dscptn"  placeholder="Enter Description" required style="border:1px solid black !important;">Dear ['name'], Your user id is ['unique_id'] and password is ['password']. 

<br><br><br>



<a href="https://eauction.ipsupport.in/bidder_login.php">Click here to login</a>

<br><br><br><br>
        <p>            
Thanks and Regards<br><br></p>
<hr><br>
<p style="color:blue;">I.P. Support Team</p> <br>
<b>Sabre Edge  IT Solutions</b> <br>   
<span style="color:black">We work “Hard” so that you can work “Smart” </span><br><br>
Office: 3208, 2nd floor, Mahindra Park, Near Rani Bagh, Delhi-110034<br>
Desk:   +91 11 4702-4666    |    M:   +91 9350 444 666<br>
Email:  mail@ipsupport.in  <br>
Url:    <a href="https://ipsupport.in">www.ipsupport.in </a><br><br>

<b>DISCLAIMER<b></b>: This communication is confidential and privileged and is directed to and for the use of the addressee only. The recipient if not the addressee should not use this message if erroneously received, and access and use of this e-mail in any manner by anyone other than the addressee is unauthorized. The recipient acknowledges that IPSupport may be unable to exercise control or ensure or guarantee the integrity of the text of the email message and the text is not warranted as to completeness and accuracy. Before opening and accessing the attachment, if any, please check and scan for virus.
                  </b></textarea>
</div>



<div class="form-group col-md-12">

<button type="submit" name="submit" class="btn btn-primary" >Submit</button> 
</div>
</div>
</form>

<?php 
if(isset($_POST['submit']))
{
require 'class.phpmailer.php';
$bdr_iid =$_POST['bdder_id'];
$sebjt=$_POST['sbjct'];
$destcp=$_POST['dscptn'];




$output = '';
$chk="";

foreach($bdr_iid as $mul_usr)
{
$chk= $mul_usr;

$clt_bdrs_dtl="select * from newbidder_login where id='$chk'";
$qst_clt_bdrs_dtl=$db->query($clt_bdrs_dtl);
$clct_bdrs_dtl=$qst_clt_bdrs_dtl->fetch_assoc();

$bedr_uid=$clct_bdrs_dtl['uid'];
$bedr_nem=$clct_bdrs_dtl['Bidder_Name'];
$bedr_emnl=$clct_bdrs_dtl['Bidder_Email'];
$bedr_uuid=$clct_bdrs_dtl['uid'];
$bedr_paswd=$clct_bdrs_dtl['Bidder_Password'];

$txt = str_replace("['name']",ucwords($bedr_nem) , $destcp);
$txt = str_replace("['unique_id']",ucwords($bedr_uuid) , $txt);
$txt = str_replace("['password']",ucwords($bedr_paswd) , $txt);

$mail = new PHPMailer;
$mail->IsSMTP();								//Sets Mailer to send message using SMTP
$mail->Host = 'eauction.ipsupport.in';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
$mail->Port = '465';								//Sets the default SMTP server port
$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
$mail->Username = 'support@ipsupport.in';					//Sets SMTP username
$mail->Password = 'jigsaw@3208';					//Sets SMTP password
$mail->SMTPSecure = 'ssl';							//Sets connection prefix. Options are "", "ssl" or "tls"
$mail->From = 'support@ipsupport.in';			//Sets the From email address for the message
$mail->FromName = 'IPSUPPORT';					//Sets the From name of the message
$mail->AddAddress($bedr_emnl, $bedr_nem);	//Adds a "To" address
$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
$mail->IsHTML(true);							//Sets message type to HTML
$mail->Subject = $sebjt; //Sets the Subject of the message
//An HTML or plain text message body
$mail->Body =$txt;

$mail->AltBody = '';

$result = $mail->Send();						//Send an Email. Return true on success or false on error

if($result["code"] == '400')
{
$output .= html_entity_decode($result['full_error']);
}
//echo "<script>window.alert('$chk');</script>";
}
if($output == '')
{
echo "<script>window.alert('Email send sucessfully');</script>";
}
else
{
echo "<script>window.alert('$output');</script>";

}
}
?>



</div>
</div>
</main>




<?php include 'footer.php'; 
?>

<script type="text/javascript">
$('#makeMeSummernote').summernote({
height:300,
});

 /*$("#chkall").click(function(){
        if($("#chkall").is(':checked')){
            $("#bdr_idd > option").prop("selected", "selected");
            $("#bdr_idd").trigger("change");
        } else {
            $("#bdr_idd > option").removeAttr("selected");
            $("#bdr_idd").trigger("change");
        }
    });*/
</script>

<script>
$(document).ready(function(){
$('#lqddtr').change(function(){
var lqdtr_id=$('#lqddtr').val();
$.ajax({
url: "get_bdr_lst_ajax.php",
type: "POST",
data    : {txt1:lqdtr_id},
cache: false,
success: function(data){
$('#bdr_idd').html(data);

}
});
});
});
</script>


<script>
$(document).ready(function() { 
 $("#lqddtr ,#bdr_idd").select2();
});
</script>


<!--<script>-->
<!--                        CKEDITOR.replace( 'srv_dtl' );-->
<!--                </script>-->

<?php
ob_flush();

?>