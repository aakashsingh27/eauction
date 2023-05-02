    <?php
 include_once 'admin/config/config.php'; 

 date_default_timezone_set('Asia/Kolkata');
$date_time=date('Y-m-d H:i:s');

?>
<style>
  textarea{
    resize: none;
  }
  </style>
  <?php 



?>


<?php include_once "header.php";?>
 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



<!-------slick slider links start----->
 <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-------slick slider links end-------------->
<style>
@media only screen and (max-width: 600px) {
    
    
    .your-class{
        height:100px;
    }
    
}

/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) {
    
    .your-class{
        height:420px;
    }
    
    
}
</style>
<div class="your-class">
    <div><img src="https://eauction.gov.in/eauction/static/img/banner_4.d7db3ba.jpg" style="
    width: 100%;
"></div>
    <div><img src="https://eauction.gov.in/eauction/static/img/banner_3.ab056ab.jpg" style="width:100%;"></div>
    <div><img src="https://www.bidderwala.com/banner1.jpg" style="width:100%;"></div>
  </div>

    <!--SLIDER AREA-->
   <!-- <div class="slider-wrapper owl-carousel owl-theme" id="hero-slider">

      <div class="slider1 min-vh-100 bg-cover d-flex align-items-center">
        <div class="container">
          <div class="row">
            <div class="col-12">
             
            </div>
          </div>
        </div>
      </div>
    

    
      <div class="slider2 min-vh-100 bg-cover d-flex align-items-center">
        <div class="container">
          <div class="row">
            <div class="col-12">
             
            </div>
          </div>
        </div>
      </div>
    


    
      <div class="slider3 min-vh-100 bg-cover d-flex align-items-center">
        <div class="container">
          <div class="row">
            <div class="col-12">
             
            </div>
          </div>
        </div>
      </div>
    </div>-->

<style>
  #quickquiry {
    height: 0px;
    width: auto;
    position: fixed;
    right: -26px;
    top: 70%;
    z-index: 1000;
    transform: rotate(-90deg);
    -webkit-transform: rotate(-90deg);
}
  </style>

    <div id="quickquiry" >
			<a href="contact.php" class='btn btn-primary'>Quick Enquiry</a>
		</div>
<?php
$slt_dtl="select * from latest_announcement where id='1'";
$qst_slt_dtl=$db->query($slt_dtl);
$clct_slt_dtl=$qst_slt_dtl->fetch_assoc();

$cntent=$clct_slt_dtl['content'];

?>
    <div class='container mt-5'>
        <div class='row mb-5' style="background:black;">
    
    <div class='col-md-12' style="border:1px solid black;">
        <marquee><h5 style="color:white;"><?php echo $cntent;?></h5></marquee>
        
    </div>
    </div>
      <div class="row">    <h3>Search here</h3><hr></hr></div>
    </div>
    <div class="container">
     
    
    <form action='search_auction.php' method='POST'>

    <div class='row'>
  
<div class="col-md-4">
  <label style='font-weight:bold'>Choose City</label>
<select class='form-control' name='cty_id' required>
<option value="">Choose city</option>
<?php 
$clt_dtl="select * from city";
$qst_clt_dtl=$db->query($clt_dtl);
while($clct_clt_dtl=$qst_clt_dtl->fetch_assoc())
{
$cty_nem=$clct_clt_dtl['city_name'];
$cty_id=$clct_clt_dtl['id'];


  ?>
<option value="<?php echo $cty_id;?>"><?php echo $cty_nem;?></option>
  <?php
}
?>
</select>



</div>
<div class="col-md-4">
  <label style='font-weight:bold'>Enter auction detail</label>
<input type='text'  class='form-control' placeholder='Enter auction details' name='actn_detl' required>



</div>

<div class="col-md-4">
  <label style='font-weight:bold'></label>
<input type='submit'  class='form-control btn btn-warning' name='srch' value='Search' style="
    margin-top: 22px;
    margin-bottom: 20px;
" required>



</div>
  </div></form>
    
    
    
    <div class="row">
        <div class="col-md-8">
          
          <h5 class=" text-center  mt-5 mb-5"> <i class='bx bxs-quote-alt-left'></i>  IP Support is committed to provide efficient and easy to use e-auction platform for insolvency professionals, investors and establishments for directing the e-auction of the resources of the organization under liquidator as commanded under Insolvency and Bankruptcy Code, 2016 and different Laws. <i class='bx bxs-quote-alt-right'></i> <br><br>

           <i class='bx bxs-quote-alt-left'></i>
           Under Insolvency and Bankruptcy Code, 2016 the resources of the company under liquidation are to be sold by the liquidator via an e-auction on an internet-based entrance where the intrigued purchaser can register a bid and got affirmation of acknowledgment. 
          <i class='bx bxs-quote-alt-right'></i></h5>
        </div>

        <style>
        .blink {
            animation: blinker 1.5s linear infinite;
            color: red;
            font-family: sans-serif;
        }
        @keyframes blinker {
            50% {
                opacity: 0;
            }
        }
    </style>
<div class='col-md-4' style="
    border: 2px solid black;
    border-radius: 15px;
    margin-bottom: 10px;
    background: beige;
">



  <h5 style='text-align:center;color:red;'>BID DETAILS</h5>
<marquee height="300px" direction = "up" behaviour="scroll" scrolldelay="150" onmouseover='this.stop();' onmouseout='this.start();' style="
    position: relative;top:0px;">
<?php 
  
