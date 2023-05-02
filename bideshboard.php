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

$lqdtor_id=$result['create_by_liquiditor_id'];

$cemp_id=$result['company_id'];




$slt_dtl="select * from assign_bidders_by_liquidator where company_id='$cemp_id' and bidder_id='$bdr_iid'";
$qst_slt_dtl=$db->query($slt_dtl);
$dtl_cnt=mysqli_num_rows($qst_slt_dtl);

if($dtl_cnt==0)
{
    
    echo "<script>window.location='apply_request.php?company_id=$cemp_id&liquidator_id=$lqdtor_id&sel_ntec_id=$sls_id';</script>";
}

 // echo $next_bid;


$cert_ddet=date("Y-m-d H:i:s");

$bfr_prvs_tem = date('Y-m-d H:i:s', strtotime($end_date. ' -'.$buffer_time.' minutes'));

$bfr_after_tem = date('Y-m-d H:i:s', strtotime($end_date. ' +'.$buffer_time.' minutes'));

$bfr_aftr_tem = date('Y-m-d H:i:s', strtotime($cert_ddet. ' +'.$buffer_time.' minutes'));


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
//$next_bid=$bid_amnnt+$Incremental;
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
 
 <script src='security.js'></script>
 
  </head>
 
 
 
  <body style="background: #29296e;">
          <!-- <div class="d-grid gap-2 d-md-flex justify-content-md-end m-4">
                  <a href="logout.php"> <button type="button" class="mb-3 btn btn-primary btn-lg float-right">Logout</button></a>
          </div> -->
          <div class=" text-center">
              <!-- <span><strong><h2 class="text-white">LIVE BIDDING AUCTION </h2></strong></span><br><br> -->
     
          </div>
      
   <div class="container-fluid my-4">  
   
      <div class="col-md-12  justify-content-md-center   bg-light  p-4" id="fun" style="margin-bottom: 50px; border-radius: 20px 20px; border: 6px solid orange;  ">
           
         <div class="col-md-12">
         <div class=" text-center">
         <span><strong><h4 class="text-black" style="margin-top-0px;">LIVE BIDDING AUCTION </h4></strong></span>
         </div>
           <form action="" method="POST">
                
                
                
                
                <div class="row border">
                 <div class="col-md-6">    
                  <div class="section-title p-0" style="background:#efa792;">
                      <div class="spinner-grow text-success" style="width: 1rem; height: 1rem;" role="status">
                                  <span class="visually-hidden">Loading...</span>
                                  </div>
                      Your Current Auction
                  </div>
                 <div class="form-group">
                     <div class="table-responsive py-4">
                            <table class="table">
                              <thead class="bg-dark text-white">
                                <tr>
                                  <th scope="col">ID</th>
                                  <th scope="col">Item Name</th>
                                  <th scope="col">Starts</th>
                                  <th scope="col">Ends</th>
                                  <th scope="col">Status</th>
                                  <!--<th scope="col">No. Of Ext</th>-->
                                  <th scope="col">Time Remaining</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <th scope="row">1</th>
                                  <td><?php echo $ttel;?></td>
                                  <td><?php echo $start_date;?></td>
                                  <td><?php echo $end_date;?></td>
                                  <td><?php 
                                  if($end_date > $timestamp)
                                  {
                                      echo "Live";
                                  }
                                  else
                                  {
                                      echo "Closed";
                                  }
                                  
                                  ?></td>
                                  <!--<td></td>-->
                                  <td><span id='demo'></span></td>
                                </tr>
                               
                              </tbody>
                            </table>
                     </div>               
                </div>
                </div> 
                
                
                
                
                <style>
            .scroll{
                height:185px;
                overflow:scroll;
            }
                </style>
                
                
                
                
                <div class="col-md-6 ">
                
                 <div class="section-title p-0" style="background:#efa792;">
                      Your Started Other Auction Status
                  </div>         
                 <div class="form-group">
                      <div class="table-responsive py-4 scroll">
                            <table class="table">
                              <thead class="bg-dark text-white">
                                <tr>
                                  <th scope="col">ID</th>
                                  <th scope="col">Item Name</th>
                                  <th scope="col">Starts</th>
                                  <th scope="col">Ends</th>
                                  <th scope="col">Status</th>

                                  <th scope="col">View Bid</th>
                                </tr>
                              </thead>
                              <tbody>
                                  
                                  
                                  
                                  <?php 

