<?php include 'connection.php';  ?>
<!DOCTYPE html>
<html>
<head>
	<title>GPCS</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<style type="text/css">
body{
	background-image: url('images/img.jpg');
	background-repeat: no-repeat;
	background-size: cover;
}
</style>
</head>
<body>
<form action="action.php" method="POST">
  <div class="container">
  	<div class="row">
  		<div class="col-md-6 heading" style="color:white">
  			<h1 class="text-center">Government Polytechnic College Sanawad</h1>
		<h4 class="text-center">Exam Hall Allocation System</h4>

    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
        
    <button type="submit" style="width:auto;">Login</button>
    <button onclick="document.getElementById('id01').style.display='block'"  style="width:auto;float: right;">Create User</button>
    <span class="psw" style="margin-right:10px;">Forgot <a href="forgetpass.php">password?</a></span>
  </div>
  </div>
  	</div>
</form>
    <div class="container"> 
    	<div class="row">
    		<div class="col-md-6 heading1">
    			<h3>Guided By :-</h3>
    			<p>Mr. Anil Mishra (H.O.D)</br>
   				   Computer Science</p>
    		</div>
       	<div class="col-md-6 heading2 text-right">
    		<h3>Created By :-</h3>
    		<table>
    				<tr><td>Ativeer Jain   16027C04010</td></tr> 
    				<tr><td>Satyam Geete   16027C04050</td></tr>
    				<tr><td>Jhankar Gadhwal 17027C04017</td></tr>
    				<tr><td>Janvi Khede     17027C04018</td></tr>
    				<tr><td>Tejaswani Jachpure   17027C04057</td></tr>
    				<tr><td>Gourav Patidar 16027C04018</td></tr>
    				<tr><td>Veeru Jogi     16027C04063</td></tr>
    		</table>
    	</div>
		</div>

<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
  <form class="modal-content" action="action_create.php" method="POST">
    <div class="container">
      <h1>Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>
      <label for="email"><b>User Name</b></label>
      <input type="text" placeholder="Enter User Name" id="txt_username" name="username" required>
	  <div id="uname_response" ></div>
      <label for="psw"><b>Password</b></label>
      <input type="password" id="password" placeholder="Enter Password" name="password" required>

      <label for="psw-repeat"><b>Repeat Password</b></label>
      <input type="text" id="confirm_password" placeholder="Repeat Password" name="confirm_password" required>
       <span id='message'></span><br>
      <label for="dob"><b>DOB</b></label>
      <input type="text" placeholder="DOB" name="dob" required>
      <label for="mobile"><b>Mobile</b></label>
      <input type="text" placeholder="Mobile" name="mobile" required>
      <div class="clearfix">
        <button type="submit" class="signupbtn">Sign Up</button>
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      </div>
    </div>
  </form>
</div>
</div>
<script>
$('#password, #confirm_password').on('keyup', function () {
  if ($('#password').val() == $('#confirm_password').val()) {
    $('#message').html('Matching').css('color', 'green');
  } else 
    $('#message').html('Password Not Matching').css('color', 'red');
});
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script>
$(document).ready(function(){

   $("#txt_username").keyup(function(){

      var username = $(this).val().trim();

      if(username != ''){

         $.ajax({
            url: 'ajex.php',
            type: 'post',
            data: {username: username},
            success: function(response){

                $('#uname_response').html(response);

             }
         });
      }else{
         $("#uname_response").html("");
      }
    });
 });
</script>
</body>
</html>
