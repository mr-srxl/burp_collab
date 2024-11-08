<?php

function generateRandomLengthString($n) {
  // Define the characters to use in the string
  $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  $randomString = '';

  // Generate a random length between 1 and n
  $randomLength = rand(1, $n);

  // Generate the random string of the chosen length
  for ($i = 0; $i < $randomLength; $i++) {
    $randomString .= $characters[rand(0, strlen($characters) - 1)];
  }

  return $randomString;
}

// Example usage
$n = 10; // Set the maximum length
$randomString = generateRandomLengthString($n);
$file = fopen('dir.txt', 'a');
fwrite($file, "$randomString\n");

function create_folder($name){
   mkdir($name);
   copy('add_req.php',$name.'/'.'add_req.php');


}
$x= $_SERVER['SERVER_NAME'];
create_folder($randomString);
$directoryName = basename(__DIR__);
echo "http://$x/$directoryName/$randomString/add_req.php" ;
?>