$clt_actn_dtl="select * from assign_bidders_by_liquidator where liquidator_id='$lqdtr_id' and bidder_id='$bdr_iid'";

$qst_clt_actn_dtl=$db->query($clt_actn_dtl);
$sano=1;
while($clct_clt_actn_dtl=$qst_clt_actn_dtl->fetch_assoc())
{
    $cmp_id=$clct_clt_actn_dtl['company_id'];

    $clt_sel_notc_dtl="select * from create_sale where company_id='$cmp_id' and id!='$sls_id'";
    $qst_clt_sel_notc_dtl=$db->query($clt_sel_notc_dtl);
    while($clct_clt_sel_notc_dtl=$qst_clt_sel_notc_dtl->fetch_assoc())
    {
    
    $tstel=$clct_clt_sel_notc_dtl['Title'];
    $incrmnt=$clct_clt_sel_notc_dtl['Incremental'];
    $rsrv_prce=$clct_clt_sel_notc_dtl['Reserve_Price'];
    $strt_act_det=$clct_clt_sel_notc_dtl['Start_Date_Auction'];
    $end_actn_det=$clct_clt_sel_notc_dtl['End_Date_Auction'];
    $actn_type=$clct_clt_sel_notc_dtl['auction_type'];
$cmp_iid=$clct_clt_sel_notc_dtl['company_id'];
$slsssssss_id=$clct_clt_sel_notc_dtl['id'];
$eeemp=$clct_clt_sel_notc_dtl['emp'];
if($strt_act_det < $timestamp and $end_actn_det > $timestamp)
{
$clt_cmpy_dtl="select * from company where id='$cmp_iid'";
$qst_clt_cmp=$db->query($clt_cmpy_dtl);
$clct_clt_cmp=$qst_clt_cmp->fetch_assoc();

$cmep_nem=$clct_clt_cmp['company_name'];

?>

  <tr>
                                  <th scope="row"><?php echo $sano++;?></th>
                                  <td><?php echo $tstel;?></td>
                                  <td><?php echo $strt_act_det;?></td>
                                  <td><?php echo $end_actn_det;?></td>
                                  <td style="color:green;font-weight:bold">Live</td>
                                
            <td><a href='bideshboard.php?id=<?php echo $slsssssss_id;?>' ><img src="img/hammer.jpg" style="width:50px"></a></td>
                                </tr>
                               <?php
}
}
}
                               ?>
                              </tbody>
                            </table>
                     </div>               
            
                </div>               
                
                </div>

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



                  <input type='text' value="<?php echo $bid_amnnt;?>" name='bddng_amont' id='hgst_bgng_amnt'  class="d-none" readonly>
              

              
              <div class="row">
               <div class="col-md-8" id="tp_tenm_tbl">
                <table class="table">
                              <thead class="">
                                <tr>
                                  <th scope="col">Serial No.</th>
                                  <!--<th scope="col">UID</th>-->
                                  <th scope="col">number of ext</th>
                                  <th scope="col">Bid Price</th>
                                  <th scope="col">In Words</th>
                                
                            
                                </tr>
                              </thead>
                              <tbody>
