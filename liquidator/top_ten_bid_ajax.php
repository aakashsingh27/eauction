<?php 
include('config/config.php');
$sls_id=$_POST['txt1'];
?>
             <table class='table'>
                              <thead>
<tr>
<th scope='col'>Serial No.</th>
<!--<th scope='col'>UID</th>-->
<th scope='col'>Number of Ext</th>
<th scope='col'>Bid Price</th>
<th scope='col'>In Words</th>


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
$clt_lasdt_bd_dtl="select * from livebidding where salenotice_id='$sls_id' order by id desc";
$qst_clt_lasdt_bd_dtl=$db->query($clt_lasdt_bd_dtl);
while($clct_clt_lasdt_bd_dtl=$qst_clt_lasdt_bd_dtl->fetch_assoc())
{
$amnnt=$clct_clt_lasdt_bd_dtl['highestBid'];
$bdr_id=$clct_clt_lasdt_bd_dtl['bidder_fid'];
$nbr_of_extntn=$clct_clt_lasdt_bd_dtl['number_of_extension'];

$clt_bdr_dtl="select * from newbidder_login where id='$bdr_id'";
$qst_clt_bdr_dtl=$db->query($clt_bdr_dtl);
$clct_clt_bdr_dtl=$qst_clt_bdr_dtl->fetch_assoc();

$uuid=$clct_clt_bdr_dtl['uid'];


?>
<tr>
                                  <th scope='row'><?php echo $sno++;?></th>
                                  <!--<td><?php echo $uuid;?></td>-->
                                  <td><?php echo $nbr_of_extntn;?></td>
                                  <td><?php echo $amnnt;?></td>
                                  <td><?php echo number_to_word($amnnt);?></td>
                                  </tr>
                            <?php 
}
?>
                              </tbody>                
                </table>

    