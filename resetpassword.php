<?php include 'connection.php'; 
session_start();
 $username = $_SESSION['username']; 
?>
<html>
<head>
	<title>New Password</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<body>
	<?php
if (isset($_POST['submit'])) 
	{
		$password = md5($_POST['password']);
		$con_password = md5($_POST['con_password']);
		$query = "UPDATE admin SET password = '$password', confirm_password= '$con_password' WHERE username ='$username'";
		$result = mysqli_query($con,$query);
		if ($result) {
			echo "<script>alert(\"Password Reset Successfully\")</script>";
			echo "<script>setTimeout(\"location.href = 'index.php';\",300);</script>";
		}
	}
	 ?>
<form action="" method="POST">
  <div class="container">
  	<div class="row">
  		<div class="col-md-12">
<?php 
echo $_SESSION['username']; 
?>
    <label for="uname"><b>New Password</b></label>
    <input type="password" placeholder="Password" name="password" required>
    <label for="psw"><b>Confirm New Password</b></label>
    <input type="password" placeholder="Confirm New Password" name="con_password" required>
    <input type="submit" name="submit" value="Reset Password">
  </div>
  </div>
  	</div>
</form>
</body>
</body>
</html>