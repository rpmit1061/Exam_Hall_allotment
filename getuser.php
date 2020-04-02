<?php
include("connection.php");
$q = $_GET['room_no'];
$sql="SELECT * FROM examrooms WHERE room_no = '$q'";
$result = mysqli_query($con,$sql);


while($row = mysqli_fetch_array($result)) {
    echo "<label><b>No. of Col</b></label>";
    echo "<input id=".'no_row'." value=". $row['no_row'] ."  onkeyup=".'total()'." name=".'no_row'." required style=".'margin-left:80px;'."><br>";
    echo "<label><b>No. of Rows</b></label>";
    echo "<input id=".'no_col'." value=". $row['no_col'] ."   onkeyup=".'total()'." name=".'no_col'." required style=".'margin-left:65px;'."><br>";
 	echo "<label><b>Total Capacity</b></label>";
    echo "<input id=".'totalcap'." value=". $row['total_cap'] ." name=".'total_cap'." readonly required style=".'margin-left:45px'."><br>";

 }

mysqli_close($con);
?>
</body>
</html>