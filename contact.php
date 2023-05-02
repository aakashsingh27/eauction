<?php include('admin/config/config.php');  ?>
<style>
  textarea{
    resize: none;
  }
  </style>
 

<?php include_once "header.php";?>
<!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container"><br><br>
        <div class="section-title">
          <h1 style="color:black;font-size: 35px;">Contact</h1>
          <hr></hr>
        </div>
      </div>

      <div class="map">

      <div class="container">
     
      </div>
      </div>

      <div class="container">

        <div class="info-wrap mt-5">
          <div class="row">
            <div class="col-lg-4 info">
              <i class='bx bxs-location-plus'></i>
              <h4 style="font-family:arial;">Location:</h4>
              <p style="font-family:arial;"> 3208, 2nd Floor Mahindra Park, <br>Near Rani Bagh Delhi-110034</p>
            </div>

            <div class="col-lg-4 info mt-4 mt-lg-0">
              <i class='bx bxl-gmail'></i>
              <h4 style="font-family:arial;">Email:</h4>
              <p style="font-family:arial;">ibcevoting@gmail.com</p>
            </div>

            <div class="col-lg-4 info mt-4 mt-lg-0">
              <i class='bx bx-phone-call'></i>
              <h4 style="font-family:arial;">Call:</h4>
              <p style="font-family:arial;">+91-8826875426</p>
            </div>
          </div>
        </div><br><br>
<div class='row'>
     <div class='col-md-6'>
        <form action="" method="post" >
          <div class="row">
            <div class="col-md-6 form-group">
              <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" style="font-family:arial;" required>
            </div>
            <div class="col-md-6 form-group mt-3 mt-md-0">
              <input type="email" class="form-control" name="email"  style="font-family:arial;" id="email" placeholder="Your Email" required>
            </div>
          </div>
          <div class="form-group mt-3">
            <input type="text" class="form-control" name="subject"  id="subject" style="font-family:arial;" placeholder="Subject" required>
          </div>
          <div class="form-group mt-3">
            <textarea class="form-control" name="message"  rows="5" placeholder="Message" style="font-family:arial;" required></textarea>
          </div><br>
        <input type="submit" name="submit" value="Submit" class="mb-3 btn btn-primary" style="font-family:arial;">
        </form>
</div>
<div class='col-md-6'>
    
    
     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3500.093031102914!2d77.13279971489479!3d28.68686358239644!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d0318cc19e163%3A0x763d9a0360f3e643!2sSabre%20Edge!5e0!3m2!1sen!2sin!4v1648451407556!5m2!1sen!2sin" width="650" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
</div>

        <?php 


  
if(isset($_POST['submit']))
{
 // collect value of input field
   $nem =$_POST['name'];
   $emnl =$_POST['email'];
   $sbjt =$_POST['subject'];
   $mseg =$_POST['message'];


 
$ad_cnct="insert into contact_us set
name='$nem',
email='$emnl',
subject='$sbjt',
message='$mseg'";
$qst_ad_cnct=$db->query($ad_cnct);

if($qst_ad_cnct)
{
  echo "<script>window.alert('Thank you. We Will Contact You Soon.');window.location='';</script>";
}



}

?>


      </div>
    </section><!-- End Contact Section -->

    <?php include_once "footer.php";?>