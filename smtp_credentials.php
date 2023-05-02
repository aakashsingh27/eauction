<?php
$clt_emnl_crdntl="select * from email_api_credentials where id='1'";
$qst_clt_emnl_crdntl=$db->query($clt_emnl_crdntl);
$clct_clt_emnl_crdntl=$qst_clt_emnl_crdntl->fetch_assoc();

$host_nem=$clct_clt_emnl_crdntl['host'];
$smtp_auth=$clct_clt_emnl_crdntl['smtp_auth'];
$smtp_secre=$clct_clt_emnl_crdntl['smtp_secure'];
$sent_emnl_usr_nem=$clct_clt_emnl_crdntl['email'];
$emnl_paswd=$clct_clt_emnl_crdntl['password'];
$from_emnll=$clct_clt_emnl_crdntl['from_mail'];
$port_numbber=$clct_clt_emnl_crdntl['port_number'];
?>