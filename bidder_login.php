<?php 
@ob_start();
?>
<?php include('admin/config/config.php'); ?>
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


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container ">

  <div class="row d-flex justify-content-center">
    <div class="col-md-4 bg-light p-5 m-5" style="border-radius: 50px 50px; border:2px solid orange">
      <form action="" method="POST">
            <div class="section-title">
              <span><strong><h4>Bidder Login </h4></strong></span>
            </div>  
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Bidder UID</label>
            <input type="text" class="form-control" name="bdr_uid" placeholder='Enter UID' required style=" border-radius: 50px 50px; border: 2px solid orange;">
            
          </div>

          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" id="myInput" class="form-control" placeholder='Enter password' name="bidder_password" required style=" border-radius: 50px 50px; border: 2px solid orange;">
             <input type="checkbox" onclick="myFunction()"> Show Password
             
             
             <br>  <input type="checkbox" required> <a href="#" onclick="terms()">Terms and conditions</a>
          </div>

          <button type="submit" name="submit"  class="btn btn-primary" style="background: #162270;">Log In</button><br><br>

 <center><a href='signup_bidder_front.php' style="text-align:center;">If You Dont have an account Signup</a> </center>  
   
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

                echo "<script>window.location='view_aution_details.php';</script>";
                }
                else
                {
                  echo "<script>window.alert('session no setted');</script>";
                }
                ob_flush();


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

<?php include("footer.php");?>
  </body>
</html>
<script>
function terms()
{
 
 Swal.fire({
  title: 'Terms and conditions',
  icon: 'info',
  html:
    '<p style="font-family:arial;color:black;padding-top:0px;">By clicking Accept you agree the terms & Condition as mentioned in the Liquidator Memorandum.</p> ',
  showCloseButton: true,
  showCancelButton: false,
  focusConfirm: false,
  confirmButtonText:
    '<i class="fa fa-thumbs-up"></i> OK',
  confirmButtonAriaLabel: 'Thumbs up, great!',

})
 
 
 
}
</script>

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