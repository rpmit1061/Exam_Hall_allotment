<?php 
include('header.php'); ?>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script>
      $(function () {
        $('form').on('submit', function (e) {
            $("#loading1").show();
        });
      });
    </script>
<div class="container">
	<div class="row">
		<div class="col-md-6 text-center box">
			<h3>Upload File</h3>
			<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
				<table class="tab">
					<tr>
						<td><h4>Exam Name</h4></td>
						<td><input type="radio" value="May-June" required name="session"> May-June</td>
						<td>Year <select name="year" required>
							<option value="" >Select Year</option>
							<?php 
								for ($x = 2020; $x <= 2035; $x++) { ?>
								   <option value="<?php echo $x; ?>"> <?php echo $x; ?> </option>
								<?php }
							 ?>
						</select>
						</td>
						</tr>
					<tr><td></td>
						<td><input type="radio" value="Dec-Jan" required name="session"> Dec-Jan</td>
					</tr>
				</table>
				<table>
					<tr>
						<td><label for="text">Data Sheet</label></td>
						<td><input type="file" name="uploadFile" ></td>
						<td><button type="submit" name="submit"  >Upload</button></td>
						<!-- <td><button type="submit"   >Delete</button></td> -->
					</tr>
					<tr>
						<td><label for="text">Time Table</label></td>
						<td><input type="file"  name="uploadFile1"></td>
						<td><button type="submit"  name="submit1" >Upload</button></td>
						<!-- <td><button type="submit"  >Delete</button></td> -->
					</tr>
				</table>
    			<img id="loading1" src="images/3.gif" />
			  </form>

		</div>
		<div class="col-sm-1"></div>
		<div class="col-md-5 text-center  box">
			<?php 
			$sel ="SELECT DISTINCT session,year,filename FROM `user_details`";
			$sel1 ="SELECT DISTINCT session,year,filename FROM `timetable`";
				  $res = mysqli_query($con,$sel);
				  $res1 = mysqli_query($con,$sel1);
				  ?>
				  	<h3 calss="">Record</h3>
				  <div class="row">
				  <div class="col-md-6">
				   	<table class="record"> 
				   		<tr><th>RGPV Data</th></tr>
				 <?php while ($row = mysqli_fetch_array($res)) { ?>
						<tr>
							<td><?php echo $row['session']; ?><?php echo  $row['year']; ?></td> 
							<td><a onclick='javascript:confirmationDelete($(this));return false;' href="delete.php?filename=<?php echo urlencode($row['filename']); ?>&amp;year=<?php echo urlencode($row['year']); ?>&amp;session=<?php echo urldecode($row['session']); ?>">Delete</a></td> 
						</tr>
				  <?php } ?>
				   	</table> 
				  </div>
				  <div class="col-md-6">
				   	<table class="record"> 
				   		<tr><th>Time Table</th></tr>
				 <?php while ($row = mysqli_fetch_array($res1)) { ?>
						<tr>
							<td><?php echo $row['session']; ?><?php echo  $row['year']; ?></td> 
							<td><a onclick='javascript:confirmationDelete($(this));return false;' href="deleteti.php?filename=<?php echo urlencode($row['filename']); ?>&amp;year=<?php echo urlencode($row['year']); ?>&amp;session=<?php echo urldecode($row['session']); ?>">Delete</a></td> 
							<?php //echo $sel; ?>
						</tr>
				  <?php } ?>
				   	</table>
				  </div>
				</div>

		</div>
	</div>
