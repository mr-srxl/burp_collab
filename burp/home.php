<?php
// We need to use sessions, so you should always start sessions using the below code.

session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Srxl</h1>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Home Page</h2>
			<p>Welcome back, <?=htmlspecialchars($_SESSION['name'], ENT_QUOTES)?>!</p>
                       <button onclick="runPHPFile()">Create</button>
                       <button onclick="removefile()">Clean</button>
                       <button onclick="readFile()">Read File</button>
                        
  <script>
    function readFile() {
      const responseDiv = document.getElementById('response');
      const divText = responseDiv.textContent;
      const newStr = divText.replaceAll("add_req.php", "colab.txt");
 if (newStr.endsWith('colab.txt')) { 
  fetch(newStr)
   .then(response => {
    if (response.ok) { // Check for successful response
     return response.text(); 
    } else {
     throw new Error('File not found or error fetching data');
    }
   })
   .then(data => {
    document.getElementById('File').innerHTML = "<pre>" + data + "</pre>";
   })
   .catch(error => {
    
    document.getElementById('File').innerHTML = 'There is no request';
   });
 } else {
  document.getElementById('File').innerHTML = 'Invalid file path.';
 }
}
    function removefile(){
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'remove.php', true);
      xhr.send();
      document.getElementById('response').innerHTML = "";
    }
    function runPHPFile() {
      // Make an AJAX request to the PHP file
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'folder_php.php', true);
      xhr.send(); 
      xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
          console.log(xhr.responseText);
          document.getElementById('response').innerHTML = xhr.responseText;
        } else {
          console.error('Request failed with status:', xhr.status);
        }
      };
    }
  </script>

  <div id="response"></div>
  
    <div id="File"></div>

	</body>
</html>