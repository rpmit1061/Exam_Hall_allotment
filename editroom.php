<?php include('header.php'); ?>
<?php 
$sel= "SELECT * FROM `examrooms` Order By room_no ASC";
$result = mysqli_query($con, $sel);

if (isset($_POST['submit'])) {
$room_no = $_POST['room_no'];
$no_row = $_POST['no_row'];
$no_col = $_POST['no_col'];
$total_cap = $_POST['total_cap'];

$update = "UPDATE `examrooms` SET no_row ='$no_row',no_col ='$no_col', total_cap ='$total_cap' WHERE room_no ='$room_no'";
if (mysqli_query($con, $update)) {
			    echo "<script>alert(\"Room Details updated successfully\")</script>";
			    echo "<script>setTimeout(\"location.href = 'editroom.php'\",800);</script>";
			    
			// echo "<script>setTimeout(\"location.href = 'index.php';\",800);</script>";
			} else {
			    echo "Error: " . $update . "<br>" . mysqli_error($con);
			}
}
if (isset($_POST['delete1'])) {
$room_no = $_POST['room_no'];

$del = "DELETE FROM `examrooms` WHERE room_no ='$room_no'";
if (mysqli_query($con, $del)) {
			    echo "<script>alert(\"Room Delete successfully\")</script>";
			    echo "<script>setTimeout(\"location.href = 'editroom.php'\",800);</script>";
			    
			// echo "<script>setTimeout(\"location.href = 'index.php';\",800);</script>";
			} else {
			    echo "Error: " . $update . "<br>" . mysqli_error($con);
			}
}
 ?>

<script>
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getuser.php?room_no="+str,true);
        xmlhttp.send();
    }
}
</script>
<form action="" method="POST">
  <div class="container">
  	<div class="row">
  		<div class="col-md-12 text-center createroom">
  			<h4>Edit Room Details</h4>
  			<p><b>Please Select the Room Number for update there value or Delete Room</b></p>
    <label for="uname"><b>Room No</b></label>
    <select class="selectroom" name="room_no" onchange="showUser(this.value)">
    	<option>Select Rooms</option>
    <?php while ($row = mysqli_fetch_array($result)) {
    	echo "<option >".$row['room_no']."</option>";
    } ?>
</select>
    <br>
    <div id="txtHint">
	</div>
    <!--  -->
    <button type="submit" id="btn" name="submit" style="width:auto;">Save</button>
    <button type="submit" class="cancelbtn" name="delete1" style="width:auto;">Delete</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<?php include 'footer.php'; ?>
