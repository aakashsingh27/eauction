<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description-gambolthemes" content="">
<meta name="author-gambolthemes" content="">

<title>Liquidator Panel</title>
<link href="css/styles.css" rel="stylesheet">
<link href="css/admin-style.css" rel="stylesheet">

<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

<link rel="stylesheet" href="css/typing.css">
<link rel="stylesheet" href="css/chat.css">

<link rel="stylesheet" href="cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/froala_editor.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/froala_style.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/code_view.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/colors.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/emoticons.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/image_manager.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/image.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/line_breaker.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/table.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/char_counter.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/video.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/fullscreen.css">
<link rel="stylesheet" href="vendor/froala_editor_3.1.1/css/plugins/file.css">
<link rel="stylesheet" href="cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style type="text/css">
.chatbox__button button {
visibility: hidden;
}


</style>

<style>
/*input[type=text]  {*/
/*border:1px solid black !important;*/
/*}*/

</style>


</head>

<?php 
$usr_eml=$_SESSION['a_email'];

$emp_id=$_SESSION['a_id'];

 $usr_dtl="select * from add_liquidator where liquidator_email='$usr_eml'";
$qst_usr_dtl=$db->query($usr_dtl);
$clct_usr_dtl=$qst_usr_dtl->fetch_assoc();


//$emp_id=$clct_usr_dtl['id'];

?>
<?php 
$usr_eml=$_SESSION['a_email'];

//$emp_id=$_SESSION['a_id'];

$sb_lqdtr_id=$_SESSION['sub_liquidator_id'];

$usr_dtl="select * from sub_liquidator where id='$sb_lqdtr_id'";
$qst_usr_dtl=$db->query($usr_dtl);
$clct_usr_dtl=$qst_usr_dtl->fetch_assoc();
$usr_nme=$clct_usr_dtl['name'];

//$emp_id=$clct_usr_dtl['id'];
//if($usr_typ=='1')
//{
?>

<body id="body" class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-light bg-clr">
<!--<a class="navbar-brand logo-brand" href="index.php"><span style="color:red">Welcome</span> <?php echo $usr_nme?></a>-->
<button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i onclick="myFunction()" class="fas fa-bars"></i></button>

  <a class="navbar-brand logo-brand" href="index.php"><span style="color:red">Welcome</span> <?php echo $usr_nme?></a>
<ul class="navbar-nav ml-auto mr-md-0">
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
<!-- <a class="dropdown-item admin-dropdown-item" href="edit_profile.php">Edit Profile</a> -->
  <?php 
  /*if($usr_typ==1)
  {*/
  ?>

<a class="dropdown-item admin-dropdown-item" href="ch_pwd.php">Change Password</a>
  <?php //} ?>
  <a class="dropdown-item admin-dropdown-item" href="logout.php">Logout</a>
</div>
</li>
</ul>
</nav>

<script>
function myFunction() {
var body = document.getElementById("body");
if (body.className == "sb-nav-fixed") {
body.classList.add("sb-nav-fixed");
body.classList.add("sb-sidenav-toggled");
} else {
body.classList.remove("sb-nav-fixed");
body.classList.remove("sb-sidenav-toggled");
body.classList.add("sb-nav-fixed");
}
}
</script>

<div id="layoutSidenav">
<div id="layoutSidenav_nav">




<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
<div class="sb-sidenav-menu">
<div class="nav">
<a class="nav-link active" href="index.php">
<div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
Dashboard
</a>




<!--<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutsdfs" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Sale Notice
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLayoutsdfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
<a class="nav-link sub_nav_link" href="create_sale_notice.php">Create A Sale Notice</a>
<a class="nav-link sub_nav_link" href="view_sale_notice.php">View Sale Notice</a>



</nav>
</div>


<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutdssdfs" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Bidders
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLayoutdssdfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
    
    <a class="nav-link sub_nav_link" href="add_bidders.php">Add Bidders</a>
    <a class="nav-link sub_nav_link" href="vw_bidders.php">View Bidders</a>




</nav>
</div>











<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouddtdssdfs" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Assigned Company
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLayouddtdssdfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
<a class="nav-link sub_nav_link" href="vw_asgn_cmpy.php">View Assigned Company</a>




</nav>
</div>



<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayodddutdssdfs" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Assigned A Bidders
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLayodddutdssdfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
<a class="nav-link sub_nav_link" href="assign_bidder_to_a_company.php">Assign Bidders To A Company</a>
<a class="nav-link sub_nav_link" href="assg_bddr_multiple.php">Assign Multiple Bidders To A Company</a>
<a class="nav-link sub_nav_link" href="view_assigned_bidders.php">View Assigned Bidders to A Company</a>



</nav>
</div>
-->












<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayosdfutdssdfs" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Live Bidding
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLayosdfutdssdfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
<a class="nav-link sub_nav_link" href="vw_livebidding.php">View live bidding </a>




