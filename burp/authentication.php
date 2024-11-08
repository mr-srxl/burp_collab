<?php
        session_start();

       
        include('connection.php');  
        $username = $_POST['username'];  
        $password = $_POST['password'];  
          
            //to prevent from mysqli injection  
            $username = stripcslashes($username);  
            $password = stripcslashes($password);  
            $username = mysqli_real_escape_string($con, $username);  
            $password = mysqli_real_escape_string($con, $password);  
          
            $sql = "select *from accounts where username = '$username' and password = '$password'";  
            $result = mysqli_query($con, $sql);  
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $count = mysqli_num_rows($result);  
              
            if($count == 1){  
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
		        $_SESSION['name'] = $_POST['username'];
                header('Location: home.php');   
            }  
            else{  
                header('Location: fuck_you.html');  
            }     
    ?>  