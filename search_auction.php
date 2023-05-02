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
  
<style>
  textarea{
    resize: none;
  }
  body{
      background-image:url('img/download.svg'); 
      
      background-repeat:no-repeat;
  }
  </style>
  <?php 

 $stet_id=$_POST['sttet'];
$prty_ttyp=$_POST['prpty_typ'];
$budget_value=$_POST['bdg_vlu'];
$bedgt_ferm=$_POST['bdgt_frm'];
$bedgt_to=$_POST['bdgt_to'];






?>


<?php include_once "header.php";?>
 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">




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
    left: -70px;
    top: 50%;
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

    <div class='container'>
        <div class='row ' >
            <div class="col-md-1">
            
                <img src="img/images-removebg-preview.png" height="100" style="width: 164px;">
         </div>
         <div class='col-md-11 pt-3 text-white' style="">
                <marquee><h5 class="text-white"><?php echo $cntent;?></h5></marquee>
                
            </div>
            </div>
       
     
    
  
     
    
    <center><h3 class="mt-5 text-white">Search result</h3></center>
      <div class='table-responsive mt-2'>


            <table class='table' >
                        <tr style="
                        background: #f76767;">
                      <th class="text-white">Sno</th>
                      <th class="text-white">Name Of The Company</th>
                              <th class="text-white">Auction Items</th>
                      <th class="text-white">Auction Date</th>
              
                      <th class="text-white">Contact Details</th>
                      <th class="text-white">Auction price</th>
                      <th class="text-white">Attachment</th>
                       <th class="text-white">Attachment Name</th>
                      <th class="text-white">Action</th>
                    
                    </tr>

                        <?php 
                        
if($budget_value=='equal')
{
$clt_sl_netc_dtl="select * from create_sale where state_id='$stet_id' and property_type='$prty_ttyp' and Reserve_Price='$bedgt_ferm' and Start_Date_Auction > '$date_time' and End_Date_Auction > '$date_time'";
}
if($budget_value=='not_equal')
{
$clt_sl_netc_dtl="select * from create_sale where state_id='$stet_id' and property_type='$prty_ttyp' and Reserve_Price!='$bedgt_ferm' and Start_Date_Auction > '$date_time' and End_Date_Auction > '$date_time'";
}
if($budget_value=='less')
{
    $clt_sl_netc_dtl="select * from create_sale where state_id='$stet_id' and property_type='$prty_ttyp' and Reserve_Price < '$bedgt_ferm' and Start_Date_Auction > '$date_time' and End_Date_Auction > '$date_time'";
}
if($budget_value=='less_or_equal')
{
    $clt_sl_netc_dtl="select * from create_sale where state_id='$stet_id' and property_type='$prty_ttyp' and Reserve_Price < '$bedgt_ferm' or Reserve_Price = '$bedgt_ferm' and Start_Date_Auction > '$date_time' and End_Date_Auction > '$date_time'";
}

if($budget_value=='greater')
{
    $clt_sl_netc_dtl="select * from create_sale where state_id='$stet_id' and property_type='$prty_ttyp' and Reserve_Price > '$bedgt_ferm' and Start_Date_Auction > '$date_time' and End_Date_Auction > '$date_time'";
}

if($budget_value=='greater_or_equal')
{
    $clt_sl_netc_dtl="select * from create_sale where state_id='$stet_id' and property_type='$prty_ttyp' and Reserve_Price > '$bedgt_ferm' or Reserve_Price = '$bedgt_ferm' and Start_Date_Auction > '$date_time' and End_Date_Auction > '$date_time'";
}


