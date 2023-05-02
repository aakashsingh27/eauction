<?php 
include('admin/config/config.php');

date_default_timezone_set('Asia/Kolkata');
$current_time= date ('Y-m-d H:i:s'); 
$sls_id=$_POST['txt1'];

$sql=mysqli_query($db,"select * from create_sale where id='$sls_id'");
$result=mysqli_fetch_assoc($sql);
// print_r($result);
$start_date= $result['Start_Date_Auction'];
$end_date= $result['End_Date_Auction'];
$buffer_time=$result['buffer_time'];
$incrmnt_amnt=$result['Incremental'];
$nex_bid=$result['Reserve_Price'] +$incrmnt_amnt;
?>

<script>
     <?php   
  // echo $start_date;
  // echo $end_date;

    if($start_date<=$current_time and $end_date > $current_time)
{
   ?>
    var countDownDate = <?php echo strtotime($end_date) ?> * 1000;
    var now = <?php echo strtotime($start_date) ?> * 1000;

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get todays date and time
        // 1. JavaScript
        var now = new Date().getTime();
        // 2. PHP
        now = now + 1000;


        // Find the distance between now an the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
            minutes + "m " + seconds + "s ";

        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "Bid time is Over";
            window.location.href="result_modal.php?id=<?php echo $sls_id;?>";
        }
    }, 1000);
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