</div>
			<?php
				if(isset($_POST['submit'])) {
					$session =$_POST['session'];
					$year =$_POST['year'];
					if(isset($_FILES['uploadFile']['name']) && $_FILES['uploadFile']['name'] != "") {
						$allowedExtensions = array("xls","xlsx");
						$ext = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);
						if(in_array($ext, $allowedExtensions)) {
							$file_size = $_FILES['uploadFile']['size'] / 1024;
							if($file_size < 1000) {
								$file = "uploads/".$_FILES['uploadFile']['name'];
								$isUploaded = copy($_FILES['uploadFile']['tmp_name'], $file);
								if($isUploaded) {
									include("Classes/PHPExcel/IOFactory.php");
									try {
										//Load the excel(.xls/.xlsx) file
										$objPHPExcel = PHPExcel_IOFactory::load($file);
									} catch (Exception $e) {
										die('Error loading file "' . pathinfo($file, PATHINFO_BASENAME). '": ' . $e->getMessage());
									}
									//An excel file may contains many sheets, so you have to specify which one you need to read or work with.
									$sheet = $objPHPExcel->getSheet(0);
									//It returns the highest number of rows
									$total_rows = $sheet->getHighestRow();
									//It returns the highest number of columns
									$highest_column = $sheet->getHighestColumn();
									$query = "insert into `user_details` (`session`,`year`,`filename`,`room_status`,`enrollment_no`, `firstname`, `fathername`, `mothername`,`gender`,`category`,`program_name`,`cource_code`,`cource_name`,`paper_code`,`sub_code`,`status`,`semester`,`papertype`) VALUES ";
									//Loop through each row of the worksheet
									for($row =2; $row <= $total_rows; $row++) {
										//Read a single row of data and store it as a array.
										//This line of code selects range of the cells like A1:D1
										$single_row = $sheet->rangeToArray('A' . $row . ':' . $highest_column . $row, NULL, TRUE, FALSE);
										
										//Creating a dynamic query based on the rows from the excel file
										$query .= "('$session','$year','$file','N',";
										//Print each cell of the current row
											$coun=0;
											$counto=0;
											$coun2=0;

										foreach($single_row[0] as $key=>$value) {
											//$value;
											if ($coun++== 0) {
												$value = substr($value,1,-1);
											}elseif ($counto++==8) {
												$value = substr($value,1,-1);
											}
											else{
												$value;
											}
											$query .= "'".mysqli_real_escape_string($con, $value)."',";
										}
										$query = substr($query, 0, -1);
										$query .= "),";
									}
									$query = substr($query, 0, -1);
									// At last we will execute the dynamically created query an save it into the database
									mysqli_query($con, $query);
									if(mysqli_affected_rows($con) > 0) {
										echo "<script>alert(\"Database updated successfully\")</script>"; 
										echo "<script>setTimeout(\"location.href = 'http://localhost/gpcs/uploadfile.php';\",500);</script>";
											} else {
										echo '<span class="msg">Can\'t update database table! try again.</span>';
										//echo $query;
										//echo $file_size;
									}
									// Finally we will remove the file from the uploads folder (optional) 
								} else {
									echo '<span class="msg">File not uploaded!</span>';
								}
							} else {
								echo '<span class="msg">Maximum file size should not cross 50 KB on size!</span>';	
							}
						} else {
							echo '<span class="msg">This type of file not allowed!</span>';
						}
					} else {
						echo '<span class="msg">Select an excel file first!</span>';
					}
				}
			
			?>
			<!-- for timetable -->
			<?php
				if(isset($_POST['submit1'])) {
					$session =$_POST['session'];
					$year =$_POST['year'];
					if(isset($_FILES['uploadFile1']['name']) && $_FILES['uploadFile1']['name'] != "") {
						$allowedExtensions = array("xls","xlsx");
						$ext = pathinfo($_FILES['uploadFile1']['name'], PATHINFO_EXTENSION);
						if(in_array($ext, $allowedExtensions)) {
							$file_size = $_FILES['uploadFile1']['size'] / 1024;
							if($file_size < 50) {
								$file = "timetable/".$_FILES['uploadFile1']['name'];
								$isUploaded = copy($_FILES['uploadFile1']['tmp_name'], $file);
								if($isUploaded) {
									include("Classes/PHPExcel/IOFactory.php");
									try {
										//Load the excel(.xls/.xlsx) file
										$objPHPExcel = PHPExcel_IOFactory::load($file);
									} catch (Exception $e) {
										die('Error loading file "' . pathinfo($file, PATHINFO_BASENAME). '": ' . $e->getMessage());
									}
									//An excel file may contains many sheets, so you have to specify which one you need to read or work with.
									$sheet = $objPHPExcel->getSheet(0);
									//It returns the highest number of rows
									$total_rows = $sheet->getHighestRow();
									//It returns the highest number of columns
									$highest_column = $sheet->getHighestColumn();
									$query = "insert into `timetable` (`session`,`year`,`filename`,`examdate`,`br_code`,`sem`,`subject`,`sub_code`,`paper_code`,`no_of_students`,`remark`) VALUES ";
									//Loop through each row of the worksheet
									for($row =2; $row <= $total_rows; $row++) {
										//Read a single row of data and store it as a array.
										//This line of code selects range of the cells like A1:D1
										$single_row = $sheet->rangeToArray('A' . $row . ':' . 'H' . $row, NULL, TRUE, FALSE);
										
										//Creating a dynamic query based on the rows from the excel file
										$query .= "('$session','$year','$file',";
										//Print each cell of the current row
											$counter=0;
										foreach($single_row[0] as $key=>$value) {
											if ($counter++== 0) {
												$format = "y-m-d";
   											 $value = date($format, PHPExcel_Shared_Date::ExcelToPHP($value)); 
											}else{
												$value;
											}
											$query .= "'".mysqli_real_escape_string($con, $value)."',";
										}
										$query = substr($query, 0, -1);
										$query .= "),";
									}
									$query = substr($query, 0, -1);
									// At last we will execute the dynamically created query an save it into the database
									mysqli_query($con, $query);
									if(mysqli_affected_rows($con) > 0) {
										echo "<script>alert(\"Database updated successfully\")</script>"; 
										echo "<script>setTimeout(\"location.href = 'http://localhost/gpcs/uploadfile.php';\",500);</script>";
											} else {
										echo '<span class="msg">Can\'t update database table! try again.</span>';
										echo $query;
									}
									
									// Finally we will remove the file from the uploads folder (optional) 
								} else {
									echo '<span class="msg">File not uploaded!</span>';
								}
							} else {
								echo '<span class="msg">Maximum file size should not cross 50 KB on size!</span>';	
							}
						} else {
							echo '<span class="msg">This type of file not allowed!</span>';
						}
					} else {
						echo '<span class="msg">Select an excel file first!</span>';
					}
				}
			
			?>
<script>
function confirmationDelete(anchor)
{
   var conf = confirm('Are you sure want to delete this record?');
   if(conf)
      window.location=anchor.attr("href");
}
</script>
<?php include 'footer.php'; ?>
			