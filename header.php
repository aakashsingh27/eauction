
<!doctype html>
<?php 


include('admin/config/config.php');

  
    $lgn_frm_cnsnt="select * from otp_consent where id='1'";
    $qst_lgn_frm_cnsnt=$db->query($lgn_frm_cnsnt);
    $clct_lgn_frm_cnsnt=$qst_lgn_frm_cnsnt->fetch_assoc();
    
    $cncnst=$clct_lgn_frm_cnsnt['consent'];
    
    
if(isset($_SESSION['bddr_id']))
{
    $ssen_id=$_SESSION['ssn_id'];
    $bedr_id=$_SESSION['bddr_id'];
    
    
    
  
    
    
$clt_bed_dtl="select * from newbidder_login where id='$bedr_id'";
$qst_clt_bed_dtl=$db->query($clt_bed_dtl);
$clct_clt_bed_dtl=$qst_clt_bed_dtl->fetch_assoc();

$lofgged_in_id=$clct_clt_bed_dtl['user_logged_in_id'];

if($lofgged_in_id!=$ssen_id)
{
 session_destroy();
 echo "<script>window.location='bidder_login.php';</script>";
}
}
?>   
   
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/boxicons.min.css">
    <link rel="stylesheet" href="./css/owl.carousel.min.css">
    <link rel="stylesheet" href="./css/owl.theme.default.css">
    <link rel="stylesheet" href="./css/owl.theme.default.min.css">
    <link rel="stylesheet" href="./css/styles.css">
   
  


    <title>E-AUCTION</title>
  </head>
  
  <body data-bs-spy="scroll" data-bs-target="#navbar-example">
  <style>
  .goog-logo-link{  
      display:none;
  }
  
.goog-logo-link {
   display:none !important;
}

.goog-te-gadget {
   color: transparent !important;
}

.goog-te-gadget .goog-te-combo {
   color: blue !important;
}
  </style>
    <!--NAVBAR-->
    <div class="top-nav" id="home">
      <div class="container">
        <div class="row justify-content-between">
         
          <div class="col-auto">
           
           
          <!-- <p><div id="google_translate_element" style="float: right;"></div></p> -->
          </div>

          <!--<div class="col-auto">-->
            
          <!--  <div class="social-links">-->
                
          <!--    <a href="https://www.facebook.com/IP-Support-100447402634692"><i class='bx bxl-twitter' ></i></a>-->
              
          <!--    <a href="https://www.facebook.com/IP-Support-100447402634692"><i class='bx bxl-facebook' ></i></a>-->
             
          <!--    <a href="https://www.linkedin.com/in/ip-support-57a98a234/"><i class='bx bxl-linkedin' ></i></a>-->
          <!--  </div>-->
          <!--</div>-->
        </div>
      </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: #fdfdfd;font-family: arial;">
      <div class="container">
        <a class="navbar-brand" href="https://ipsupport.in/"><img src="img/E-auction.png" style="height:50px;"></a>
         <i class='bx bx-envelope' style="color:black;font-weight:bold;"></i>
         <div class=" mx-2">  <span class="text-black" style="font-weight:bold;">mail@ipsupport.in</span> &nbsp;
              <i class='bx bxs-phone-call' style="color:black;font-weight:bold;" ></i></div>

             <span class="text-black" style="font-weight:bold;">+91-8826875426</span>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="
    color: white;
    background: black;
">
          <span class="navbar-toggler-icon" ></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto">
              <li class='nav-item'> </li>
            <li class="nav-item">
              <a class="nav-link text-black" aria-current="page" href="index.php" style="font-weight:bold;">Home</a>
            </li>  
            <!--<li class="nav-item">-->
            <!--  <a class="nav-link text-white" aria-current="page" href="#">Services</a>-->
            <!--</li>  -->
            <li class="nav-item">
              <a class="nav-link text-black" aria-current="page" href="biddinginfo.php" style="font-weight:bold;">Info</a>
            </li>
         <!--   <li class="nav-item">
              <a class="nav-link" href="liquid.php">LIQUIDATOR</a>
            </li>  -->
     <!--       <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>  

            <li class="nav-item">
              <a class="nav-link" href="admin.php">Admin Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.php">Contact</a>
            </li>
          </ul>
          <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-brand ms-lg-3">Liquidator Login</a>  -->
      
            <li class="nav-item">
              <a class="nav-link text-black" href="contact.php" style="font-weight:bold;">Contact</a>
            </li>

            
                 
        <?php 
        if(!isset($_SESSION['bddr_id']))
        {

        
        
        ?>
         <li class="nav-item">
          <a href="<?php if($cncnst=='otp'){?>bidder_login12.php<?php }else  { ?> bidder_login.php<?php }?>"  class="nav-link text-black" style="font-weight:bold;">Bidder Login</a>
                         <?php 
                            }
                            else if(isset($_SESSION['bddr_id']))
                            {
                              $bdr_id=$_SESSION['bddr_id'];
                              
                              
                            $clt_bdr_dtl="select * from newbidder_login where id='$bdr_id' and status='active'";
                           $qst_clt_bdr_dtl=$db->query($clt_bdr_dtl);
                           $clct_clt_bdr_dtl=$qst_clt_bdr_dtl->fetch_assoc();
                    
                           $bder_nem=$clct_clt_bdr_dtl['Bidder_Name'];
                         ?>
    
      

      <a href="view_aution_details.php"  class="nav-link text-black" style="font-weight:bold;" >Auctions</a>
        <a href="#"  class="nav-link" style='color:black;font-weight:bold;'>Hello <?php echo $bder_nem;?></a>
      <a href="logout.php"  class="nav-link text-black" style="font-weight:bold;">logout</a></li>

     <?php 
        }
     ?>
          <!--    <a href="admin.php" data-bs-target="#exampleModal" class="btn btn-brand ms-lg-3">Admin Login</a> -->
          
         <!-- <ul>
            <li>
                 <a class="nav-link" href="logout.php">Logout</a>
            </li>-->
            
           
          </ul> 
        </div>
      </div>
    </nav>



       <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
          <div class="modal-body p-10">
              <div class="container-fluid">
                

  
              </div>
          </div>

      </div>
  </div>
</div>



 

  <script src="./js/jquery.min.js"></script>
  <script src="./js/bootstrap.bundle.min.js"></script>
<!--  <script src="./js/owl.carousel.min.js"></script>-->
  <script src="./js/app.js"></script>
  


  </body>
</html>