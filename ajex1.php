<?php
include("connection.php");

if(isset($_POST['room_no'])){
   $room_no = $_POST['room_no'];
   $query = "select count(*) as cntUser from examrooms where room_no='".$room_no."'";
   $result = mysqli_query($con,$query);
   $response = "<span id=".'avi'." style='color: green;margin-right: -71px;'>Available</span>";
   if(mysqli_num_rows($result)){
      $row = mysqli_fetch_array($result);
      $count = $row['cntUser'];
      if($count > 0){
          $response = "<span id=".'avi'." style='color: red;margin-right: -83px'>unavailable</span>";
      }
   }
   echo $response;
   die;
}