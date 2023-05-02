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
   
     $Title =$_POST['inputTitle'];
     $Pdf =$_POST['formFileSm'];
     $Incremental =$_POST['inputValue'];
     $Reserve_Price = $_POST['inputPrice'];
     $Start_Date_Auction = $_POST['inputStartDate'];
     $Reserve_Price2 = $_POST['inputPrice2'];
     $End_Date_Auction = $_POST['inputEndDate'];
     
  
     $sql="INSERT INTO `create_sale`(`id`, `Title`, `Pdf`, `Incremental`, `Reserve_Price`, `Start_Date_Auction`, `Reserve_price2`, `End_Date_Auction`) VALUES (  '$id', '$Title','$Pdf','$Incremental','$Reserve_Price','$Start_Date_Auction','$Reserve_Price2','$End_Date_Auction')";
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


<html>
<head>


    
</head>
<body>



 <div class="container">

       <div class="section-title  text-center">
          <span><strong><h4>CREATE SALE NOTICE</h4></strong></span>
       </div>

      <div class="row justify-content-center">
        <div class="col-3">

           <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <a href="bidderstatus.php"> <button type="button" class="mb-3 btn btn-primary btn-lg float-right">Bidder Status</button></a>
           </div>
        </div>
       <div class="col-3">
           <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <a href="liquid.php"> <button type="button" class="mb-3 btn btn-primary btn-lg float-right">Liquidator Screen Page</button></a>
           </div>
       </div>
      
       <div class="col-3">
          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <a href="createbiderlist.php"> <button type="button" class="mb-3 btn btn-primary btn-lg float-right">Create Bidder List</button></a>
          </div>
       </div>
     
        </div>
      </div>


  <div class="row d-flex justify-content-center">
    <div class="col-md-6 bg-light p-5">

      

      <form action="" method="POST">

      <div class="mb-3 row">
       <label for="title" class="col-sm-4 col-form-label">Enter Title</label>
       <div class="col-sm-8"> 
       <input type="text" class="form-control" name="inputTitle" id="inputTitle" placeholder="Jet Airways" >
       </div>
       </div>

       <div class="mb-3 row">
       <label for="formFileSm" class="col-sm-4 col-form-label">Choose Pdf File</label>
       <div class="col-sm-8">
       <input class="form-control form-control-sm" name="formFileSm" id="formFileSm" type="file">
       </div>
       </div>

       <div class="mb-3 row">
       <label for="staticEmail" class="col-sm-4 col-form-label">Incremental Value</label>
       <div class="col-sm-8">
       <input type="text" class="form-control" name="inputValue" id="inputValue">
       </div>
       </div>




       <div class="mb-3 row ">
       <label for="staticEmail" class="col-sm-4 col-form-label">Reserve Price</label>
       <div class="col-sm-8">
       <input type="text" class="form-control" name="inputPrice" id="inputPrice">
       </div>
       </div>


        <div class="mb-3 date row">
        <label for="staticEmail" class="col-sm-4 col-form-label">Date Of Auction</label>
        <div class="col-sm-8">
        <input type="datetime-local" class="form-control" name="inputStartDate" id="inputStartDate">
        </div>
        </div>

       


         


         <div class="mb-3 row">
         <label for="staticEmail" class="col-sm-4 col-form-label">Reserve Price</label>
         <div class="col-sm-8">
         <input type="text" class="form-control" name="inputPrice2" id="inputPrice2">
         </div>
         </div>

         <div class="mb-3 row">
         <label for="staticEmail" class="col-sm-4 col-form-label">Last Date Submission</label>
         <div class="col-sm-8">
         <input type="datetime-local" class="form-control" name="inputEndDate" id="inputEndDate">
         </div>
         </div>

         <div class="mb-3 mx-auto">
            <button type="submit" name="submit" class="btn btn-primary float-right">Submit</button>
         </div>
      </form>






    </div>
  </div>
</div>






   





    </body>
</html>




















