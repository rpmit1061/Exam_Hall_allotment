<?php include('header.php');
function getalloted($va){
$con = mysqli_connect("localhost","root","","gpcs");
    $sql = "SELECT count(enrollment_no) FROM `user_details` WHERE papertype = 'Theory' AND room_status ='Y' AND paper_code ='$va' ORDER BY enrollment_no ASC";
    $sqlquery = mysqli_query($con,$sql);
    $ressql = mysqli_fetch_array($sqlquery);
    $valsql =  $ressql['count(enrollment_no)'];
    return $valsql;
}
?>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
$( document ).ready(function() {
  $("body").on("keyup", "input", function(event){
    var sum = 0;
    $('.total_price').each(function() {
        sum += Number($(this).val());
    });
    $(".grand_total").val(sum);
    if ($(".grand").val() < sum)
        {
            alert("Alloted Capacity is Greater Than Room Capacity.");
        };
  });
});
</script>

    <script>
      $(function () {

        $('form').on('submit', function (e) {
            $("#loading").show();
          e.preventDefault();
          $.ajax({
            type: 'post',
            url: 'insert.php',
            data: $('form').serialize(),
            success: function (data) {
              alert('Room Alloted Succesfully');
            $("#loading").hide();
            $("#result").html(data);
            }
          });
        });
      });
    </script>
        <script>
            $(document).ready(function(){
            $('#myDropDown').change(function(){
                //Selected value
                var inputValue = $(this).val();
                var date = $('#date').val();
                //alert("value in js "+date);

                //Ajax for calling php function
                $.post('capacity.php', { dropdownValue: inputValue , examdate : date}, function(data){
                    $('#showcapacity').val(data);
                    //do after submission operation in DOM
                });
            });
        });
        </script>
        <script type="text/javascript">
function valcheck(){
    var a = document.getElementById('disab').value;
    var b = document.getElementById('showcapacity').value;
if(a!=0 ){
document.getElementById("btn").removeAttribute("disabled");
document.getElementById("btn").setAttribute("class","");
}
else if(a==0){
document.getElementById("btn").setAttribute("disabled","disabled");
document.getElementById("btn").setAttribute("class","cancelbtn");
}}
</script>
<script>
function confirmationDelete(anchor)
{
   var conf = confirm('Are you sure want to delete this record?');
   if(conf)
      window.location=anchor.attr("href");
}
</script>
<?php ?>
<div class="sidenav">
<?php 
            $selroom ="SELECT * FROM `examrooms` ORDER BY room_no ASC";
                  $res = mysqli_query($con,$selroom);
                  if (!$res) {
                            printf("Error: %s\n", mysqli_error($con));
                            exit();
                        }
                        $rowtotal=0;
                        ?>
                    <div class="text-center" style="margin-top: 20px;">Available Rooms</div>

            <?php while ($row = mysqli_fetch_array($res)) { ?>
                  <div class="text-center" style="margin-top: 10px;">
                    <label style="color: crimson;">R.No :</label><?php  echo $row['room_no']; ?>
                    <label style="color: crimson;">Total Cap :</label><?php  echo  $row['total_cap']; ?>
                  </div>
            <?php $rowtotal += $row['total_cap'];
        }?>
<div class="text-center">Total : <?php echo $rowtotal; ?></div>
</div>
<form method="POST">
    
<div class="container">
	<div class="row box">
		<div class="col-md-12 text-center">
			<table align="center">
				<tr>
                    <tr>
                        <td> Exam Date</td>
                        <td><?php $date = $_GET['examdate']; ?>
                            <input type="date" id="date" class="selectroom" readonly style="width:80%" value="<?php echo $date; ?>" name="examdate">
                        </td>
                    </tr>
					<td><label>Room No</label></td>
					<td>
						<select class="selectroom" id="myDropDown" style="width:80%" name="room_no" required onchange="valcheck()">
				<option value="">Select Room</option>
				<?php
				$sel= "SELECT * FROM `examrooms` Order By room_no ASC";
				$result = mysqli_query($con, $sel); 

				while ($row = mysqli_fetch_array($result)) {
    				echo "<option value=".$row['room_no'].">".$row['room_no']."</option>";
   				 } ?>
			</select>
					</td>
				</tr>
				<tr>
					<td><label>Capacity</label></td>
					<td><input id="showcapacity"  class="grand selectroom" name="roomcap"  style="width:30%" readonly></td>
                    <td><a onclick='javascript:confirmationDelete($(this));return false;' href="deleteallotment.php?date=<?php echo $date; ?>&papercode=<?php echo implode(",",$_GET['paper_code']);  ?>" class="dele">Delete</a></td> 
                  
                </tr>
			</table>
			
  <table class="tablecode" align="center">
    	<tr>
    		<th>Paper Code</th>
    		<th>No of Student</th>
            <th>Alloted</th>
    		<th>Allot</th>
    	</tr>  
<?php   
$arrayName = array('paper_code' =>$_GET['paper_code'] ,
                    'no_of_students' =>$_GET['no_of_students']);

$totalallot = 0;
$noofstudent =0;
$check = count($_GET['paper_code']);
if(is_array($arrayName)) {
for($i = 0; $i < $check; $i++) {?>
    <?php 
    $nos = $_GET['no_of_students'][$i];
    $nosalloted = getalloted($_GET['paper_code'][$i]);
    $allow = $nos -$nosalloted;
    $readonly = "";
    if ($allow == 0) {
        $readonly = "readonly";
    }
    ?>
    	<tr>
            <td><input type="text" name="paper_code[]" readonly value="<?php echo $_GET['paper_code'][$i]; ?>"></td>
            <td><input type="text" name="no_of_students[]" value="<?php echo $_GET['no_of_students'][$i]; ?>"></td>
            <td><input type="text" value="<?php echo getalloted($_GET['paper_code'][$i]) ?>" readonly></td>
            <td>
            <input type="number" name="allot[]" <?php echo $readonly; ?> min="0" onkeyup="valcheck()" class="total_price" max="<?php echo($allow) ?>" value="0" id="allotment">
            </td>
            </span>
        </tr>
       
<?php   $noofstudent += $_GET['no_of_students'][$i];
        $allotstd = getalloted($_GET['paper_code'][$i]);
        $totalallot += $allotstd;
  }
}
?>
<input type="hidden" id="disab" class="grand_total">
    </table>
    <br>
    <div class="row">
        <div class="col-md-3">
        <?php 
        $remainstudents = $noofstudent-$totalallot;  ?>
        <label>Remaining Students For Allotment</label>
    <input type="text"  readonly name="remstudents" value="<?php echo $remainstudents; ?>">
    </div>
    <img id="loading" src="images/3.gif" />
    <div class="col-md-4">
        <button  class="logoutbtn" id="btn" name="submit1">Save</button>

    </div>
    <div class="col-md-4" style="margin: 28px;">
        <a href="http://localhost/gpcs/printreport.php" class="logoutbtn">Print Report</a>
    </div>
    </div>
</div>
</div>
</div>
</form>
<div id="result"></div>
