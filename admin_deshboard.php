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
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body style="background: azure;">
<div class="container box" style="border: 1px solid; margin-top: 40px">
	<div class="row">
		<div class="col-md-12 text-center">
			<h3>Government Polytechnic College Sanawad</h3>
			<h5>Exam Hall Allotment System</h5>
		</div>
		<div class="col-md-6">
 				<p>Welcome <?php echo $_SESSION['username']; ?>!</p>
		</div>
		<div class="col-md-6 text-right" style="margin-top: 20px;">
			   <a class="logoutbtn" href="logout.php">Logout</a>
			</p>
		</div>
		<hr style="border: .01em solid #000000;width: 100%;">
		<div class="col-md-3 text-center">
				<!-- <h4 style="margin-bottom: 30px;">Upload Files</h4> -->
			<label>Upload RGPV Excel files</label><br><br>
			<a href="uploadfile.php" class="logoutbtn" >Upload File</a>
		</div>
		<div class="col-md-3 text-center">
				<!-- <h4 style="margin-bottom: 30px;">Room Allotment</h4> -->
			<label>Room Maintanance</label><br><br>
			<a href="roommaintance.php" class="logoutbtn" >Room Maintanance</a>
		</div>
		<div class="col-md-3 text-center">
				<!-- <h4 style="margin-bottom: 30px;">Room Allotment</h4> -->
			<label>Allot Room to students</label><br><br>
			<a href="allotment.php" class="logoutbtn" >Room Allotment</a>
		</div>
		<div class="col-md-3 text-center">
				<!-- <h4 style="margin-bottom: 30px;">Room Allotment</h4> -->
			<label>Print Report</label><br><br>
			<a href="printreport.php" class="logoutbtn" >Print Report</a>
		</div>
	</div>
</div>

<!-- <div class="container box" style="border: 1px solid;margin-top: 20px;padding:40px;">
	<div class="row">
		<div class="col-md-6 text-center">
			<label>Upload RGPV Excel files</label><br><br><a href="uploadfile.php" class="logoutbtn" >Upload File</a>
		</div>
		<div class="col-md-6 text-center">
			<label>Allot Room to students</label><br><br><a href="allotment.php" class="logoutbtn" >Room Allotment</a>
		</div>
	</div>
</div> -->
<?php include 'footer.php'; ?>

