<?php
@ob_start();
//session_start();
require_once 'config/config.php';
require_once 'config/helper.php';
if (!empty($_SESSION['ibc'])) {
if ($_SESSION['ibc'] != session_id()) {
header('Location: index.php');
exit;
}
} else {
header('Location: login.php');
exit;
}
$logintype = $_SESSION['logintype'];
$a_idchk = $_SESSION['a_id'];

$ausernmae = $_SESSION['a_name'];
ob_start("ob_html_compress");
$comp_select = $db->query("SELECT * FROM `admin`");
$comp_fetch = $comp_select->fetch_object();
$a_company = $comp_fetch->a_company;
$check_a_name = $_SESSION['a_name'];
function facebook_time_ago($timestamp)
{
$time_ago = strtotime($timestamp);
$current_time = time();
$time_difference = $current_time - $time_ago;
$seconds = $time_difference;
$minutes      = round($seconds / 60);           // value 60 is seconds
$hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec
$days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;
$weeks          = round($seconds / 604800);          // 7*24*60*60;
$months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60
$years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60
if ($seconds <= 60) {
return "Just Now";
} else if ($minutes <= 60) {
if ($minutes == 1) {
return "one minute ago";
} else {
return "$minutes minutes ago";
}
} else if ($hours <= 24) {
if ($hours == 1) {
return "an hour ago";
} else {
return "$hours hrs ago";
}
} else if ($days <= 7) {
if ($days == 1) {
return "yesterday";
} else {
return "$days days ago";
}
} else if ($weeks <= 4.3) //4.3 == 52/12
{
if ($weeks == 1) {
return "a week ago";
} else {
return "$weeks weeks ago";
}
} else if ($months <= 12) {
if ($months == 1) {
return "a month ago";
} else {
return "$months months ago";
}
} else {
if ($years == 1) {
return "one year ago";
} else {
return "$years years ago";
}
}
}
?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<?php
$sls_id=$_GET['id'];

$sql=mysqli_query($db,"select * from create_sale where id='$sls_id'");
$result=mysqli_fetch_assoc($sql);
// print_r($result);
$start_date= $result['Start_Date_Auction'];
$end_date= $result['End_Date_Auction'];
$buffer_time=$result['buffer_time'];
$incrmnt_amnt=$result['Incremental'];
$actn_type=$result['auction_type'];
$nex_bid=$result['Reserve_Price'] +$incrmnt_amnt;
 // echo $next_bid;
$reserve_price=$result['Reserve_Price'];


$Incremental=$result['Incremental'];


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


$slt_hgst_bddr_dtl="select * from livebidding where salenotice_id='$sls_id' and highestBid='$heighest_bid'";
$qst_slt_hgst_bddr_dtl=$db->query($slt_hgst_bddr_dtl);
$clct_slt_hgst_bddr_dtl=$qst_slt_hgst_bddr_dtl->fetch_assoc();

$bder_iid=$clct_slt_hgst_bddr_dtl['bidder_fid'];

$slt_beedr_dtl="select * from newbidder_login where id='$bder_iid'";
$qst_slt_beedr_dtl=$db->query($slt_beedr_dtl);
$clct_slt_beedr_dtl=$qst_slt_beedr_dtl->fetch_assoc();

$bddr_uid=$clct_slt_beedr_dtl['uid'];



$ip_adrs=$clct_slt_hgst_bddr_dtl['ipaddress'];




  }
  else if($actn_type=="reverse")
  {
    $clt_lv_bdng="select min(highestBid) as high_bid from livebidding where salenotice_id='$sls_id'";
$qst_clt_lv_bdng=$db->query($clt_lv_bdng);
$clct_clt_lv_bdng=$qst_clt_lv_bdng->fetch_assoc();

 $heighest_bid=$clct_clt_lv_bdng['high_bid'];

 $bid_amnnt=$heighest_bid+$Incremental;
$next_bid=$bid_amnnt+$Incremental;






$slt_hgst_bddr_dtl="select * from livebidding where salenotice_id='$sls_id' and highestBid='$heighest_bid'";
$qst_slt_hgst_bddr_dtl=$db->query($slt_hgst_bddr_dtl);
$clct_slt_hgst_bddr_dtl=$qst_slt_hgst_bddr_dtl->fetch_assoc();

$bder_iid=$clct_slt_hgst_bddr_dtl['bidder_fid'];

$slt_beedr_dtl="select * from newbidder_login where id='$bder_iid'";
$qst_slt_beedr_dtl=$db->query($slt_beedr_dtl);
$clct_slt_beedr_dtl=$qst_slt_beedr_dtl->fetch_assoc();

$bddr_uid=$clct_slt_beedr_dtl['uid'];
$ip_adrs=$clct_slt_hgst_bddr_dtl['ipaddress'];
}
}


$ur_hgst_bid="select max(highestBid) as your_high_bid from livebidding where salenotice_id='$sls_id' and bidder_fid='$bdr_iid'";
$qst_ur_hgst_bid=$db->query($ur_hgst_bid);
$clct_ur_hgst_bid=$qst_ur_hgst_bid->fetch_assoc();

$yr_hgst_bid=$clct_ur_hgst_bid['your_high_bid'];