<?php 
function number_to_word( $num = '' )
{
    $num    = ( string ) ( ( int ) $num );
   
    if( ( int ) ( $num ) && ctype_digit( $num ) )
    {
        $words  = array( );
       
        $num    = str_replace( array( ',' , ' ' ) , '' , trim( $num ) );
       
        $list1  = array('','one','two','three','four','five','six','seven',
            'eight','nine','ten','eleven','twelve','thirteen','fourteen',
            'fifteen','sixteen','seventeen','eighteen','nineteen');
       
        $list2  = array('','ten','twenty','thirty','forty','fifty','sixty',
            'seventy','eighty','ninety','hundred');
       
        $list3  = array('','thousand','million','billion','trillion',
            'quadrillion','quintillion','sextillion','septillion',
            'octillion','nonillion','decillion','undecillion',
            'duodecillion','tredecillion','quattuordecillion',
            'quindecillion','sexdecillion','septendecillion',
            'octodecillion','novemdecillion','vigintillion');
       
        $num_length = strlen( $num );
        $levels = ( int ) ( ( $num_length + 2 ) / 3 );
        $max_length = $levels * 3;
        $num    = substr( '00'.$num , -$max_length );
        $num_levels = str_split( $num , 3 );
       
        foreach( $num_levels as $num_part )
        {
            $levels--;
            $hundreds   = ( int ) ( $num_part / 100 );
            $hundreds   = ( $hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '' );
            $tens       = ( int ) ( $num_part % 100 );
            $singles    = '';
           
            if( $tens < 20 ) { $tens = ( $tens ? ' ' . $list1[$tens] . ' ' : '' ); } else { $tens = ( int ) ( $tens / 10 ); $tens = ' ' . $list2[$tens] . ' '; $singles = ( int ) ( $num_part % 10 ); $singles = ' ' . $list1[$singles] . ' '; } $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_part ) ) ? ' ' . $list3[$levels] . ' ' : '' ); } $commas = count( $words ); if( $commas > 1 )
        {
            $commas = $commas - 1;
        }
       
        $words  = implode( ', ' , $words );
       
        $words  = trim( str_replace( ' ,' , ',' , ucwords( $words ) )  , ', ' );
        if( $commas )
        {
            $words  = str_replace( ',' , ' and' , $words );
        }
       
        return $words;
    }
    else if( ! ( ( int ) $num ) )
    {
        return 'Zero';
    }
    return '';
}


$sno=1;
$clt_lasdt_bd_dtl="select * from livebidding where salenotice_id='$sls_id' order by id desc limit 10";
$qst_clt_lasdt_bd_dtl=$db->query($clt_lasdt_bd_dtl);
while($clct_clt_lasdt_bd_dtl=$qst_clt_lasdt_bd_dtl->fetch_assoc())
{
$amnnt=$clct_clt_lasdt_bd_dtl['highestBid'];
$bdr_id=$clct_clt_lasdt_bd_dtl['bidder_fid'];
$nbr_of_ext=$clct_clt_lasdt_bd_dtl['number_of_extension'];

$clt_bdr_dtl="select * from newbidder_login where id='$bdr_id'";
$qst_clt_bdr_dtl=$db->query($clt_bdr_dtl);
$clct_clt_bdr_dtl=$qst_clt_bdr_dtl->fetch_assoc();

$uuid=$clct_clt_bdr_dtl['uid'];
?>
<tr>
                                  <td scope="row"><?php echo $sno++;?></td>
                                  <!--<td><?php echo $uuid;?></td>-->
                                  <td><?php echo $nbr_of_ext;?></td>
                                  <td><?php echo $amnnt;?></td>
                                  <td><?php echo number_to_word($amnnt);?></td>
                                  </tr>
                            <?php 
}
                            ?>
                              </tbody>                
                </table>
                </div>
                
                
                 <div class="col-md-4">
                        <div class="card" style="">
                          <div class="card-header">
                            Operations
                          </div>
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item">Opening Price<h5><?php echo $reserve_price;?> ₹ (<span style="color:red"><?php echo number_to_word($reserve_price);?></span>)</h5> </li>
                            <li class="list-group-item">Last Bid <h5 id='hgst_bid'><?php echo $heighest_bid;?> ₹ </h5> (<span style="color:red;font-weight:bold" id='hgt_bid_words'><?php echo number_to_word($heighest_bid);?></span>)</li>
                            <li class="list-group-item">Next Bid Price <h5 id='nxt_bd_amnt'><?php echo $bid_amnnt;?> ₹ </h5> (<span style="color:red;font-weight:bold" id="nxt_bid_wrds"><?php echo number_to_word($bid_amnnt);?></span>) </li>
                            <li class="list-group-item">Bid Increment <h5><?php echo $Incremental;?> ₹ (<span style="color:red"><?php echo number_to_word($Incremental);?></span>)</h5> </li>
                            <li class="list-group-item">No. Of Inc <br> 
                             <input type='number' min='0' value="1" name="nbr_of_incrmnt" id="nber_of_inc" style="width: 100%;" placeholder="Enter number of increament" maxlength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                             
                                       </li>
                                       
                                       
                                      <!-- <li class="list-group-item">Amount <br> 
                             <input type='number' min='<?php echo $bid_amnnt?>' value="<?php echo $bid_amnnt?>" name="amnt_incrmnt" id="amt_incrmnt" style="width: 100%;" placeholder="Enter amount">
                             
                                       </li>-->
                                       
                                       
                                       
                                       
                          </ul>

                        <div class='btn-sm'>
<?php   


