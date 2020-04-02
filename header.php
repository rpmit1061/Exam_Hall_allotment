<?php
include("auth.php");
include("connection.php");
?>
<html>
<head>
	<title>GPCS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body style="background: azure;">
<div class="container">
	<div class="row" style="box-shadow: 5px 5px 14px;padding: 9px;background: white;">
		<div class="col-md-12 text-center">
			<h3>Government Polytechnic College Sanawad</h3>
			<h5></h5>
		</div>
		<div class="col-md-4" style="margin-top: 20px;">
			<a  href="admin_deshboard.php" class="logoutbtn"  style="width:auto;">Back</a>
		</div>
		<div class="col-md-4 text-center" style="margin-top: 20px;">
 			<p>Welcome <?php echo $_SESSION['username']; ?>!</p>
		</div>
		<div class="col-md-4 text-right" style="margin-top: 20px;">
			   <a class="logoutbtn" href="logout.php">Logout</a>
			</p>
		</div>
	</div>
</div>