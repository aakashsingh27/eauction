<?php
@ob_start();
//session_start();
require_once 'config/config.php';
date_default_timezone_set("Asia/Kolkata");
$cr_dt_ymd=date('Y-m-d');

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

$comp_select = $db->query("SELECT * FROM `admin`");
$comp_fetch = $comp_select->fetch_object();
$a_company = $comp_fetch->a_company;
$check_a_name = $_SESSION['a_name'];

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php include 'header.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<?php
$sql = "SELECT * FROM blog";
if ($result = mysqli_query($db, $sql)) {
$rowcount = mysqli_num_rows($result);
// echo "The total number of rows are: " . $rowcount;
}
?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<h2 class="mt-30 page-title" style="
    color: red;
    font-size: 30px;
    font-weight: 600;
">Add Refferal Amount</h2>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active"></li>
</ol>
<div class="container-fluid">


<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
<div class="form-group col-md-12 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Choose User*</label>
<select name="usr_nme" id="ddsd" class="form-control"  style="font-size: 20px !important;font-weight: 600 !important;border: 2px solid grey!important;border-radius: 15px !important;" required>
    <option>Choose User </option>
    <?php 
    
    $usr_dtl="select * from users where user_password!=''";
    $qst_usr_dtl=$db->query($usr_dtl);
    while($clct_usr_dtl=$qst_usr_dtl->fetch_assoc())
    {
        $uu_id=$clct_usr_dtl['user_id'];
        $uu_name=$clct_usr_dtl['user_name'];
        $uu_eml=$clct_usr_dtl['user_email'];
        $uu_mbl=$clct_usr_dtl['user_mobile'];
        $usr_wldt_amt=$clct_usr_dtl['wallet_amount'];
    ?>
    
    <option value="<?php echo $uu_id?>"><?php echo $uu_name?> (<?php echo $uu_eml ?>)--(<?php echo $uu_mbl ?>) (Wallet Amount-- <?php echo $usr_wldt_amt?>)</option>
    
    
    <?php 
    }
    ?>
    </select>
</div>

<div class="form-group col-md-12 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Add Bonus Amount*</label>
<input type="text" name="bns_amnt" class="form-control" placeholder="Enter Bonus Amount" style="font-size: 11px !important;font-weight: 600 !important;border: 1px solid grey!important;der-radius: 15px !important; */" required>
</div>

<div class="form-group col-md-12">

<button type='submit' name="submit" class='btn btn-primary'>Submit</button>
</div>
</div>
</form>


