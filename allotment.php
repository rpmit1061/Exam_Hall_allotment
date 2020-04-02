<?php include('header.php'); 
$sql = "SELECT * FROM `timetable`";
$timequery = mysqli_query($con,$sql);
//session_start();
		// while ($row = mysqli_fetch_array($timequery)) 
		// { 
		// 	echo $row['session'];
		// }
?>
<div class="container ">
	<div class="row box">
		<div class="col-md-12 text-center">
			<h3>Please select date for Exam room allotment.</h3>
			<form>
				<input type="date" name="examdate" onchange="selectdate(this.value)" >
			</form>
		</div>
		<div id="txtHint" class="col-md-12 text-center">
		</div>
        <div class="col-md-12">
            
        </div>
	</div>
</div>
<script>
function selectdate(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","selectdate.php?date="+str,true);
        xmlhttp.send();
    }
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
function findTotal(){
    var arr = document.getElementsByName('qty');
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
    }
    document.getElementById('total').value = tot;
}

    </script>
<?php include 'footer.php'; ?>
