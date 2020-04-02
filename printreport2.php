<?php
function processDrpdown($roomno,$date) {
$con = mysqli_connect("localhost","root","","gpcs");
$sql="SELECT * FROM examrooms WHERE room_no = '$roomno'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);					//order by enrollment_no ASC /
$selco = "SELECT * FROM allotment WHERE room_no='$roomno' AND examdate='$date' ";
$selquery = mysqli_query($con,$selco); 
$countrow = mysqli_num_rows($selquery);
?>
<?php 
if ($countrow == 0) {
		echo "There is no Room Allotment on this day on Selected Data";
}else{?>
<input type="button" class="logoutbtn" onclick="printDiv('printableArea')" value="Print" />
<div id="printableArea">
<div class="row" >
	<div Class="col-md-12 text-center">
		<h1>Govt Polytechnic College Sanawad</h1>
		<h2>Seating Arrangement</h2>
	</div>
	<div class="col-md-6 date"><h3 style="margin-bottom:15px">Date :-<input type="date" value="<?php echo $date; ?>" readonly style="border: none;
"></h3></div>
	<div class="col-md-6 date"><h3 style="margin-bottom:15px">Room No :- <?php echo $roomno; ?></h3></div>

<?php 	
$col = $row['no_row'];
$total_cap =  $row['total_cap'];
$ro = $row['no_col'];?>
<table class="tablecode">
<?php
$rows = ceil($countrow/$col); ?>
<table class="tablecode1" align="center">
	<tr id="top">
<?php 
for ($i=1; $i <= $col ; $i++) { 
	echo "<th>&nbsp;&nbsp;".$i."&nbsp;&nbsp;</th>";
} 

?>
</tr>

<?php
while ($res = mysqli_fetch_array($selquery)) 
$enroll[] = $res['enrollment_no'];

	echo '<tr>';
	foreach ($enroll as $i => $element) {
		if ($i > 0 && $i % $rows == 0) {
			echo '</tr><tr>';
		}
		echo '<td>'.$element . '</td>';
	}
	echo '</tr>';
echo "</table>";	
?>
</div>
<?php 
$selpap = "SELECT subject_code,COUNT(subject_code),br_code  FROM `allotment`WHERE room_no = '$roomno' AND examdate = '$date' GROUP BY subject_code";
$query = mysqli_query($con,$selpap);
function getsubject($sub)
{
$con = mysqli_connect("localhost","root","","gpcs");
$subsel ="SELECT subject FROM `timetable` WHERE paper_code = '$sub'";
$subquery = mysqli_query($con,$subsel);
$fatch = mysqli_fetch_array($subquery);
echo $fatch['subject'];
}

 ?>
<div class="summery-table">
	<table class="tablecode" style="margin-top:20px;font-size:20px;" align="center">
		<tr>
			<th>Branch</th>
			<th>Paper Code</th>
			<th>Subject Name</th>
			<th>No. Of Students</th>
		</tr>
		<?php $tot = 0;
		while ($pap = mysqli_fetch_array($query)) { ?>
		<tr>
			<td><?php echo $pap['br_code'] ?></td>
			<td><?php echo $pap['subject_code']; ?></td>
			<td><?php getsubject($pap['subject_code'])  ?></td>
			<td><?php echo $pap['COUNT(subject_code)']; ?></td>
		</tr>
		<?php $tot +=$pap['COUNT(subject_code)'];
	} ?>
		<tr> 
			<td colspan="3"><b>Total</b></td>
			<td><?php echo $tot; ?></td>
		</tr>
	</table>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 text-right" style="margin-top:50px"><h3>Exam Superintendent</h3></div>
	</div>
</div>

</div>
<input type="button" class="logoutbtn" onclick="printDiv('printableArea')" value="Print" />
<?php mysqli_close($con);
}  }      
if ($_POST['dropdownValue']){
    //call the function or execute the code
    processDrpdown($_POST['dropdownValue'],$_POST['examdate']);
}
?>
