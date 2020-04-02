<?php include 'connection.php'; ?>
<html>
<head>
	<title>Forget Password</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<?php 
session_start();
if (isset($_POST['submit'])) {
$username = $_POST['username'];
$dob = $_POST['dob'];
$mobile = $_POST['mobile'];

$sel = "SELECT * FROM admin WHERE username='$username' AND dob='$dob' AND mobile='$mobile'";
$result = mysqli_query($con,$sel) or die(mysql_error());
$row = mysqli_num_rows($result);
if ($row==1) {
	$_SESSION['username'] = $username;
     header("Location: resetpassword.php");
}
else {
	echo "Details Does not Match";
}
}
 ?>
<body>
<form action="" method="POST">
  <div class="container">
  	<div class="row">
  		<div class="col-md-12">
		<h2>Reset Password</h2>
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>
    <label for="psw"><b>DOB</b></label>
    <input type="text" placeholder="DOB" name="dob" required>
     <label for="psw"><b>Mobile</b></label>
    <input type="text" placeholder="Mobile" name="mobile" required>
    <input type="submit" name="submit" value="Reset Password">
    <a href="index.php">Back</a>
  </div>
  </div>
  	</div>
</form>
</body>
</html>