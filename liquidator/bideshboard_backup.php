<?php 
@ob_start();
include'admin/config/config.php';
include "header.php";

$ipaddress = getenv("REMOTE_ADDR");

date_default_timezone_set('Asia/Kolkata');
$timestamp = date("Y-m-d H:i:s");

if(isset($_SESSION['bddr_id']))
{
$lqdtr_id=$_SESSION['liquiditor_id'];
$bdr_iid=$_SESSION['bddr_id'];
}
else
{
  echo "<script>window.location='bidder_login.php';window.alert('Please login');</script>";
}

$sls_id=$_GET['id'];

$sql=mysqli_query($db,"select * from create_sale where id='$sls_id'");
$result=mysqli_fetch_assoc($sql);
// print_r($result);
$start_date= $result['Start_Date_Auction'];
$end_date= $result['End_Date_Auction'];
$buffer_time=$result['buffer_time'];
$incrmnt_amnt=$result['Incremental'];
$nex_bid=$result['Reserve_Price'] +$incrmnt_amnt;

$actn_type=$result['auction_type'];

$ernst_mney_dpst=$result['emp'];


 // echo $next_bid;




$bfr_prvs_tem = date('Y-m-d H:i:s', strtotime($end_date. ' -'.$buffer_time.' minutes'));

$bfr_after_tem = date('Y-m-d H:i:s', strtotime($end_date. ' +'.$buffer_time.' minutes'));

$bfr_aftr_tem = date('Y-m-d H:i:s', strtotime($end_date. ' +'.$buffer_time.' minutes'));


 $reserve_price=$result['Reserve_Price'];

 if($actn_type=="forward")
 {

 

$Incremental=$result['Incremental'];

 }
 else if($actn_type=="reverse")
 {
  $Incremental=-$result['Incremental'];
 }

$cmp_iid=$result['company_id'];

$clt_cmp_dtl="select * from company where id='$cmp_iid'";
$qst_clt_cmp_dtl=$db->query($clt_cmp_dtl);
$clct_clt_cmp_dtl=$qst_clt_cmp_dtl->fetch_assoc();

$cmpy_nem=$clct_clt_cmp_dtl['company_name'];


$ttel=$result['Title'];

$clt_dtl="select * from livebidding  where salenotice_id='$sls_id'";
$qst_clt_dtl=$db->query($clt_dtl);
$clt_dtl_cnt=mysqli_num_rows($qst_clt_dtl);

if($clt_dtl_cnt==0)

{
$heighest_bid=0;

$bid_amnnt=$reserve_price;
$next_bid=$bid_amnnt+$Incremental;
}
else
{

  if($actn_type=="forward")
  {

$clt_lv_bdng="select max(highestBid) as high_bid from livebidding where salenotice_id='$sls_id'";
$qst_clt_lv_bdng=$db->query($clt_lv_bdng);
$clct_clt_lv_bdng=$qst_clt_lv_bdng->fetch_assoc();

 $heighest_bid=$clct_clt_lv_bdng['high_bid'];

 $bid_amnnt=$heighest_bid+$Incremental;
$next_bid=$bid_amnnt+$Incremental;
  }
  else if($actn_type=="reverse")
  {

    $clt_lv_bdng="select min(highestBid) as high_bid from livebidding where salenotice_id='$sls_id'";
    $qst_clt_lv_bdng=$db->query($clt_lv_bdng);
    $clct_clt_lv_bdng=$qst_clt_lv_bdng->fetch_assoc();
    
     $heighest_bid=$clct_clt_lv_bdng['high_bid'];
    
     $bid_amnnt=$heighest_bid+$Incremental;
    $next_bid=$bid_amnnt+$Incremental;
  }

}
if($actn_type=="forward")
 {

 

$ur_hgst_bid="select max(highestBid) as your_high_bid from livebidding where salenotice_id='$sls_id' and bidder_fid='$bdr_iid'";
$qst_ur_hgst_bid=$db->query($ur_hgst_bid);
$clct_ur_hgst_bid=$qst_ur_hgst_bid->fetch_assoc();

$yr_hgst_bid=$clct_ur_hgst_bid['your_high_bid'];

 }
 else if($actn_type=="reverse")
 {
  
$ur_hgst_bid="select min(highestBid) as your_high_bid from livebidding where salenotice_id='$sls_id' and bidder_fid='$bdr_iid'";
$qst_ur_hgst_bid=$db->query($ur_hgst_bid);
$clct_ur_hgst_bid=$qst_ur_hgst_bid->fetch_assoc();

$yr_hgst_bid=$clct_ur_hgst_bid['your_high_bid'];
 }
