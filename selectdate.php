<?php
include("connection.php");
$q = $_GET['date'];
$sql = "SELECT paper_code, COUNT(paper_code),SUM(no_of_students) from `timetable` WHERE examdate = '$q' GROUP BY paper_code";
$timequery = mysqli_query($con,$sql);
$norows = mysqli_num_rows($timequery);
function getpapercode($value){
$con = mysqli_connect("localhost","root","","gpcs");
    $sqlsel = "SELECT count(enrollment_no) FROM `user_details` WHERE papertype = 'Theory' AND paper_code ='$value' ORDER BY enrollment_no ASC";
    $query = mysqli_query($con,$sqlsel);
    $res = mysqli_fetch_array($query);
    $val = $res['count(enrollment_no)'];
    if ($val >0) {
    return $val;
    }
}
if ($norows == 0) {
	echo "<p>On Selected Date there is no Examination</P>";
 }else
 { ?>
 <form action="allotment2.php" method="GET">
 	<input type="hidden" name="examdate" value="<?php echo $q; ?>">
 <center>
 	<table class="tablecode">
		<tr>
			<th>Paper Code</th>
			<th>No of student</th>
		</tr>
<?php
 	$total = 0;
 		while($row = mysqli_fetch_array($timequery)) {
$tot = getpapercode($row['paper_code']);
 if ($tot>0) { ?>
			 	<tr>
			 		<td><input name="paper_code[]" readonly value="<?php echo $row['paper_code']; ?>"></td>
			 		<td><input name="no_of_students[]" readonly value="<?php echo $tot ?>" ></td>
			 	</tr>
<?php 
$total +=$tot;
} }?>
 <tr>
<td>Total</td>
<td>
		<input type="text" readonly value="<?php echo $total; ?>" name="remstudents" id="total">
		<input type="submit" class="logoutbtn" value="Next" name="submit">
</td>
 </tr>
<?php } ?>
 </table>
</center>
</form>