</nav>
</div>











<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutdssdddsfs" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Closed Bid
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLayoutdssdddsfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
<a class="nav-link sub_nav_link" href="vw_clsed_bd.php">View Closed Bid </a>




</nav>
</div>






<!--<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutdssssdddsfs" aria-expanded="false" aria-controls="collapseLayouts">-->
<!--<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>-->
<!--Bidders Request-->
<!--<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>-->
<!--</a>-->
<!--<div class="collapse" id="collapseLayoutdssssdddsfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">-->
<!--<nav class="sb-sidenav-menu-nested nav">-->
<!--<a class="nav-link sub_nav_link" href="view_bdr_rqst.php">View Bidders Request </a>-->
<!--<a class="nav-link sub_nav_link" href="view_exstng_bdr_rqst.php">View Existing Bidders Request</a>-->

<!--</nav>-->
<!--</div>-->



<!--<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutdasdssdddsfs" aria-expanded="false" aria-controls="collapseLayouts">-->
<!--<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>-->
<!--Sub Users   -->
<!--<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>-->
<!--</a>-->
<!--<div class="collapse" id="collapseLayoutdasdssdddsfs" aria-labelledby="headingOne" data-parent="#sidenavAccordion">-->
<!--<nav class="sb-sidenav-menu-nested nav">-->
<!--<a class="nav-link sub_nav_link" href="ad_sb_lqdtr.php">Add Sub Users </a>-->
<!--<a class="nav-link sub_nav_link" href="vww_sb_lqdtr.php">View Sub users </a>-->
<!--</nav>-->
<!--</div>-->

<!--

<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Result
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
<a class="nav-link sub_nav_link" href="add_rslt.php">Add Result</a>
<a class="nav-link sub_nav_link" href="view_rslt.php">View Result</a>



</nav>
</div>








<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLdddddayouts" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
testimonials
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLdddddayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
<a class="nav-link sub_nav_link" href="add_tstmnl.php">Add Testimonials</a>
<a class="nav-link sub_nav_link" href="view_tstmnl.php">View testimonials</a>



</nav>
</div>










<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Enquiry
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapsseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">

<a class="nav-link sub_nav_link" href="view_prdt_enq.php">View Enquiry</a>



</nav>
</div>





<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsseLayaouts" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Hairfall Solution
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapsseLayaouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">

<a class="nav-link sub_nav_link" href="header_page.php?id=1">Messo Therapy</a>
<a class="nav-link sub_nav_link" href="header_page.php?id=2">Paltelet Rich plasma</a>
<a class="nav-link sub_nav_link" href="header_page.php?id=3">Scalp Monothreds</a>
<a class="nav-link sub_nav_link" href="header_page.php?id=4">Hair fall Laser Therapy </a>



</nav>
</div>














<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsseLayffffaouts" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Hair Transplant
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapsseLayffffaouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">

<a class="nav-link sub_nav_link" href="header_page.php?id=5">FUE hair Transplant</a>
<a class="nav-link sub_nav_link" href="header_page.php?id=6">Bio FUE hair Transplant</a>
<a class="nav-link sub_nav_link" href="header_page.php?id=7">FUT hair Transplant</a>
<a class="nav-link sub_nav_link" href="header_page.php?id=8">Direct Implant </a>



</nav>
</div>








<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsseLayfffSfaouts" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Laser
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapsseLayfffSfaouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">

<a class="nav-link sub_nav_link" href="header_page.php?id=9">Facial Hair Reduction</a>
<a class="nav-link sub_nav_link" href="header_page.php?id=10">Under Arm hair laser</a>
<a class="nav-link sub_nav_link" href="header_page.php?id=11">Full Body Laser</a>
<a class="nav-link sub_nav_link" href="header_page.php?id=12">Bikni line laser</a>



</nav>
</div>










<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsseLayfffSSSSfaouts" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
SKIN CARE
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapsseLayfffSSSSfaouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">

<a class="nav-link sub_nav_link" href="header_page.php?id=13">Skin Lightning </a>
<a class="nav-link sub_nav_link" href="header_page.php?id=14">Acne treatment laser</a>
<a class="nav-link sub_nav_link" href="header_page.php?id=15">Lip Lightning</a>
<a class="nav-link sub_nav_link" href="header_page.php?id=16">Moles Tag Removal</a>



</nav>
</div>














<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsseLayfffSSSS888faouts" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
MEDI FACIAL
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapsseLayfffSSSS888faouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">

<a class="nav-link sub_nav_link" href="header_page.php?id=17">HYDRA FACIAL </a>
<a class="nav-link sub_nav_link" href="header_page.php?id=18">CO2O2 FACIAL</a>
<a class="nav-link sub_nav_link" href="header_page.php?id=19">CARBON FACIAL</a>
<a class="nav-link sub_nav_link" href="header_page.php?id=20">DIAMOND DERMABRASION</a>

