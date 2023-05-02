<?php 
include('config/config.php');

date_default_timezone_set('Asia/Kolkata');
$current_time= date ('Y-m-d H:i:s'); 
$sls_id=$_POST['txt1'];

$sql=mysqli_query($db,"select * from create_sale where id='$sls_id'");
$result=mysqli_fetch_assoc($sql);

$start_date= $result['Start_Date_Auction'];
$end_date= $result['End_Date_Auction'];
$buffer_time=$result['buffer_time'];
$incrmnt_amnt=$result['Incremental'];
$nex_bid=$result['Reserve_Price'] +$incrmnt_amnt;
?>

<script>
     <?php   


    if($start_date<=$current_time and $end_date > $current_time)
{
   ?>
    var countDownDate = <?php echo strtotime($end_date) ?> * 1000;
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
            document.getElementById("demo").innerHTML = "Bid time is Over";
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