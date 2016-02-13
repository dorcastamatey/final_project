<?php
include("adb.php");
$verify=new adb();
$passkey=$_REQUEST['passkey'];
$select="SELECT * users WHERE passkey='$passkey'";
$result=$verify->query($select);
if(mysql_num_rows($result==1)){
	echo "you have already activated";
}
else
{
$select="SELECT * users WHERE passkey='$passkey' AND active =0";
$result=$verify->query($select);	
if(mysql_num_rows($result)==1){
	$update="UPDATE users SET active=1 WHERE passkey='$passkey'";
	$result=$verify->query($update);
	echo"login successful";
	header(sprintf("refresh:6; url=%s",login.html));
else
	echo"you are not in the system";
}
}



?>