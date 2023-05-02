<?php include_once 'db_connect.php';

  ?>
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
     $bid_status =$_POST['bid_status'];
     $reserve_price =$_POST['reserve_price'];
     $bidder_name =$_POST['bidder_name'];
     $bidder_guid = $_POST['bidder_guid'];
     $bidder_amount = $_POST['bidder_amount'];

     
  
     $sql="insert into bidder_status(bid_status,reserve_price,bidder_name,bidder_guid,bidder_amount) 
     values('$bid_status','$reserve_price','$bidder_name','$bidder_guid','$bidder_amount')";
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
      <span><strong><h4>Bidder Status List</h4></strong></span><br><br>
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
      <label for="inputEmail4" class="col-sm-4 col-form-label">Bidder Status</label>
      <div class="col-sm-8">
      <div class="input-group">
  <select class="form-select" id="bid_status" name="bid_status" aria-label="Example select with button addon">
    <option selected>Choose...</option>
    <option value="Approve">Yes</option>
    <option value="Reject">No</option>
    <option value="Process">ignore</option>
  </select>
  
</div>
      </div>
      </div>

      
      <div class="mb-3 row">
      <label for="inputAddress2" class="col-sm-4 col-form-label">Reserve Price</label>
      <div class="col-sm-8">
      <input type="Address2" class="form-control" id="reserve_price" name="reserve_price" placeholder="Amount Reserve">
      </div>
      </div>



      <div class="mb-3 row">
      <label for="inputEmail4" class="col-sm-4 col-form-label">Bidder Name</label>
      <div class="col-sm-8">
      <input type="text" class="form-control" id="bidder_name" name="bidder_name" placeholder="Name Of Bidder">
      </div>
      </div>


      <div class="mb-3 row">
      <label for="inputPassword4" class="col-sm-4 col-form-label">Bidder Guid</label>
      <div class="col-sm-8">
      <input type="text" class="form-control" id="bidder_guid" name="bidder_guid" placeholder="">
      </div>
      </div>

      <div class="mb-3 row">
      <label for="inputAddress" class="col-sm-4 col-form-label">Bid Amount</label>
      <div class="col-sm-8">
      <input type="Address" class="form-control" id="bidder_amount" name="bidder_amount" placeholder="">
      </div>
      </div>


      


     
        <div class="my-3">
        <button type="submit" name="submit" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>







