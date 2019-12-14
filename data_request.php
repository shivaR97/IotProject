<?php
include ('includes/db-connect.php');
  date_default_timezone_set('Asia/Kolkata');
   $d = date("Y-m-d");
   //echo " Date:".$d."<BR>";
   $t = date("H:i:s");

   if(!empty($_GET['waterLevel']) && !empty($_GET['moisture']) ) {
     $waterLevel = $_GET['waterLevel'];
     $moist = $_GET['moisture'];

     $sql = "INSERT INTO log (waterLevel, moist, Date, Time) VALUES ('".$waterLevel."','".$moist."', '".$d."', '".$t."')";

   if (mysqli_query($conn,$sql)) {
       echo "OK";
   } else {
       echo "Error: " . $sql . "<br>" . $conn->error;
   }



 $conn->close();
}

?>
