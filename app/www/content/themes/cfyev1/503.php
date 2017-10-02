<?php
$protocol = $_SERVER["SERVER_PROTOCOL"];
if ( 'HTTP/1.1' != $protocol && 'HTTP/1.0' != $protocol )
        $protocol = 'HTTP/1.0';
header( "$protocol 503 Service Unavailable", true, 503 );
header( 'Content-Type: text/html; charset=utf-8' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>CFYE will be right back!</title>
	<style>
	body {
		margin:0 auto;
		text-align:center;
	}
 img {
 	text-align:center;
 }
 </style>
 </head>
<body>
	 <img src="http://cfye.com/images/2011/07/CFYE_AD-665x900.jpg"/>
</body>

<?php die(); ?>