// ==============================now fetch data from bidderlive======
?>
<?php


date_default_timezone_set ('Asia/Kolkata'); 
$current_time= date ('Y-m-d H:i:s'); 
// echo $current_time;

  
$to_time = strtotime($end_date);
$from_time = strtotime($current_time);
//echo round(abs($to_time - $from_time) / 60,2). " minute";
?>

<?php include 'header.php'; ?>
<?php

?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<!--<h2 class="mt-30 page-title">Dashboard</h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Live Bid Auction</li>
</ol>


<div class="row">
<div class='col-md-12'>
<center>
<!--<h1 style="color: #1b369f;font-family: inherit;font-weight:bold">Live bidding Auction</h1>-->

<!--<p id="demo" style="font-size: 50px;" class="text-center"></p>-->

</center>


<div class="row justify-content-center">


<div class="mb-3 col mx-auto">
      <!--      <table class='table'>
<tr><td><h3>Company name</h3></td><td><h3><?php echo $cmpy_nem;?></h3></td></tr>
<tr><td><h3>Assets name</h3></td><td><h3><?php echo $ttel;?></h3></td></tr>
<tr><td><h3>Increamental value</h3></td><td><h3><?php echo $Incremental;?> ₹</h3></td></tr>

<tr><td><h3>Auction type</h3></td><td><h3><?php echo $actn_type;?></h3></td></tr>
<tr><td><h3>Reserve Price</h3></td><td><h3><?php echo $reserve_price;?>  ₹</h3></td></tr>
<tr><td><h3>Highest Bid ( UID => <span style='color:blue;' id='hgst_uid'><?php echo $bddr_uid;?></span> IP Address => <span style='color:blue;' id='ip_drs'><?php echo $ip_adrs;?></span>)</h3></td><td><h3 id='hgst_bid' style="color:blue;font-weight:bold"><?php echo $heighest_bid;?>  ₹</h3></td></tr>

<tr><td><h3>Next Bid</h3></td><td><h3 id='nxt_bd_amnt' style="color:red;font-weight:bold"><?php echo $bid_amnnt;?>  ₹</h3></td></tr>
     



</table>-->



<div class="row border">
                 <div class="col-md-6">    
                  <div class="section-title p-0" style="background:#efa792;">
                      <div class="spinner-grow text-success" style="width: 1rem; height: 1rem;" role="status">
                                  <span class="visually-hidden"></span>
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
                                  <td>Live</td>
                                  <!--<td></td>-->
                                  <td><span id="demo"> </span></td>
                                </tr>
                               
                              </tbody>
                            </table>
                     </div>               
                </div>
                </div> 
                
                
                
                
                <style>
            .scroll{
                height:150px;
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
$clt_otr_lv_detl="select * from create_sale where id!='$sls_id' and create_by_liquiditor_id='$a_idchk' and Start_Date_Auction < '$current_time' and End_Date_Auction > '$current_time'";
$qst_clt_otr_lv_detl=$db->query($clt_otr_lv_detl);
while($clct_clt_otr_lv_detl=$qst_clt_otr_lv_detl->fetch_assoc())
{

$iisd=$clct_clt_otr_lv_detl['id'];
$ttel_sd=$clct_clt_otr_lv_detl['Title'];
$stetrt_actn_det=$clct_clt_otr_lv_detl['Start_Date_Auction'];
$end_actn_dddet=$clct_clt_otr_lv_detl['End_Date_Auction'];
?>
                                <tr>
                                <td><?php echo $iisd;?></td>
                                <td><?php echo $ttel_sd;?></td>
                                <td><?php echo $stetrt_actn_det;?></td>
                                <td><?php echo $end_actn_dddet;?></td>
                                <td><?php echo "Live";?></td>
                                <td><a href='?id=<?php echo $iisd;?>' class='btn btn-primary'>View Auction</a></td>
                                </tr>                                  
<?php 
}
?>
                              
                                                                </tbody>
                            </table>
                     </div>               
            
                </div>               
                
                </div>

                                           <!-- <input type="button" class="btn btn-primary btn-lg mb-20 just"  data-toggle="modal" data-target="#myModal"  value="Raise My Bid" data-backdrop="static" data-keyboard="false"  style="font-size: 17px;margin-bottom: 15px;align-items: right;float: right;width:100%"> -->

                     
              </div>


                  <input type="text" value="101000" name="bddng_amont" id="hgst_bgng_amnt" class="d-none" readonly="">
              

              
              <div class="row">
               <div class="col-md-12" id="tp_tenm_tbl">           
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
                
                
              
                 </div>
                



       
                
                
              
             
        </div>
           


  </div>


</div>




</div>

</div>
<div id='scriptr'></div>
</main>





<script>
     <?php   
 

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
//tp_tenm_tbl




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

$('#hgst_uid').html(obj.heighest_bid_uid);
$('#ip_drs').html(obj.ip_addrs);

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
data    :{txt1:"<?php echo $sls_id;?>"},
success : function(data){


$('#tp_tenm_tbl').html(data);






},
error   : function(resp){
}  
});
}, 2000);









});

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


</script>





<?php include 'footer.php'; 

ob_flush();

?>