if($budget_value=='between')
{
    $clt_sl_netc_dtl="select * from create_sale where state_id='$stet_id' and property_type='$prty_ttyp' and Reserve_Price BETWEEN '$bedgt_ferm' AND '$bedgt_to' and Start_Date_Auction > '$date_time' and End_Date_Auction > '$date_time'";
}

                        // $clt_sl_netc_dtl="select * from create_sale where Start_Date_Auction > '$date_time' and End_Date_Auction > '$date_time'";
                        $qst_clt_sl_netc_dtl=$db->query($clt_sl_netc_dtl);
                        $sno=1;
                       while($clct_clt_sl_netc_dtl=$qst_clt_sl_netc_dtl->fetch_assoc())
                        {

$asst_name=$clct_clt_sl_netc_dtl['Title'];
$lqdtr_id=$clct_clt_sl_netc_dtl['create_by_liquiditor_id'];
$sel_id=$clct_clt_sl_netc_dtl['id'];
$cmp_id=$clct_clt_sl_netc_dtl['company_id'];



$clt_cmp_dtl="select * from company where id='$cmp_id'";
$qst_clt_cmp_dtl=$db->query($clt_cmp_dtl);
$cclt_clt_cmp_dtl=$qst_clt_cmp_dtl->fetch_assoc();

$cmpny_nem=$cclt_clt_cmp_dtl['company_name'];


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

                  <tr style="border:1px solid #8a8a8a;background:white;">
                    <td><?php echo $sno++;?></td>
                    <td><?php echo $cmpny_nem;?></td>
                    <td><?php echo $asst_name;?></td>
                       <td><?php echo $end_det;?></td>
                    <td><?php echo $lqdter_nem;?></td>
                    <td><?php echo $rsrve_prec;?> ₹</td>
                  
                 
                    <td><a href='liquidator/sale_notice_pdf/<?php echo $pdfs;?>' traget="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;font-size: 25px;"></i></a></td>
                    <td><?php echo $pdfs;?></td>
                    <td><?php if(isset($_SESSION['bddr_id'])){?><a href='view_aution_details.php' class='btn btn-primary'>Bid</a><?php } else if(!isset($_SESSION['bddr_id'])){ ?> <a href='signup_bidder.php?ntc_id=<?php echo $sel_id;?>' class='btn btn-primary'>Bid</a><?php } ?></td>
                   
                
                
                
                
                
                
                
                </tr>
               <?php }?>


           </table>

  </div>
    </div>


	<div class="sticky-container">
		<ul class="sticky">
			<li>
				<img width="32" height="32" title="" alt="" src="img/fb1.png" / style="width:40px;">
				<p>Facebook</p>
			</li>
			<li>
				<img width="32" height="32" title="" alt="" src="img/tw1.png" / style="width:40px;">
				<p>Twitter</p>
			</li>
			<li>
				<img width="32" height="32" title="" alt="" src="img/pin1.png" / style="width:40px;">
				<p>Pinterest</p>
			</li>
			<li>
				<img width="32" height="32" title="" alt="" src="img/li1.png" / style="width:40px;" >
				<p>Linkedin</p>
			</li>
			<li>
				<img width="32" height="32" title="" alt="" src="img/rss1.png" / style="width:40px;">
				<p>RSS</p>
			</li>
			<li>
				<img width="32" height="32" title="" alt="" src="img/tm1.png" / style="width:40px;">
				<p>Tumblr</p>
			</li>
			<li>
				<img width="32" height="32" title="" alt="" src="img/wp1.png" / style="width:40px;">
				<p>WordPress</p>
			</li>
			<li>
				<img width="30" height="32" title="" alt="" src="img/vm1.png" / style="width:40px;">
				<p>Vimeo</p>
			</li>
		</ul>
	</div>
	 </div>
	    
<?php include_once "footer.php";?>
 
	<style type="text/css">
	body{
		/*height: 10000px;*/
		font-family: "Lato";
		background-color: #fffff;
	}
	.sticky-container{
		/*background-color: #333;*/
		padding: 0px;
		margin: 0px;
		position: fixed;
		right: -119px;
		top:230px;
		width: 200px;

	}

	.sticky li{
		list-style-type: none;
		background-color: #333;
		border-radius:30px;
		color: #efefef;
		height: 43px;
		padding: 0px;
		margin: 0px 0px 1px 0px;
		-webkit-transition:all 0.25s ease-in-out;
		-moz-transition:all 0.25s ease-in-out;
		-o-transition:all 0.25s ease-in-out;
		transition:all 0.25s ease-in-out;
		cursor: pointer;
 

	}

	.sticky li:hover{
		margin-left: -115px;
		/*-webkit-transform: translateX(-115px);
		-moz-transform: translateX(-115px);
		-o-transform: translateX(-115px);
		-ms-transform: translateX(-115px);
		transform:translateX(-115px);*/
		/*background-color: #8e44ad;*/
		filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'1 0 0 0 0, 0 1 0 0 0, 0 0 1 0 0, 0 0 0 1 0\'/></filter></svg>#grayscale");
                -webkit-filter: grayscale(0%);
	}

	.sticky li img{
		float: left;
		margin: 5px 5px;
		border-radius:30px;
		margin-right: 10px;

	}

	.sticky li p{
		padding: 0px;
		margin: 0px;
		text-transform: uppercase;
		line-height: 43px;

	}

	/** content **/
	.content{
		margin-top: 150px;
		margin-left: 100px;
		width: 700px;
	}
	h1, h2{
		font-family: "Source Sans Pro",sans-serif;
		color: #ecf0f1;
		padding: 0px;
		margin: 0px;
		font-weight: normal;
	}

	h1{
		font-weight: 900;
		font-size: 64px;
	}

	h2{
		font-size:26px;
	}

	p{
		color: #ecf0f1;
		font-family: "Lato";
		line-height: 28px;
		font-size: 15px;
		padding-top: 50px;
	}

	p.credit{
		padding-top: 20px;
		font-size: 12px;
	}

	p a{
		color: #ecf0f1;
	}

	/** fork icon**/
	.fork{
		position: absolute;
		top:0px;
		left: 0px;
	}
	</style>

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

<script>    
$(document).ready(function(){
$("#bdgt_vlu").change(function(){
var bdgt=$("#bdgt_vlu").val();



if(bdgt=='between'){
    
  $('#firstval').show();
  
}

else{

  $('#firstval').hide();
 
}

});

});

</script>


    