?>
<?php 
$clt_bd_dtl="select * from create_sale where  End_Date_Auction > '$date_time'";
$qst_clt_bd_dtl=$db->query($clt_bd_dtl);
$sl_ntec_cnt=mysqli_num_rows($qst_clt_bd_dtl);
if($sl_ntec_cnt==0)
{


?>
<p style="color: #263e89;font-weight: 600;" >No Bid is Pending</p>
 
<?php 
}
else
{
  $sno=1;
  while($clct_clt_bd_dtl=$qst_clt_bd_dtl->fetch_assoc())
  {
    $cemp_id=$clct_clt_bd_dtl['company_id'];
    $emd=$clct_clt_bd_dtl['emp'];
    $lqdtr_id=$clct_clt_bd_dtl['create_by_liquiditor_id'];
    $ttel=$clct_clt_bd_dtl['Title'];
    $pdf_file=$clct_clt_bd_dtl['Pdf'];
    $resvre_prec=$clct_clt_bd_dtl['Reserve_Price'];
    $strt_det=$clct_clt_bd_dtl['Start_Date_Auction'];
    $end_det_actn=$clct_clt_bd_dtl['End_Date_Auction'];


    $cmp_detl="select * from company where id='$cemp_id'";
    $qst_cmp_detl=$db->query($cmp_detl);
    $clct_cmp_detl=$qst_cmp_detl->fetch_assoc();

    $cemp_nem=$clct_cmp_detl['company_name'];
?>
<!-- <table class='table' style='border:1px solid black;margin-top:10px;'>
<tr><th>company name</th><td><?php echo $cemp_nem;?></td></tr> 
<tr><th>asset name </th><td><?php echo $ttel;?></td></tr> 
<tr><th>reserved price</th><td><?php echo $resvre_prec;?></td></tr>  
<tr><th>bid start time</th><td><?php echo $strt_det;?></td></tr> 
<tr><th>end time </th><td><?php echo $end_det_actn;?></td></tr> 
</table> -->
<p style="color: #263e89;font-weight: 600;" ><span style='font-weight:bold'><?php echo $sno++;?>.</span> company name :- <?php echo $cemp_nem;?> ,asset name :- <?php echo $ttel;?>, reserved price :- <?php echo  $resvre_prec;?>, bid start time :- <?php echo $strt_det;?>, end time :- <?php echo  $end_det_actn;?> , <a href="liquidator/sale_notice_pdf/<?php echo $pdf_file;?>" class='blink' style="color:red;font-weight:bold">Read more</a></p>
<?php
}
}
?>
</marquee>



</div>




      </div>

      <h3 class='pt-2'>Sale Notice</h3>
      <div class='table-responsive mt-2'>


<table class='table' >
<tr style="
    background: #f76767;
">
  <th>Sno</th>
  <th>Asset Name</th>
  <th>Liquidator name</th>
  <th>Reserved Price</th>
  <th>EMD</th>
  <th>Start Date</th>
  <th>End Date</th>
  <th>PDF</th>
  <th>file name</th>
  <th>Register</th>
  <th>T&C</th>
</tr>

<?php 
$clt_sl_netc_dtl="select * from create_sale where Start_Date_Auction > '$date_time' and End_Date_Auction > '$date_time'";
$qst_clt_sl_netc_dtl=$db->query($clt_sl_netc_dtl);
$sno=1;
while($clct_clt_sl_netc_dtl=$qst_clt_sl_netc_dtl->fetch_assoc())
{

  $asst_name=$clct_clt_sl_netc_dtl['Title'];
  $lqdtr_id=$clct_clt_sl_netc_dtl['create_by_liquiditor_id'];
  $sel_id=$clct_clt_sl_netc_dtl['id'];

  $clt_dtl="select * from add_liquidator where id='$lqdtr_id'";
  $qst_clt_dtl=$db->query($clt_dtl);
  $clct_clt_dtl=$qst_clt_dtl->fetch_assoc();

  $lqdter_nem=$clct_clt_dtl['liquidator_name'];

  $rsrve_prec=$clct_clt_sl_netc_dtl['Reserve_Price'];
  $emd=$clct_clt_sl_netc_dtl['emp'];

  $strt_det=$clct_clt_sl_netc_dtl['Start_Date_Auction'];
  $end_det=$clct_clt_sl_netc_dtl['End_Date_Auction'];
  $pdfs=$clct_clt_sl_netc_dtl['Pdf'];
 
  ?>

  <tr style="border:1px solid #8a8a8a;">
    <td><?php echo $sno++;?></td>
    <td><?php echo $asst_name;?></td>
    <td><?php echo $lqdter_nem;?></td>
    <td><?php echo $rsrve_prec;?></td>
    <td><?php echo $emd;?></td>
    <td><?php echo $strt_det;?></td>
    <td><?php echo $end_det;?></td>
    <td><a href='liquidator/sale_notice_pdf/<?php echo $pdfs;?>' traget="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;font-size: 25px;"></i></a></td>
    <td><?php echo $pdfs;?></td>
    <td><?php if(isset($_SESSION['bddr_id'])){?><a href='view_aution_details.php' class='btn btn-primary'>Bid</a><?php } else if(!isset($_SESSION['bddr_id'])){ ?> <a href='signup_bidder.php?ntc_id=<?php echo $sel_id;?>' class='btn btn-primary'>Bid</a><?php } ?></td>
    <td></td>







</tr>
  <?php
}
?>


</table>

  </div>
    </div>



    


     <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('.your-class').slick({
        dots: false,
  infinite: true,
  speed: 300,
infinite: true,
autoplay: true,
 arrows: false,
  autoplaySpeed: 2000,
  slidesToShow: 1,
  
  slidesToScroll: 1
      });
    });
  </script>


<?php include_once "footer.php";?>

    











