<?php 
date_default_timezone_set("Asia/Kolkata");
@ob_start();
?>
<?php include('admin/config/config.php');

$crt_det_tme=date("Y-m-d h:i:s");


?>
<style>
  textarea{
    resize: none;
  }
  
  body{
      background-image:url('img/download.svg') !important; 
      
      background-repeat:no-repeat !important;
  }
  </style>
  

<?php include("header.php");?>
<html>
<head> </head>
  <body class="animate">




<div class="container ">

  <div class="row d-flex justify-content-center">
    <div class="col-md-4 bg-light p-5 m-5" style="border-radius: 50px 50px; border:2px solid orange">
        

<form action="" method="POST">
    <div id='form1'>
<div class="section-title">
<span><strong><h4>Bidder Login </h4></strong></span>
</div>  
<div class="mb-3">
<label for="exampleInputEmail1" class="form-label">Bidder UID</label>
<input type="text" class="form-control" id="bdr_uid" name="bdr_uid" placeholder='Enter UID' required style=" border-radius: 50px 50px; border: 2px solid orange;">

</div>

<div class="mb-3">
<label for="exampleInputPassword1" class="form-label">Password</label>
<input type="password" id="pwrd_id" class="form-control" placeholder='Enter password' name="bidder_password" required style=" border-radius: 50px 50px; border: 2px solid orange;">
<input type="checkbox" onclick="myFunction()"> Show Password
</div>

<button type="button" name="submit" id='lgn_in' class="btn btn-primary" style="background: #162270;">Log In</button><br><br>

<center><a href='signup_bidder_front.php' style="text-align:center;">If You Dont have an account Signup</a> </center>  
</div>
<div id='otpform2' style="display:none">

<div class="section-title">
<span><strong><h4>Bidder Login </h4></strong></span>
</div>  
<div class="mb-3">
<label for="exampleInputEmail1" class="form-label">Enter OTP</label>
<input type="text" class="form-control" id="otppt" name="bdr_uid" placeholder='Enter OTP' required style=" border-radius: 50px 50px; border: 2px solid orange;">
<button type="button"  id='vrfy_otp' class="btn btn-primary" style="background: #162270;margin-top: 15px;border-radius: 20px;" >Verify OTP</button> <button type="button" name="submit" id="lgnrd_in" class="btn btn-primary" style="background: #162270;margin-top: 15px;border-radius: 20px;">Resend OTP</button><br><br>
</div>
</div>
</form>



    </div>
 
 
                <?php

                if(isset($_POST['submit']))
                {
                 
                   $bidder_uid =$_POST['bdr_uid'];

                   $bidder_pwd =$_POST['bidder_password'];

                   $clt_usr_dtl="select * from newbidder_login where uid='$bidder_uid' and Bidder_Password='$bidder_pwd' and status='active'";
                  
                 $qst_clt_usr_dtl=$db->query($clt_usr_dtl);
                $bderr_cnt=mysqli_num_rows($qst_clt_usr_dtl);

                if($bderr_cnt==1)
                {
                  $clct_clt_usr_dtl=$qst_clt_usr_dtl->fetch_assoc();
                $usrr_id=$clct_clt_usr_dtl['id'];
                $lqdtr_id=$clct_clt_usr_dtl['bidder_add_by_liquiditor_id'];
                $bidder_emnl=$clct_clt_usr_dtl['Bidder_Email'];

$otp=rand(11111,999999);


$upd_otp="update newbidder_login set otp='$otp' where id='$usrr_id'";
$qst_upd_otp=$db->query($upd_otp);
if($qst_upd_otp)
{
    
    include('bidder_signin_otp.php');
    
    
}

/*$upd_bdr_ssn="update newbidder_login set user_logged_in_id='$rand_session' where id='$usrr_id'";
$qst_upd_bdr_ssn=$db->query($upd_bdr_ssn);*/

            /*    @ob_start();
                
              
                session_start();
                $_SESSION['bddr_id']=$usrr_id;
                $_SESSION['liquiditor_id']=$lqdtr_id;
                $_SESSION['ssn_id']=$rand_session;
                if(isset($_SESSION['bddr_id']))
                {

                echo "<script>window.location='view_aution_details.php';</script>";
                }
                else
                {
                  echo "<script>window.alert('session no setted');</script>";
                }
                ob_flush();
*/

                }
                else
                {
                  echo "<script>window.location='';window.alert('Wrong cridentials');</script>";
                }



                 
                 /*if($run){
                    
                    $_SESSION['bid_type']=$bid_type;
                    $_SESSION['bidder_fid']=$run['bidder_id'];
                   
                     echo "<script>
                       window.location.href='bideshboard.php'
                     </script>";
                   echo "check";
                    
                   
                   
                  } else { 
                    echo "<script>alert('Login Failed')
                       window.location.href='bidlogin.php'
                     </script>";
                  }*/

                }

                ?>



    </div>
  </div>


<script>
$(document).ready(function(){
$('#lgn_in,#lgnrd_in').click(function(){
   

var bdrr_uid=$('#bdr_uid').val();
var pswd=$('#pwrd_id').val();

if(bdrr_uid=='' && pswd=='')
{
    alert('Please fill UID and Password');
}
else if(bdrr_uid!='' && pswd=='')
{
    alert('Please password');
}
else if(bdrr_uid=='' && pswd!='')
{
       alert('Please UID');
}
else if(bdrr_uid!='' && pswd!='')
{

$('#lgn_in').html('please wait...');


$('#lgn_in').prop('disabled', true);

$.ajax({
url: "bidder_login_otp_ajax.php",
type: "POST",
data    : {txt1:bdrr_uid,txt2:pswd},
cache: false,

success : function(resp){
var obj=jQuery.parseJSON( resp );
if(obj.status==1)
{
window.alert(obj.Response);
$('#otpform2').show();
$('#form1').hide();
}
else
{
    
$('#lgn_in').html('Login');
$('#lgn_in').prop('disabled', false);
window.alert(obj.Response);
}
},
error   : function(resp){
}  
});
}
    
});
});
</script>



<script>
$(document).ready(function(){
$('#vrfy_otp').click(function(){
   

var oppt=$('#otppt').val();
var bdrr_suid=$('#bdr_uid').val();

if(oppt=='')
{
    alert('Please fill OTP');
}

else if(oppt!='')
{

/*$('#lgn_in').html('please wait...');


$('#lgn_in').prop('disabled', true);
*/
$.ajax({
url: "bidder_login_otp_verify_ajax.php",
type: "POST",
data    : {txt1:bdrr_suid,txt2:oppt},
cache: false,

success : function(resp){
var obj=jQuery.parseJSON( resp );
if(obj.status==1)
{
// window.alert(obj.Response);
window.location='view_aution_details.php';
}
else
{
window.alert(obj.Response);

}
},
error   : function(resp){
}  
});
}
    
});
});
</script>


<?php include("footer.php");?>
  </body>
  
  
  
  
  
  
</html>

<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
<?php ob_flush();?>