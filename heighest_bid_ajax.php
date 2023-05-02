<?php 
include('admin/config/config.php');
$sls_id=$_POST['txt1'];
$sql=mysqli_query($db,"select * from create_sale where id='$sls_id'");
$result=mysqli_fetch_assoc($sql);


$actn_type=$result['auction_type'];
if($actn_type=="forward")
{
    $Incremental=$result['Incremental'];
}
else if($actn_type=="reverse")
{
    $Incremental=-$result['Incremental']; 
}



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




$clt_dtl="select * from livebidding  where salenotice_id='$sls_id'";
$qst_clt_dtl=$db->query($clt_dtl);
$clt_dtl_cnt=mysqli_num_rows($qst_clt_dtl);

if($clt_dtl_cnt==0)

{

$heighest_bid=0;//0; //yaha pe dikkat h
$reserve_price=$result['Reserve_Price'];
$bid_amnnt=$reserve_price;
$next_bid=$bid_amnnt+$Incremental;

echo json_encode(["status"=>1,"hgst_bbd"=>$heighest_bid,"heighest_bid_in_word"=>number_to_word($heighest_bid),"heighest_bid"=>"$heighest_bid ₹","next_bid"=>"$bid_amnnt ₹","next_bid_vl"=>$bid_amnnt,"next_bid_word"=>number_to_word($bid_amnnt),"bid_counst"=>"$heighest_bid"]);
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
    
    
    echo json_encode(["status"=>1,"hgst_bbd"=>$heighest_bid,"heighest_bid_in_word"=>number_to_word($heighest_bid),"heighest_bid"=>"$heighest_bid ₹","next_bid"=>"$bid_amnnt ₹","next_bid_vl"=>$bid_amnnt,"next_bid_word"=>number_to_word($bid_amnnt)]);
    
}
else if($actn_type=="reverse")
{
   

$clt_lv_bdng="select min(highestBid) as high_bid from livebidding where salenotice_id='$sls_id'";
$qst_clt_lv_bdng=$db->query($clt_lv_bdng);
$clct_clt_lv_bdng=$qst_clt_lv_bdng->fetch_assoc();

 $heighest_bid=$clct_clt_lv_bdng['high_bid'];

 $bid_amnnt=$heighest_bid+$Incremental;


echo json_encode(["status"=>1,"hgst_bbd"=>$heighest_bid,"heighest_bid_in_word"=>number_to_word($heighest_bid),"heighest_bid"=>"$heighest_bid ₹","next_bid"=>"$bid_amnnt ₹","next_bid_vl"=>$bid_amnnt,"next_bid_word"=>number_to_word($bid_amnnt)]);

}



}



?>