</nav>
</div>










<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsseLayfffSS999SSS888faouts" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
ANTI AGENING
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapsseLayfffSS999SSS888faouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">

<a class="nav-link sub_nav_link" href="header_page.php?id=21">Vampire face lift </a>
<a class="nav-link sub_nav_link" href="header_page.php?id=22">BOTOX</a>
<a class="nav-link sub_nav_link" href="header_page.php?id=23">FILLERS</a>
<a class="nav-link sub_nav_link" href="header_page.php?id=24">RF MICRO NEEDLING</a>

</nav>
</div>








<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsseLayadasdfffSS999SSS888faouts" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
PIGMENTATION
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapsseLayadasdfffSS999SSS888faouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">

<a class="nav-link sub_nav_link" href="header_page.php?id=25">Chemical Peels</a>
<a class="nav-link sub_nav_link" href="header_page.php?id=26">Q-Switch laser</a>
<a class="nav-link sub_nav_link" href="header_page.php?id=27">Dermaplaning</a>
<a class="nav-link sub_nav_link" href="header_page.php?id=28">Crystal Dermabrasion</a>

</nav>
</div>









<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsseLaysdfadasdfffSS999SSS888faouts" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Other
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapsseLaysdfadasdfffSS999SSS888faouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">

<a class="nav-link sub_nav_link" href="header_page.php?id=29">Tattoo Removal</a>
<a class="nav-link sub_nav_link" href="header_page.php?id=30">Stretch Marks Removal</a>
<a class="nav-link sub_nav_link" href="header_page.php?id=31">skin Lightning</a>
<a class="nav-link sub_nav_link" href="header_page.php?id=32">Hyperhidrosis</a>

</nav>
</div>



















<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapssdsfeLayaouts" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Gallery
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapssdsfeLayaouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
    
<a class="nav-link sub_nav_link" href="ad_glry_hdr_img.php">Gallery Header Image</a>
<a class="nav-link sub_nav_link" href="ad_phto.php">Add Photo</a>
<a class="nav-link sub_nav_link" href="vw_phto.php">View View photo</a>

<a class="nav-link sub_nav_link" href="ad_vd_glry.php">Add Video</a>
<a class="nav-link sub_nav_link" href="vw_vd_glry.php">View Video</a>



</nav>
</div>














<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapssdsfeLdddayaouts" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Frenchise
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapssdsfeLdddayaouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
<a class="nav-link sub_nav_link" href="vw_frnchs_hdr_img.php">Add Frenchise Header</a>
<a class="nav-link sub_nav_link" href="vw_frnchs.php">View Frenchise</a>
<a class="nav-link sub_nav_link" href="vw_frnch_enqry.php">View Frenchise Enquiry</a>

</nav>
</div>





<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapssdsfedddLdddayaouts" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Job
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapssdsfedddLdddayaouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">

<a class="nav-link sub_nav_link" href="ad_jb_hdr_img.php">Add job header image</a>    

<a class="nav-link sub_nav_link" href="ad_jb_tp_cnt.php">Add job Top Content</a>

<a class="nav-link sub_nav_link" href="ad_jb_crnt_opng.php">Add Current Opening</a>
<a class="nav-link sub_nav_link" href="vw_jb_crnt_opng.php">View Current Opening</a>

<a class="nav-link sub_nav_link" href="vw_jb_apl_cndt.php">View Job Applied</a>
</nav>
</div>














<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapssdsfedddLsdfghjkdddayaouts" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Contact
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapssdsfedddLsdfghjkdddayaouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
<a class="nav-link sub_nav_link" href="vw_cnt.php">View Contact us</a>

</nav>
</div>










<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapssdsfeddddddLsdfghjkdddayaouts" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Our Products
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapssdsfeddddddLsdfghjkdddayaouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">
    <a class="nav-link sub_nav_link" href="our_prdt_hdr_img.php">our products header image</a>
<a class="nav-link sub_nav_link" href="add_prdt.php">Add Products</a>
<a class="nav-link sub_nav_link" href="view_prdt.php">View Products</a>

</nav>
</div>











<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collap888ssdsfeddddddLsdfghjkdddayaouts" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Orders
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collap888ssdsfeddddddLsdfghjkdddayaouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">

<a class="nav-link sub_nav_link" href="view_orddrs.php">View Orders</a>

</nav>
</div>
  
  
  
  
  
  
  

<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collap888ssdsfeddddddLsdfghjddddddkdddayaouts" aria-expanded="false" aria-controls="collapseLayouts">
<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
Offers baner
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collap888ssdsfeddddddLsdfghjddddddkdddayaouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav">

<a class="nav-link sub_nav_link" href="view_ofr_bnr.php">View Offers banner</a>

</nav>
</div>
  
  
  
-->
  
  
  









</div>
</div>
</nav>
<?php 
//}
?>


</div>