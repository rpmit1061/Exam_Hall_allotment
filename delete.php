<?php 
include("connection.php");
$q = $_GET['filename'];
$q1 = $_GET['year'];
$sess = $_GET['session'];
$sqlu="DELETE FROM user_details WHERE session = '$sess' AND year = $q1";
if (mysqli_query($con,$sqlu)) {
				unlink($q);
				// echo $sqlu;
			echo "<script>setTimeout(\"location.href = 'http://localhost/gpcs/uploadfile.php';\",8);</script>";
			}
?>