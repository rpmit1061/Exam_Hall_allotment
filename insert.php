<?php 
include("auth.php");
include("connection.php");
$allot = $_POST['allot'];
$examdate = $_POST['examdate'];
$paper_code = $_POST['paper_code'];
$no_of_students = $_POST['no_of_students'];
$vari = array(	'paper_code' => $paper_code,
				'no_of_students' => $no_of_students );
$remstudents = $_POST['remstudents'];
$querystring = http_build_query($vari);
function getenrollmentno($value,$allot){
$con = mysqli_connect("localhost","root","","gpcs");
if ($allot != 0 AND $value !=0) {
    $sqlsel = "SELECT enrollment_no,cource_code,paper_code FROM `user_details` WHERE papertype = 'Theory' AND room_status ='N' AND paper_code ='$value' ORDER BY enrollment_no ASC LIMIT $allot";
    $query = mysqli_query($con,$sqlsel);
    while ($res = mysqli_fetch_array($query)) 
    $val[] =  array('enrollment_no' => $res['enrollment_no'],
    				'cource_code' => $res['paper_code'],
    				'paper_code' => $res['cource_code']);
	return $val;
    }}
    ?>
<?php 
$check = count($paper_code);
for($i = 0; $i < $check; $i++) 

$al[] = getenrollmentno($paper_code[$i],$allot[$i]);
var_dump($al);
$url = "http://localhost/gpcs/allotment2.php?examdate=$examdate&remstudents=$remstudents&" . $querystring;
$room_no = $_POST['room_no'];

$roomcap = $_POST['roomcap'];
$remstudents = $_POST['remstudents'];
$sum = array_sum($allot);
if ($roomcap <= $remstudents AND $sum == 0) {
	$counter = $roomcap;
}elseif($roomcap > $remstudents AND $sum == 0){
	$counter = $remstudents;
}elseif ($sum !== 0 AND $remstudents > $sum) {
	$counter = $sum;
}else{
	$counter = $remstudents;
}

 foreach ($al as $i => $element){

 	if (!is_null($element)) {
 		
 	
	foreach ($element as $rowValues) {
		$enroll = $rowValues['enrollment_no'];
		 $sub =   $rowValues['cource_code'];
		//var_dump($rowValues);
    foreach ($rowValues as $key => $rowValue) {
         $rowValues[$key] = mysqli_real_escape_string($con,$rowValues[$key]);
    	$rowValue;
    }

    $values[] = "('$room_no','$examdate','" . implode("','", $rowValues) . "')";
	$stdupdate = "UPDATE `user_details` SET room_status ='Y'  WHERE enrollment_no='$enroll' AND paper_code='$sub' AND papertype = 'Theory'";
	 $stdupdatequery = mysqli_query($con,$stdupdate);
}
}
}
 $query = "INSERT INTO allotment (room_no,examdate,enrollment_no,subject_code,br_code) VALUES ". implode (',', $values) . "";
	$sql = mysqli_query($con,$query);
if ($sql AND $stdupdatequery) {
			echo "<script>setTimeout(\"location.href ='$url';\",80);</script>";
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($con);
			}
			mysqli_close($con);
  ?>