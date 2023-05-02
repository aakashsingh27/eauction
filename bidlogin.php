
<?php include('admin/config/config.php'); ?>
<style>
  textarea{
    resize: none;
  }
  </style>
  <?php 


  session_start();
  if(isset($_POST['submit']))
  {
   // collect value of input field

     
     $bidder_email =$_POST['Bidder_Email'];
     $bid_type =$_POST['bid'];

     $bidder_password =$_POST['Bidder_Password'];
     $check_user=mysqli_query($conn,"select * from newbidder_login as nl INNER JOIN bidder_status as bs on nl.id=bs.bidder_id WHERE Bidder_Email='$bidder_email' && Bidder_Password='$bidder_password'");  

     $run=mysqli_fetch_assoc($check_user);
    
   
   if($run){
      
      $_SESSION['bid_type']=$bid_type;
      $_SESSION['bidder_fid']=$run['bidder_id'];
      // echo $_SESSION['bid_type'];
      // echo $_SESSION['bid_type'];
      // echo " <a href='logout.php'><input type=button value=logout name=logout></a>";
       echo "<script>
         window.location.href='bideshboard.php'
       </script>";
     echo "check";
      
     
     
    } else { 
      echo "<script>alert('Login Failed')
         window.location.href='bidlogin.php'
       </script>";
    }
  
}

?>


<?php include_once "header.php";?>
<html>
<head> </head>
  <body>




<div class="container">
  <div class="section-title">
    <span><strong><h4>BIDDER LOGIN PAGE</h4></strong></span>
  </div>
  <div class="row d-flex justify-content-center">
    <div class="col-md-6 bg-light p-5">
      <form action="" method="POST">
        <div class="mb-3">
    <select class="form-control" name="bid" >
                          <option value="">Select Bid</option>
                            <?php
                $ques = mysqli_query($conn,"Select id from create_sale order by id desc");
             $fetchQ = mysqli_fetch_assoc($ques);
                while($fetchQ = mysqli_fetch_assoc($ques)){
              ?>
                                <option value="<?php echo $fetchQ['id'];?>"><?php echo $fetchQ['id'];?></option>
                            <?php } ?>
                        </select>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" name="Bidder_Email" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="Bidder_Password" id="exampleInputPassword1">
  </div>

   <a href="bideshboard.php"> <button type="submit" name="submit"  class="btn btn-primary">Log in</button></a> 

    <div class="text-center">
    <p>Not a member? 
     <a href="newbidderlogin.php"> sign in</a>
    </p>
   
     
    </button>
    </div> 
  </form>




    </div>
  </div>
</div>


  </body>
</html>
        