if($start_date<=$current_time and $end_date > $current_time)
{  ?>
<center><input type="button" class="btn btn-warning btn-lg mb-20 just text-white"  data-toggle="modal" data-target="#myModal" value="Raise My Bid" data-backdrop="static" data-keyboard="false"   value="Raise My Bid"  style="font-size: 20px;margin-bottom: 15px;color: black;align-items: right;float: right;width:100%;border: 2px solid #162270;font-weight: bold;"></center>

<?php 
}
?>
                        </div>
                        </div>
                     
                 </div>
                 </div>
                



       
                
                
              
             </form>
        </div>
    
    </div>

</div>
 
<div id='scriptr'></div>


<?php 
include("footer.php");
?>
<?php

if(isset($_POST['submit']))
{
$nbr_of_incrmnt=$_POST['nbr_of_incrmnt'];
$bdng_xamnt= $_POST['bddng_amont'];



$slt_lv_bgng_cnt="select * from livebidding where salenotice_id='$sls_id'";
$qst_slt_lv_bgng_cnt=$db->query($slt_lv_bgng_cnt);
$clct_lv_bgng_cnt=mysqli_num_rows($qst_slt_lv_bgng_cnt);




$multiply_amt=$nbr_of_incrmnt*$Incremental;

$bbd_amnt=$bdng_xamnt-$Incremental;
if($clct_lv_bgng_cnt==0)
{
  
$bdng_amnt=$multiply_amt+$bdng_xamnt;
$next_bid=$bdng_amnt+$Incremental;
}
else
{
  $bdng_amnt=$bbd_amnt+$multiply_amt;
}






if($start_date<=$current_time and $end_date > $current_time)
{
  $clt_lv_bdng_dtl="select * from livebidding where highestBid='$bdng_amnt' and salenotice_id='$sls_id'";
  $qst_clt_lv_bdng_dtl=$db->query($clt_lv_bdng_dtl);
$clt_lv_cnt=mysqli_num_rows($qst_clt_lv_bdng_dtl);
if($clt_lv_cnt==0)
{


$ad_bid="insert into livebidding set
reserver_Price='$reserve_price',
highestBid='$bdng_amnt',
nextBid='$next_bid',
bidder_fid='$bdr_iid',
salenotice_id='$sls_id',
number_of_extension='$nbr_of_incrmnt',
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
                      ?>
<script>
                            Swal.fire({
                          
                          icon: 'error',
                          title: 'This Bid is placed by anaother user please try again',
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


 
    </div>
   
</body>


    
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
$('#amt_incrmnt').keyup(function(){
var pntnm=$('#amt_incrmnt').val();
var remainder=(pntnm % <?php echo $Incremental;?>)

alert(remainder);
});
});
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
$('#hgst_bid').html(obj.hgst_bbd);

$('#hgst_bgng_amnt').val(obj.next_bid_vl);


$('#hgt_bid_words').html(obj.heighest_bid_in_word);



$('#nxt_bid_wrds').html(obj.next_bid_word);


var hgggst_bid=obj.hgst_bbd;

var bd_ccnnt=obj.bid_counst;

var nbr_of_ext=$('#nber_of_inc').val();

var ttl_extn=nbr_of_ext*<?php echo $Incremental;?>


if(nbr_of_ext==-100009900)
{
   $('#nxt_bd_amnt').html(obj.next_bid);
   $('#md_bd').html(obj.next_bid);






}
else
{

//console.log(bd_ccnnt);

if(bd_ccnnt==0)
{

  var nxxt_bd=parseInt(obj.next_bid_vl)+parseInt(ttl_extn);
  //alert(nxxt_bd);
  $('#nxt_bd_amnt').html(nxxt_bd);
    $('#md_bd').html(nxxt_bd);
}
else
{
  var nxxt_bd=parseInt(hgggst_bid)+parseInt(ttl_extn);

$('#nxt_bd_amnt').html(nxxt_bd);
$('#md_bd').html(nxxt_bd);
}



    
}






}

},
error   : function(resp){
}  
});
}, 2000);



 setInterval(function(){ 
	
$.ajax({
url     : 'top_ten_bid_ajax.php',
type    : 'POST',
data    :{txt1:"<?php echo $sls_id;?>",txt2:"<?php echo $bdr_iid;?>"},
success : function(data){


$('#tp_tenm_tbl').html(data);






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
</html>