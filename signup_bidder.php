<?php 
@ob_start();
?>
<?php 
include('admin/config/config.php'); 
$cptcha_ced=rand(111111,999999);
date_default_timezone_set("Asia/Kolkata");

$crt_det_tme=date('Y-m-d H:i:s');


$sle_notice_id=$_GET['ntc_id'];

$clt_sle_netc="select * from create_sale where id='$sle_notice_id'";
$qst_clt_sle_netc=$db->query($clt_sle_netc);
$clct_clt_sle_netc=$qst_clt_sle_netc->fetch_assoc();

$lqdter_id=$clct_clt_sle_netc['create_by_liquiditor_id'];
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
            <input type="text" class="form-control" name="bdr_uid" placeholder='Enter UID' required style=" border-radius: 50px 20px; border: 2px solid orange;">
            <div id="emailHelp" class="form-text">We'll never share your UID with anyone else.</div>
          </div>

          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Email ID</label>
            <input type="email" class="form-control" placeholder='Enter Email' name="emnl" required style=" border-radius: 50px 20px; border: 2px solid orange;">
           
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Mobile number</label>
            <input type="number" class="form-control" placeholder='Enter Mobile' name="mbnl" required style=" border-radius: 50px 20px; border: 2px solid orange;">
           
          </div>
<div class='row'>
          <div class="mb-3 col-md-6">
            <label for="exampleInputPassword1" class="form-label">Captcha Code</label>
            <input type="text" class="form-control col-4" placeholder='Enter Captcha' name="cptcha" required style=" border-radius: 50px 20px; border: 2px solid orange;">
           
          </div>

 <div class="mb-3 col-md-6">
            <label for="exampleInputPassword1" class="form-label">Captcha</label><br>
            
            <span style="
    font-weight: bold;
    font-family: unset;
"> <?php echo $cptcha_ced;?></span> <a href='' class='btn btn-success'><i class="fa fa-refresh" aria-hidden="true"></i></a><input type="hidden" value="<?php echo $cptcha_ced;?>" name="generacptcha">
           
          </div>
</div>
          <button type="submit" name="submit"  class="btn btn-primary">Submit</button>

    
   
       </form>
       <span>If already have an account please <a href='bidder_login.php'>Login</a></span>
    </div>
 
                <?php

                if(isset($_POST['submit']))
                {
                 
                 $opt=rand(1111,9999);
                   $bidder_uid =$_POST['bdr_uid'];

                   $bidder_emnl =$_POST['emnl'];
                   
                   $bdr_mbnl=$_POST['mbnl'];
                   $entred_cptcha=$_POST['cptcha'];
                   $gnrted_cptcha=$_POST['generacptcha'];

if($entred_cptcha==$gnrted_cptcha)
{
    

                   $clt_uid_dtl="select * from newbidder_login where uid='$bidder_uid' and Bidder_Password!=''";
                   $qst_clt_uid_dtl=$db->query($clt_uid_dtl);
                   $uid_cnt=mysqli_num_rows($qst_clt_uid_dtl);
                   
                   $clt_eml_dtl="select * from newbidder_login where Bidder_Email='$bidder_emnl' and Bidder_Password!=''";
                   $qst_clt_eml_dtl=$db->query($clt_eml_dtl);
                   $eml_cnt=mysqli_num_rows($qst_clt_eml_dtl);
                   
                   
                      $clt_mbel_dtl="select * from newbidder_login where bidder_mobile='$bdr_mbnl' and Bidder_Password!=''";
                   $qst_clt_mbel_dtl=$db->query($clt_mbel_dtl);
                   $mbl_cnt=mysqli_num_rows($qst_clt_mbel_dtl);
                   
                   
                  if($uid_cnt > 0)
                  {
                      echo "<script>window.location='';window.alert('This Uid is already registered');</script>";
                  }
                 
                  else if($uid_cnt==0)
                  {
                      $ad_bdr="insert into newbidder_login set
                      uid='$bidder_uid',
                      bidder_mobile='$bdr_mbnl',
                      Bidder_Email='$bidder_emnl',
                      bidder_add_by_liquiditor_id='$lqdter_id',
                      register_for_sale_notice_id='$sle_notice_id',
                      otp='$opt'";
                      
                      $qst_ad_bdr=$db->query($ad_bdr);
                      if($qst_ad_bdr)
                      {
                           $last_id = $db->insert_id;
                          include('bidder_otp_mail.php');
                      }
                    }
                }
                else
                {
                    echo "<script>window.alert('Please Fill Correct Captcha');window.location='';</script>";
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