<?php include_once 'header.php';  ?>
<?php include_once 'admin/config/config.php';  ?>


 
               <div class="container p-5">
                   <div class="row ">


                   
<h3 class="text-center" style="font-family: arial;">Bidding Info</h3>
<div class="col-lg-12">
    <div class="card  card-primary" style="
    border: none;
">
       
        <div class="card-body mb-3">
            <div class='table table-responsive'>
            <table class=" container table tabe-hover table-bordered mb-3" id="list">
                <!-- <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="25%">
                    <col width="25%">n
                    <col width="15%">
                </colgroup> -->
                <thead>
                    <tr style="font-family:arial;">
                     
                        <th>Title</th>
                  
                        
                        <th>Incremental Value</th>
                        <th>Reserve Price</th>
                        <th>Start Date Auction</th>
                       
                        <th>End Date Auction</th>
                        <th>PDF</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $qry = $db->query("SELECT * FROM create_sale");
                    while($row= $qry->fetch_assoc()):
                    ?>
                    <tr>
                       
                       
                        <td style="font-family:arial;"><?php echo $row['Title'];?></td>
                      
                        <td style="font-family:arial;"><?php echo $row['Incremental']; ?></td>
                        <td style="font-family:arial;"><?php echo $row['Reserve_Price']; ?></td>
                        <td style="font-family:arial;"><?php echo $row['Start_Date_Auction']; ?></td>
                        
                        <td style="font-family:arial;"><?php echo $row['End_Date_Auction']; ?></td>
<td style="font-family:arial;"><a href='liquidator/sale_notice_pdf/<?php echo $row['Pdf']; ?>' target='_blank' class="btn btn-warning" style="
    background:#ffc107b0;">View PDF</a></td>

                   
                      <!--   <button class='delete btn btn-sm btn-primary' id="id">Delete</button></td> -->
                        
                    </tr>   
                <?php endwhile; ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
<style>
    table td{
        vertical-align: middle !important;
    }
</style>

                   </div>
               </div>          

            <?php include_once "footer.php";?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

</body>

</html>