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