<?php 
if(isset($_POST['submit']))
{

$emp_nem=$_POST['usr_nme'];
$plan_price=$_POST['bns_amnt'];

$razorpay_payment_id = "xyz";
$razorpay_order_id = "abc";
$razorpay_signature = "abcs";



$uxr_mbl_dtl="select * from users where user_id='$emp_nem'";
$qst_uxr_mbl_dtl=$db->query($uxr_mbl_dtl);
$clct_uxr_mbl_dtl=$qst_uxr_mbl_dtl->fetch_assoc();

$user_mobile=$clct_uxr_mbl_dtl['user_mobile'];


//my code start


$profile=$db->query("SELECT * FROM users WHERE user_mobile='$user_mobile' ");
$fetch_payment=$profile->fetch_assoc();
$user_email=$fetch_payment['user_email'];
$join_by_refferal=$fetch_payment['join_by_refferal'];
$invite_code=$fetch_payment['invite_code'];
$user_id=$fetch_payment['user_id'];
$wallet_amount=$fetch_payment['wallet_amount'];


$pay_date = date('Y-m-d h:i:s');


$checkt_refferal=$db->query("SELECT * FROM users WHERE invite_code='$join_by_refferal'");
$fetch_ref=$checkt_refferal->fetch_assoc();
$ref_user_id_amount=$fetch_ref['user_id'];
$ref_user_amount=$fetch_ref['wallet_amount'];
$invite_abhishek=$fetch_ref['invite_code'];
$jn_by_rf_cd_b=$fetch_ref['join_by_refferal'];


$chek_refferal_b=$db->query("SELECT * FROM users WHERE invite_code='$jn_by_rf_cd_b'");
$fetch_ref_b=$chek_refferal_b->fetch_assoc();
$ref_user_b_id_amount=$fetch_ref_b['user_id'];
 $ref_user_b_amount=$fetch_ref_b['wallet_amount'];
 $ref_jnn_by_rff_id=$fetch_ref_b['join_by_refferal'];



//A User id fetch start
$chek_refferal_aaa=$db->query("SELECT * FROM users WHERE invite_code='$ref_jnn_by_rff_id'");
$fetch_ref_aaa=$chek_refferal_aaa->fetch_assoc();
$ref_user_a_id=$fetch_ref_aaa['user_id'];
$wallet_knh=$fetch_ref_aaa['wallet_amount'];
$wallet_knh_join=$fetch_ref_aaa['join_by_refferal'];


$chek_refferal_arvin=$db->query("SELECT * FROM users WHERE invite_code='$wallet_knh_join'");
$fetch_ref_arvin=$chek_refferal_arvin->fetch_assoc();
$ref_user_arvin_id=$fetch_ref_arvin['user_id'];
$wallet_knh=$fetch_ref_arvin['wallet_amount'];
$wallet_arvin_join=$fetch_ref_arvin['join_by_refferal'];


$chek_refferal_jitndr=$db->query("SELECT * FROM users WHERE invite_code='$wallet_arvin_join'");
$fetch_ref_jitndr=$chek_refferal_jitndr->fetch_assoc();
$ref_user_jitndr_id=$fetch_ref_jitndr['user_id'];
$wallet_jitndr=$fetch_ref_jitndr['wallet_amount'];
$wallet_jitdr_join=$fetch_ref_jitndr['join_by_refferal'];

$chek_refferal_sam=$db->query("SELECT * FROM users WHERE invite_code='$wallet_jitdr_join'");
$fetch_ref_sam=$chek_refferal_sam->fetch_assoc();
$ref_user_sam_id=$fetch_ref_sam['user_id'];
$wallet_sam=$fetch_ref_sam['wallet_amount'];
$wallet_sam_join=$fetch_ref_sam['join_by_refferal'];
//A User id fetch End

$checkt_trasaction=$db->query("SELECT * FROM online_payment WHERE client_id='$user_id'");
$row = mysqli_num_rows($checkt_trasaction);
 
 //Intial Stage start
 if($row==0){
    if($join_by_refferal!=NULL)
    {
         $presentage_ref_user=$plan_price*25/100;
         $wallet_amt_ref=$ref_user_amount+$presentage_ref_user;
         
          $presentage_user=$plan_price*25/100;
         $wallet_amt_ref1=$plan_price+$presentage_user;
         $order = $db->query("INSERT INTO online_payment(payment_id, order_id,signature_hash,client_id,amount,pay_date) VALUES ('$razorpay_payment_id','$razorpay_order_id','$razorpay_signature','$user_id','$plan_price','$pay_date')");
         $wallet_user_ref = $db->query("UPDATE users SET wallet_amount='$wallet_amt_ref' WHERE user_id='$ref_user_id_amount'");
         
         $wallet_user = $db->query("UPDATE users SET wallet_amount='$wallet_amt_ref1' WHERE user_id='$user_id'");
       
         $refferal_history=$db->query("INSERT INTO refferal_history (user_id,refferal_code,join_code,add_amont,profit_amount,total_amount,join_by_user_amt) VALUES('$user_id','$invite_code','$join_by_refferal','$plan_price','$presentage_user','$wallet_amt_ref1','$presentage_ref_user') ");
         
         $refferal_history=$db->query("INSERT INTO refferal_history (user_id,refferal_code,join_code,add_amont,profit_amount,total_amount,join_by_user_amt) VALUES('$user_id','$invite_abhishek','$jn_by_rf_cd_b','$plan_price','$presentage_user','$wallet_amt_ref1','$presentage_ref_user') ");
         
              
         //A->B->C refferal link start
         
          $presentage_abc_ref_user=$plan_price*10/100;
          $ref_user_b_amount_frr=$presentage_abc_ref_user+$ref_user_b_amount;
          
           $wallet_user_ref = $db->query("UPDATE users SET wallet_amount='$ref_user_b_amount_frr' WHERE user_id='$ref_user_b_id_amount'");
         
      $reffers_history=$db->query("INSERT INTO refferal_history (user_id,refferal_code,join_code,add_amont,profit_amount,total_amount,join_by_user_amt) VALUES('$user_id','$jn_by_rf_cd_b','$ref_jnn_by_rff_id','$plan_price','$presentage_user','$wallet_amt_ref1','$presentage_abc_ref_user') ");
    
         
         //A->B->C refferal link end
         
              
         //A->B->C->D refferal link start
         
          $presentage_abcd_ref_user=$plan_price*5/100;
          $ref_user_bd_amount_frr=$presentage_abcd_ref_user+$wallet_knh;
          
           $wallet_user_ref = $db->query("UPDATE users SET wallet_amount='$ref_user_bd_amount_frr' WHERE user_id='$ref_user_a_id'");
         
         $reffers_history=$db->query("INSERT INTO refferal_history (user_id,refferal_code,join_code,add_amont,profit_amount,total_amount,join_by_user_amt) VALUES('$user_id','$ref_jnn_by_rff_id','$wallet_knh_join','$plan_price','$presentage_user','$wallet_amt_ref1','$presentage_abcd_ref_user') ");
    
         //A->B->C->D refferal link end
         
         
          //A->B->C->D->E refferal link start
         
          $presentage_abcd_ref_arvin=$plan_price*3/100;
          $ref_user_arvin_wallet=$presentage_abcd_ref_arvin+$wallet_knh;
          
           $wallet_user_ref = $db->query("UPDATE users SET wallet_amount='$ref_user_arvin_wallet' WHERE user_id='$ref_user_arvin_id'");
         
         $reffers_history=$db->query("INSERT INTO refferal_history (user_id,refferal_code,join_code,add_amont,profit_amount,total_amount,join_by_user_amt) VALUES('$user_id','$wallet_knh_join','$wallet_arvin_join','$plan_price','$presentage_user','$wallet_amt_ref1','$presentage_abcd_ref_arvin') ");
    
       //A->B->C->D->E refferal link end
         
        
        
              //A->B->C->D->E->F refferal link start
              $presentage_abcd_ref_jitndr=$plan_price*2/100;
          $ref_user_jitndr_wallet=$presentage_abcd_ref_jitndr+$wallet_jitndr;
          
           $wallet_user_ref = $db->query("UPDATE users SET wallet_amount='$ref_user_jitndr_wallet' WHERE user_id='$ref_user_jitndr_id'");
         
         $reffers_history=$db->query("INSERT INTO refferal_history (user_id,refferal_code,join_code,add_amont,profit_amount,total_amount,join_by_user_amt) VALUES('$user_id','$wallet_arvin_join','$wallet_jitdr_join','$plan_price','$presentage_user','$wallet_amt_ref1','$presentage_abcd_ref_jitndr') ");
          //A->B->C->D->E->F refferal link end
    
              //A->B->C->D->E->F->G refferal link start
         
          $presentage_abcd_ref_sam=$plan_price*2/100;
          $ref_user_sam_wallet=$presentage_abcd_ref_sam+$wallet_sam;
          
           $wallet_user_ref = $db->query("UPDATE users SET wallet_amount='$ref_user_sam_wallet' WHERE user_id='$ref_user_sam_id'");
         
         $reffers_history=$db->query("INSERT INTO refferal_history (user_id,refferal_code,join_code,add_amont,profit_amount,total_amount,join_by_user_amt) VALUES('$user_id','$wallet_jitdr_join','$wallet_sam_join','$plan_price','$presentage_user','$wallet_amt_ref1','$presentage_abcd_ref_sam') ");
    
         //A->B->C->D->E->F->G refferal link end
         
         
    
      echo '<script>alert("Payment Done Successfully");window.location="";</script>';
        
        
         
    }
    elseif($join_by_refferal==NULL)
    {
     
     
      $presentage_ref_user=$plan_price*25/100;
         $wallet_amt_ref=$ref_user_amount+$presentage_ref_user;
         
          $presentage_user=$plan_price*25/100;
         $wallet_amt_ref1=$plan_price+$presentage_user;
         $order = $db->query("INSERT INTO online_payment(payment_id, order_id,signature_hash,client_id,amount,pay_date) VALUES ('$razorpay_payment_id','$razorpay_order_id','$razorpay_signature','$user_id','$plan_price','$pay_date')");
   
         
         $wallet_user = $db->query("UPDATE users SET wallet_amount='$wallet_amt_ref1' WHERE user_id='$user_id'");
       
         $refferal_history=$db->query("INSERT INTO refferal_history (user_id,refferal_code,add_amont,profit_amount,total_amount) VALUES('$user_id','$invite_code','$plan_price','$presentage_user','$wallet_amt_ref1') ");
      echo '<script>alert("Payment Done Successfully");window.location="";</script>';
       
    }

 }
 //Initial Satge End
 
 //level 0 start  10%
 
 
  if($row > 0){
    if($join_by_refferal!=NULL)
    {
         $presentage_ref_user=$plan_price*10/100;
         $wallet_amt_ref=$ref_user_amount+$presentage_ref_user;
         
          $presentage_user=$plan_price*10/100;
          
         $wallet_amt_ref1=$plan_price+$presentage_user+$wallet_amount;
         $order = $db->query("INSERT INTO online_payment(payment_id, order_id,signature_hash,client_id,amount,pay_date) VALUES ('$razorpay_payment_id','$razorpay_order_id','$razorpay_signature','$user_id','$plan_price','$pay_date')");
         $wallet_user_ref = $db->query("UPDATE users SET wallet_amount='$wallet_amt_ref' WHERE user_id='$ref_user_id_amount'");
         
         $wallet_user = $db->query("UPDATE users SET wallet_amount='$wallet_amt_ref1' WHERE user_id='$user_id'");
       
         $refferal_history=$db->query("INSERT INTO refferal_history (user_id,refferal_code,join_code,add_amont,profit_amount,total_amount,join_by_user_amt) VALUES('$user_id','$invite_code','$join_by_refferal','$plan_price','$presentage_user','$wallet_amt_ref1','$presentage_ref_user') ");
      echo '<script>alert("Payment Done Successfully");window.location="";</script>';
        
         
    }
    elseif($join_by_refferal==NULL)
    {
     
     
      $presentage_ref_user=$plan_price*10/100;
         $wallet_amt_ref=$ref_user_amount+$presentage_ref_user;
         
          $presentage_user=$plan_price*10/100;
             $wallet_amt_ref1=$plan_price+$presentage_user+$wallet_amount;
         $order = $db->query("INSERT INTO online_payment(payment_id, order_id,signature_hash,client_id,amount,pay_date) VALUES ('$razorpay_payment_id','$razorpay_order_id','$razorpay_signature','$user_id','$plan_price','$pay_date')");
   
         
         $wallet_user = $db->query("UPDATE users SET wallet_amount='$wallet_amt_ref1' WHERE user_id='$user_id'");
       
         $refferal_history=$db->query("INSERT INTO refferal_history (user_id,refferal_code,add_amont,profit_amount,total_amount) VALUES('$user_id','$invite_code','$plan_price','$presentage_user','$wallet_amt_ref1') ");
      echo '<script>alert("Payment Done Successfully");window.location="";</script>';
       
    }
 }
 


//my code end


}
?>


</div>
</div>
</main>




<?php include 'footer.php'; 
?>


<script>
$(document).ready(function() { 
 $("#ddsd").select2();
});
</script>
<?php
ob_flush();

?>