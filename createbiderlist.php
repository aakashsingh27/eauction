<?php include_once 'db_connect.php';  ?>
<style>
  textarea{
    resize: none;
  }
  </style>
  <?php 


  
  if(isset($_POST['submit']))
  {
   // collect value of input field
    // $Bidder_Id =$_POST['Bidder_Id'];
     $Bidder_Name =$_POST['Bidder_Name'];
     $Bidder_Email =$_POST['Bidder_Email'];
     $Bidder_Password =$_POST['Bidder_Password'];
     $Bidder_Address = $_POST['Bidder_Address'];
     $Bidder_Address2 = $_POST['Bidder_Address2'];
     $Input_City = $_POST['Input_City'];
     $Input_State = $_POST['Input_State'];
     $Input_Zip = $_POST['Input_Zip'];
     echo $Input_State;
  
     $sql="insert into sale_notice(Bidder_Name,Bidder_Email,Bidder_Password,Bidder_Address,Bidder_Address2,Input_City,Input_State,Input_Zip) 
     values('$Bidder_Name','$Bidder_Email','$Bidder_Password','$Bidder_Address','$Bidder_Address2','$Input_City','$Input_State','$Input_Zip')";
    $result=mysqli_query($conn,$sql);
    
    // print_r($sql);
    if($result){
      
       echo "<script>alert('Branch Inserted Successfully')
         window.location.href='./index.php'
       </script>";
     
      
     
     
    } else { 
      echo "<script>alert('Branch Not inserted')
         window.location.href='./index.php'
       </script>";
    }
  
}

?>


<?php include_once "header.php";?>

<div class="container">

       <div class="section-title  text-center">
      <span><strong><h4>Create Biders List</h4></strong></span><br><br>
      </div>
  <div class="row d-flex justify-content-center">
    <div class="col-md-6 bg-light p-5">
      <form action="" method="POST">


  <!--   <div class="mb-3 row">
      <label for="inputID" class="col-sm-4 col-form-label">Bidder Id</label>
      <div class="col-sm-8">
      <input type="number" class="form-control" id="Bidder_Id" name="Bidder_Id" placeholder="ID">
      </div>
      </div> -->



      <div class="mb-3 row">
      <label for="inputEmail4" class="col-sm-4 col-form-label">Bidder Name</label>
      <div class="col-sm-8">
      <input type="text" class="form-control" id="Bidder_Name" name="Bidder_Name" placeholder="Name">
      </div>
      </div>

      

      <div class="mb-3 row">
      <label for="inputEmail4" class="col-sm-4 col-form-label">Bidder Email</label>
      <div class="col-sm-8">
      <input type="email" class="form-control" id="Bidder_Email" name="Bidder_Email" placeholder="Email">
      </div>
      </div>


      <div class="mb-3 row">
      <label for="inputPassword4" class="col-sm-4 col-form-label">Bidder Password</label>
      <div class="col-sm-8">
      <input type="password" class="form-control" id="Bidder_Password" name="Bidder_Password" placeholder="Password">
      </div>
      </div>

      <div class="mb-3 row">
      <label for="inputAddress" class="col-sm-4 col-form-label">Bidder Address</label>
      <div class="col-sm-8">
      <input type="Address" class="form-control" id="Bidder_Address" name="Bidder_Address" placeholder="1234 Main St">
      </div>
      </div>


      <div class="mb-3 row">
      <label for="inputAddress2" class="col-sm-4 col-form-label">Bidder Address 2</label>
      <div class="col-sm-8">
      <input type="Address2" class="form-control" id="Bidder_Address2" name="Bidder_Address2" placeholder="Apartment, studio, or floor">
      </div>
      </div>


      <div class="mb-3 row">
      <label for="inputCity" class="col-sm-4 col-form-label">City</label>
      <div class="col-sm-8">
      <input type="City" class="form-control" id="Input_City" name="Input_City" placeholder="New delhi">
      </div>
      </div>


      <div class="mb-3 row">
      <label for="inputState" class="col-sm-4 col-form-label">State</label>
      <div class="col-sm-8">
      <select id="Input_State" name="Input_State" class="form-control">
        <option selected>Choose...</option>
        <option>Maharashtra</option>
        <option>New delhi</option>
        <option>Banglore</option>
      </select>
      </div>
      </div>

      <div class="mb-3 row">
      <label for="Input_Zip" class="col-sm-4 col-form-label">Zip</label>
      <div class="col-sm-8">
      <input type="text" class="form-control" id="Input_Zip" name="Input_Zip">
      </div>
      </div>

      <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
      </div>

        <div class="my-3">
        <button type="submit" name="submit" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>







