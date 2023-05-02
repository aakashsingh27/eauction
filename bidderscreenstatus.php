<?php include_once "header.php";?>




    <div class="container">
                   <div class="row">


                    <?php include'db_connect.php' ?>
<h3>Bidder Status</h3>
<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
           
        </div>
        <div class="card-body mb-3">
            <table class=" container table tabe-hover table-bordered mb-3" id="list">
                <!-- <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="25%">
                    <col width="25%">n
                    <col width="15%">
                </colgroup> -->
                <thead>
                    <tr>
                      
                        <th>id</th>
                        <th>Bidder Status</th>
                        
                     
                        <th>Bidder Guid</th>
                                
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $qry = $conn->query("SELECT * FROM bidder_status");
                    while($row= $qry->fetch_assoc()):
                    ?>
                    <tr>
                       
                        <td class=""><b><?php echo $row['id'] ?></b></td>
                        <td><b><?php echo ucwords($row['bid_status']) ?></b></td>
                    
                     
                       
                        <td><b><?php echo ucwords($row['bidder_guid']) ?></b></td>
                        
                        
                        
                   
                        
                       
                    </tr>   
                <?php endwhile; ?>
                </tbody>
            </table>
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