// ==============================now fetch data from bidderlive======
?>
<style>
  .nav-link{
    padding-top:15px;
  }
  </style>
<?php


date_default_timezone_set ('Asia/Kolkata'); 
$current_time= date ('Y-m-d H:i:s'); 
// echo $current_time;

  
$to_time = strtotime($end_date);
$from_time = strtotime($current_time);
//echo round(abs($to_time - $from_time) / 60,2). " minute";
?>

<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body style="background: #29296e;">
          <!-- <div class="d-grid gap-2 d-md-flex justify-content-md-end m-4">
                  <a href="logout.php"> <button type="button" class="mb-3 btn btn-primary btn-lg float-right">Logout</button></a>
          </div> -->
          <div class=" text-center">
              <!-- <span><strong><h2 class="text-white">LIVE BIDDING AUCTION </h2></strong></span><br><br> -->
     
          </div>
      
  <div class="container my-4">  
   
      <div class="col-md-6  justify-content-md-center   bg-light  p-4" id="fun" style="margin-bottom: 50px; border-radius: 20px 20px; border: 6px solid orange;  ">
           
         <div class="col-md-12">
         <div class=" text-center">
         <span><strong><h4 class="text-black" style="margin-top-0px;">LIVE BIDDING AUCTION </h4></strong></span>
</div>
           <form action="" method="POST">
                <p id="demo" style="font-size: 24px;" class="text-center"></p>

                      <?php   
                         if($start_date<=$current_time and $end_date > $current_time)
                        {  ?>
                     <!-- <input type="button" class="btn btn-primary btn-lg mb-20 just"  data-toggle="modal" data-target="#myModal"  value="Raise My Bid" data-backdrop="static" data-keyboard="false"  style="font-size: 17px;margin-bottom: 15px;align-items: right;float: right;width:100%"> -->

                     <?php 
                         }
                          ?>

                <!-------------Mymodal start-------------->

                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title">Confirmation</h4>
                          
                       
                        </div>
                        <div class="modal-body">
                          <h4>Are you sure want to raised Bid in <span style="color:red" id='md_bd'></span></h4>
                        </div>
                        <div class="modal-footer">
                        <input type="submit" name="submit" value="submit" class="btn btn-primary">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                  

                <!-------------mymodal end----------->



                  <input type='text' value="<?php echo $bid_amnnt;?>" name='bddng_amont' id='hgst_bgng_amnt' class="d-none" readonly>
              







                <!-- <div class="mb-3 col mx-auto"> -->
                  <table class='table table-responsive-sm text-align-left'>
                        <tr><td><h5>Company name</h5></td><td><h5><?php echo $cmpy_nem;?></h5></td></tr>
                        <tr><td><h5>Assets name</h5></td><td><h5><?php echo $ttel;?></h5></td></tr>
                        <tr><td><h5>Auction type </h5></td><td><h5><?php echo $actn_type;?></h5></td></tr>
                        <tr><td><h5>Increamental Value</h5></td><td><h5><?php echo $Incremental;?> ₹</h5></td></tr>

                        <tr><td><h5>Earnest money deposit</h5></td><td><h5><?php echo $ernst_mney_dpst;?> ₹</h5></td></tr>

                        <tr><td><h5>Reserve Price</h5></td><td><h5><?php echo $reserve_price;?>  ₹</h5></td></tr>
                        <tr><td><h5>Highest Bid</h5></td><td><h5 id='hgst_bid'><?php echo $heighest_bid;?>  ₹</h5></td></tr>
                        <tr><td><h5>Your Highest Bid</h5></td><td><h5><?php echo $yr_hgst_bid;?> ₹</h5></td></tr>
                        <tr><td><h5>Next Bid</h5></td><td><h5 id='nxt_bd_amnt'><?php echo $bid_amnnt;?>  ₹</h5></td></tr>
                  </table>
             </form>
        </div>
    </div>

    <div class='col-md-6'>
    <?php   


