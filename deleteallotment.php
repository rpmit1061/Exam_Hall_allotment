<?php 
include("connection.php");
$date = $_GET['date'];
$paper_code = explode(",",$_GET['papercode']);

$del = "DELETE FROM `allotment` Where examdate='$date'";
$delquery = mysqli_query($con,$del);
foreach ($paper_code as $paper_codes) {
$update ="UPDATE `user_details` SET `room_status` = 'N' WHERE paper_code ='$paper_codes'";
$updatequery = mysqli_query($con,$update);
}
if ($delquery AND $updatequery) {
		echo "<script>alert(\"Allotment Deleted Successfully\")</script>";
		echo "<script>setTimeout(\"location.href = 'http://localhost/gpcs/allotment.php';\",8);</script>";

}
 ?>