<?php 
require ('connection.php');
session_start();
// If form submitted, insert values into the database.
if (isset($_POST['username'])){
        // removes backslashes
 $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
 $username = mysqli_real_escape_string($con,$username);
 $password = stripslashes($_REQUEST['password']);
 $password = mysqli_real_escape_string($con,$password);
 //Checking is user existing in the database or not
        $query = "SELECT * FROM `admin` WHERE username='$username'and password='".md5($password)."'";
 $result = mysqli_query($con,$query) or die(mysql_error());
 $rows = mysqli_num_rows($result);
        if($rows==1){
     $_SESSION['username'] = $username;
            // Redirect user to index.php
     header("Location: admin_deshboard.php");
         }else{
         	echo "<script>alert(\"User Name and password is incorrect\")</script>";
 			echo "<script>setTimeout(\"location.href = 'index.php';\",50);</script>";
 }
    } ?>