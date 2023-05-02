<?php 
@ob_start();
?>
<?php 
include('admin/config/config.php'); 
$cptcha_ced=rand(111111,999999);
date_default_timezone_set("Asia/Kolkata");

$crt_det_tme=date('Y-m-d H:i:s');


$bdr_id=$_GET['bddr_id'];

$clt_sle_netc="select * from newbidder_login where id='$bdr_id'";
$qst_clt_sle_netc=$db->query($clt_sle_netc);
$clct_clt_sle_netc=$qst_clt_sle_netc->fetch_assoc();

$bdr_emnl=$clct_clt_sle_netc['Bidder_Email'];
$bdr_mebl=$clct_clt_sle_netc['bidder_mobile'];
$bdr_uid=$clct_clt_sle_netc['uid'];
$bdr_opt=$clct_clt_sle_netc['otp'];

?>
<style>
  textarea{
    resize: none;
  }
  </style>
  

<?php include("header.php");?>
<html>
<head> 


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
  <body class="bg-dark animate">




<div class="container ">

  <div class="row d-flex justify-content-center">
    <div class="col-md-6 bg-light p-5" style="border-radius: 50px 20px;">
      <form action="" method="POST">
            <div class="section-title">
              <span><strong><h4>BIDDER Signup </h4></strong></span>
            </div>  
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label"> UID</label>
            <input type="text" class="form-control" value="<?php echo $bdr_uid;?>" name="bdr_uid" placeholder='Enter UID' readonly style=" border-radius: 50px 20px; border: 2px solid orange;">
            <div id="emailHelp" class="form-text">We'll never share your UID with anyone else.</div>
          </div>

          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Email ID</label>
            <input type="email" class="form-control" placeholder='Enter Email' value="<?php echo $bdr_emnl;?>" name="emnl" readonly style=" border-radius: 50px 20px; border: 2px solid orange;">
           
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Mobile number</label>
            <input type="number" class="form-control" value="<?php echo $bdr_mebl;?>" placeholder='Enter Mobile' name="mbnl" readonly style=" border-radius: 50px 20px; border: 2px solid orange;">
           
          </div>
          
           <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Name</label>
            <input type="text" class="form-control" value="" placeholder='Enter your name' name="nem" required style=" border-radius: 50px 20px; border: 2px solid orange;">
           
          </div>

          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Enter OTP</label>
            <input type="number" class="form-control col-4" placeholder='Enter OTP' name="opt" required style=" border-radius: 50px 20px; border: 2px solid orange;">
           
          </div>


          <button type="submit" name="submit"  class="btn btn-primary">Submit</button>

    
   
       </form>
       <span>If already have an account please <a href='bidder_login.php'>Login</a></span>
    </div>
 
                <?php

                if(isset($_POST['submit']))
                {
             
                   $bdr_otp =$_POST['opt'];
                   $name=$_POST['nem'];

if($bdr_otp==$bdr_opt)
{
    $gnrt_pwd=rand(11111,999999);
    
    $updt_usr="update newbidder_login set Bidder_Password='$gnrt_pwd',Bidder_Name='$name',status='active' where id='$bdr_id'";
    $qst_updt_usr=$db->query($updt_usr);
    if($qst_updt_usr)
    {

   include('bidder_cridentials_email.php');
        
   
    }
    
    
}
else
{
    echo "<script>window.alert('Wrong Otp Please Try again');</script>";
}
                   
                }

                ?>



    </div>
  </div>


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