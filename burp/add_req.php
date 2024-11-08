<?php

$current_url = $_SERVER['REQUEST_URI'];
$request_method = $_SERVER['REQUEST_METHOD'];

$metod = $_SERVER['SERVER_PROTOCOL'];
$path=$_SERVER['SCRIPT_NAME'];

$file = fopen('colab.txt', 'a');
fwrite($file, "$request_method $current_url $metod\n");
foreach (getallheaders() as $name => $value) {
    $file = fopen('colab.txt', 'a');
    
    fwrite($file, "$name: $value\n");
}
if ($request_method === 'POST') {
    $request_body = file_get_contents('php://input');
    
    fwrite($file,"$request_body\n");
}

$ipaddress = $_SERVER['REMOTE_ADDR'] . "\r\n";
fwrite($file, $ipaddress);
if (isset($_SERVER['HTTP_CLIENT_IP'])) {
   $ip = $_SERVER['HTTP_CLIENT_IP'] . "\r\n";
   fwrite($file, $ip);
}

if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
   $ip2 = $_SERVER['HTTP_X_FORWARDED_FOR'] . "\r\n";
   fwrite($file, $ip2);
}

?>
