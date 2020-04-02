<?php include('header.php'); ?>
<?php 
$tab = "CREATE TABLE IF NOT EXISTS `examrooms` ( `id` INT(255) NULL AUTO_INCREMENT , `room_no` VARCHAR(255) NOT NULL , `no_row` VARCHAR(255) NOT NULL , `no_col` VARCHAR(255) NOT NULL , `total_cap` VARCHAR(255) NOT NULL ,`alot_seat` VARCHAR(255) NOT NULL,`remain_seat` VARCHAR(255) NOT NULL, PRIMARY KEY (`id`)) ENGINE = MyISAM";
mysqli_query($con, $tab);

if (isset($_POST['submit'])) {
$room_no = $_POST['room_no'];
$no_row = $_POST['no_row'];
$no_col = $_POST['no_col'];
$total_cap = $_POST['total_cap'];
$insert = "INSERT INTO `examrooms` (`room_no`,`no_row`,`no_col`,`total_cap`) VALUES ('$room_no','$no_row','$no_col','$total_cap')";
if (mysqli_query($con, $insert)) {
			    echo "<script>alert(\"Room Created successfully\")</script>";
			    echo "<script>setTimeout(\"location.href = 'admin_deshboard.php';\",800);</script>";
			} else {
			    echo "Error: " . $insert . "<br>" . mysqli_error($con);
			}
			mysqli_close($con);
}
 ?>
 <form action="" method="POST">
  <div class="container">
  	<div class="row">
  		<div class="col-md-12 text-center createroom">
  			<h4>Create New Room</h4>
    <label for="uname"><b>Room No</b></label>
    <input type="text" id="room_no" placeholder="Room No" onblur="avai()" name="room_no"  maxlength="2" minlength="2" required style="margin-left: 80px;">
	  <label id="room_response" ></label>
    <br>
    <label for="psw"><b>No. of Col</b></label>
    <input type="text" id="no_row" placeholder="No. Of Rows"  maxlength="2" minlength="2" onkeyup="total()" name="no_row" maxlength="2" required style="margin-left: 80px;"><br>
    <label for="psw"><b>No. of Rows</b></label>
    <input type="text" id="no_col" onkeyup="total()" placeholder="No. Of Col" maxlength="2" minlength="2" name="no_col" maxlength="2" required style="margin-left: 65px;"><br>
    <label for="psw" id="aviiii"><b>Total Capacity</b></label>
    <input type="text" id="totalcap" placeholder="Total Capacity" name="total_cap" readonly required style="margin-left: 45px;"><br>
    <button type="submit" id="btn" name="submit" disabled style="width:auto;">Save</button>
    <button type="reset" class="cancelbtn" style="width:auto;">Cancel</button>
    <a  href="admin_deshboard.php" class="backbtn"  style="width:auto;">Back</a>
    
  </div>
  </div>
  </div>
  	</div>
</form>
<script type="text/javascript">
function total() {
	var a = document.getElementById('no_row').value;
	var b = document.getElementById('no_col').value;
	var c = a*b;
	document.getElementById('totalcap').value = c;
}
</script>
<script>
$(document).ready(function(){

   $("#room_no").keyup(function(){

      var room_no = $(this).val().trim();

      if(room_no != ''){

         $.ajax({
            url: 'ajex1.php',
            type: 'post',
            data: {room_no: room_no},
            success: function(response){

                $('#room_response').html(response);

             }
         });
      }else{
         $("#room_response").html("");
      }
    });
 });
</script>
<script>
function avai(){
var a = document.getElementById("avi").innerHTML;
if(a=="Available"){
document.getElementById("btn").removeAttribute("disabled");
document.getElementById("btn").setAttribute("class","");
}
else if(a=="unavailable"){
document.getElementById("btn").setAttribute("disabled","disabled");
document.getElementById("btn").setAttribute("class","cancelbtn");
}}
</script>
<?php include 'footer.php'; ?>
