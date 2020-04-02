<?php
include('header.php'); ?>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
            $(document).ready(function(){
            $('#myDropDown').change(function(){
                //Selected value
                var inputValue = $(this).val();
                var date = $('#date').val();
                //alert("value in js "+date);

                //Ajax for calling php function
                $.post('printreport2.php', { dropdownValue: inputValue , examdate : date}, function(data){
                    $('#showcapacity').html(data);
                    //do after submission operation in DOM
                });
            });
        });
        </script>
        <script type="text/javascript">
        function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
     location.reload();
}
        </script>
<form method="POST">
<div class="container-fluid">
	<div class="row" style="background:white;">
		<div class="col-md-12 text-center">
            <h1>Print Report</h1>
			<table align="center">
				<tr>
                    <tr>
                        <td> Exam Date</td>
                        <td>
                            <input type="date" id="date" class="selectroom"  style="width:80%" name="examdate">
                        </td>
                    </tr>
					<td><label>Room No</label></td>
					<td>
						<select class="selectroom" id="myDropDown" style="width:80%" name="room_no" required >
				<option value="">Select Room</option>
				<?php
				$sel= "SELECT * FROM `examrooms`";
				$result = mysqli_query($con, $sel); 

				while ($row = mysqli_fetch_array($result)) {
    				echo "<option value=".$row['room_no'].">".$row['room_no']."</option>";
   				 } ?>
			</select>
					</td>
				</tr>
			</table>
			<div id="showcapacity"></div>
		</div>
	</div>
</div>
</form>

