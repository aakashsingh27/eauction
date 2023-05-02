<?php include_once "header.php";?>
<?php include_once 'db_connect.php';  ?>
<?php 


  
  if(isset($_POST['submit']))
  {
   // collect value of input field
  if ($_POST["Bidder_Password"] === $_POST["Confirm_Password"]) {
     $Bidder_Name =$_POST['Bidder_Name'];
     $Bidder_Email =$_POST['Bidder_Email'];
     $Bidder_Password =$_POST['Bidder_Password'];
     $Confirm_Password = $_POST['Confirm_Password'];
 
  
     $sql="insert into newbidder_login(Bidder_Name,Bidder_Email,Bidder_Password,Confirm_Password) 
     values('$Bidder_Name','$Bidder_Email','$Bidder_Password','$Confirm_Password')";
    $result=mysqli_query($conn,$sql);
    
    // print_r($sql);
    if($result){
      
       echo "<script>alert('We will get back to you soon')
         window.location.href='./index.php'
       </script>";
     
      
     
     
    } else { 
      echo "<script>alert('Branch Not inserted')
         window.location.href='./index.php'
       </script>";
    }
  
}
else {
  echo"password isnt matching";
}
}

?>
<div class="container">

       <div class="section-title  text-center">
      <span><strong><h4>Request Form</h4></strong></span><br><br>
      </div>
  <div class="row d-flex justify-content-center">
    <div class="col-md-6 bg-light p-5">
      <form action="" method="POST">






      <div class="mb-3 row">
      <label for="inputEmail4" class="col-sm-4 col-form-label">Bidder Name</label>
      <div class="col-sm-8">
      <input type="text" class="form-control" id="Bidder_Name" name="Bidder_Name" placeholder="Name" required>
      </div>
      </div>

      

      <div class="mb-3 row">
      <label for="inputEmail4" class="col-sm-4 col-form-label">Bidder Email</label>
      <div class="col-sm-8">
      <input type="email" class="form-control" id="Bidder_Email" name="Bidder_Email" placeholder="Email" required>
      </div>
      </div>


      <div class="mb-3 row">
      <label for="inputPassword4" class="col-sm-4 col-form-label">Bidder Password</label>
      <div class="col-sm-8">
      <input type="password" class="form-control" id="Bidder_Password" name="Bidder_Password" placeholder="Password" required>
      </div>
      </div>

      <div class="mb-3 row">
      <label for="inputAddress" class="col-sm-4 col-form-label">Confirm Password</label>
      <div class="col-sm-8">
      <input type="password" class="form-control" id="Confirm_Password" name="Confirm_Password" placeholder="Password" required>
      </div>
      </div>




   




        <div class="my-3">
        <button type="submit" name="submit" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>