if($start_date<=$current_time and $end_date > $current_time)
{  ?>
<input type="button" class="btn btn-warning btn-lg mb-20 just"  data-toggle="modal" data-target="#myModal"  value="Raise My Bid" data-backdrop="static" data-keyboard="false"  style="font-size: 20px;margin-bottom: 15px;color: black;align-items: right;float: right;width:100%;border: 2px solid black;font-weight: bold;">

<?php 
}
 ?>
    </div>
</div>
 
    


                          <?php

                      if(isset($_POST['submit']))
                      {

                        $bdng_amnt= $_POST['bddng_amont'];



                      if($start_date<=$current_time and $end_date > $current_time)
                      {
                      $ad_bid="insert into livebidding set
                      reserver_Price='$reserve_price',
                      highestBid='$bdng_amnt',
                      nextBid='$next_bid',
                      bidder_fid='$bdr_iid',
                      salenotice_id='$sls_id',
                      incremental_val='$incrmnt_amnt',
                      ipaddress='$ipaddress',
                      datetime='$timestamp'";
                      $qst_ad_bid=$db->query($ad_bid);

                      if($qst_ad_bid)
                      {


                      if($timestamp > $bfr_prvs_tem and $timestamp < $end_date)
                      {

                      $updt_end_bid_tem="update create_sale set End_Date_Auction='$bfr_aftr_tem' where id='$sls_id'";
                      $qst_updt_end_bid_tem=$db->query($updt_end_bid_tem);
                      }





                         ?>





                        <script>
                            Swal.fire({
                          
                          icon: 'success',
                          title: 'Bid placed successfully',
                          showConfirmButton: false,
                          timer: 1500
                        });

                        setInterval(function(){ 

                          window.location='';
                        }, 2000);
                        </script>




                      <?php
                      }


                      }
                      else

                      {
                      echo "<script>
                          alert('Bid Is Not live Yet');window.location='';
                         </script>";



                      }
                      }

                      ?>


 
    
   

  <div id='scriptr'></div>


<?php 
include("footer.php");
?>
  </body>
</html>

    
   <!--  // Set the date we're counting down to
    // 1. JavaScript
    // var countDownDate = new Date("Sep 5, 2018 15:37:25").getTime();
    // 2. PHP -->
  
   <script>
     <?php   
  // echo $start_date;
  // echo $end_date;

    if($start_date<=$current_time and $end_date > $current_time)
{
   ?>
   /* var countDownDate = <?php echo strtotime($end_date) ?> * 1000;
    var now = <?php echo strtotime($start_date) ?> * 1000;

    var x = setInterval(function() {

        var now = new Date().getTime();
         now = now + 1000;

        var distance = countDownDate - now;
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
            minutes + "m " + seconds + "s ";

        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "Voting has been closed";
        }
    }, 1000);*/
    <?php 
     }
    else
    {
        ?>
      
        document.getElementById("demo").innerHTML = "Bid time is Over";
      
        <?php
    }
    ?>
    </script>



<script>
$(document).ready(function(){
   setInterval(function(){ 
	
$.ajax({
url     : 'heighest_bid_ajax.php',
type    : 'POST',
data    :{txt1:"<?php echo $sls_id;?>"},
success : function(resp){
var obj=jQuery.parseJSON( resp );
if(obj.status==1)
{
$('#hgst_bid').html(obj.heighest_bid);

$('#hgst_bgng_amnt').val(obj.next_bid_vl);

$('#nxt_bd_amnt').html(obj.next_bid);
$('#md_bd').html(obj.next_bid);



}

},
error   : function(resp){
}  
});
}, 2000);

});





//javascript get from ajax start
setInterval(function(){
    $.ajax({
url     : 'script_ajax.php',
type    : 'POST',
data    :{txt1:"<?php echo $sls_id;?>"},
success : function(data){


$('#scriptr').html(data);



},
error   : function(resp){
}  
});
 }, 1000);
//javascript get from ajax end

</script>