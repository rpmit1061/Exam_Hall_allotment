<?php
function processDrpdown($roomno,$date) {
$con = mysqli_connect("localhost","root","","gpcs");
$sql="SELECT * FROM examrooms WHERE room_no = '$roomno'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
$total_cap =  $row['total_cap'];
$selco = "SELECT count(room_no) FROM allotment WHERE room_no='$roomno' AND examdate='$date'";
$selquery = mysqli_query($con,$selco);
$res = mysqli_fetch_array($selquery);
$count =  $res['count(room_no)'];
if ($count !=0 ) {
	echo $total_cap-$count;
}else{
	echo $total_cap;
}
mysqli_close($con);
}        
if ($_POST['dropdownValue']){
    //call the function or execute the code
    processDrpdown($_POST['dropdownValue'],$_POST['examdate']);
}
?>
