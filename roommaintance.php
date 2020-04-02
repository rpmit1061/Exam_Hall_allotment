<?php
include('header.php'); ?>
<div class="container box" style="border: 1px solid; margin-top: 20px">
	<div class="row">
		<div class="col-md-12 text-center">
			<h4>Room Maintenance</h4>
		</div>
			<div class="col-md-6 text-center">
			<label>Create room for exam</label><br><br><a href="createroom.php" class="logoutbtn" >Create Room</a>
			</div>
			<div class="col-md-6 text-center">
			<label>Edit room Rows and column</label><br><br><a href="editroom.php" class="logoutbtn" >Edit Room</a>
			</div>
			<?php 
			$selroom ="SELECT * FROM `examrooms` ORDER BY room_no ASC";
				  $res = mysqli_query($con,$selroom);
				  if (!$res) {
						    printf("Error: %s\n", mysqli_error($con));
						    exit();
						}?>
					<div class="col-md-12 text-center" style="margin-top: 40px;"><h5>Available Rooms For Allotment</h5></div>

			<?php while ($row = mysqli_fetch_array($res)) { ?>
			 	  <div class="col-md-2 box text-center" style="margin-top: 40px;">
					<label style="color: crimson;">Room No :-</label><?php  echo $row['room_no']; ?>
					<label style="color: crimson;">Total Capacity : </label><?php  echo  $row['total_cap']; ?>
			 	  </div>
			<?php }
			 ?>
					
	</div>
</div>
<?php include 'footer.php'; ?>
