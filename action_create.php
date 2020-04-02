<?php 
require ('connection.php');
$tab = "CREATE TABLE IF NOT EXISTS `admin` ( `id` INT(255) NULL AUTO_INCREMENT , `username` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , `confirm_password` VARCHAR(255) NOT NULL , `dob` VARCHAR(255) NOT NULL , `mobile` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM";
mysqli_query($con, $tab);
$username = $_POST['username'];
$password = md5($_POST['password']);
$confirm_password = md5($_POST['confirm_password']);
$dob = $_POST['dob'];
$mobile = $_POST['mobile'];
$insert = "INSERT INTO `admin` (`username`,`password`,`confirm_password`,`dob`,`mobile`) VALUES ('$username','$password','$confirm_password','$dob','$mobile')";
if (mysqli_query($con, $insert)) {
			    echo "<center>Data Insert successfully</center>";
			echo "<script>setTimeout(\"location.href = 'index.php';\",800);</script>";
			} else {
			    echo "Error: " . $insert . "<br>" . mysqli_error($con);
			}
			mysqli_close($con);
?>