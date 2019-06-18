<?php

include 'dbcon.php';


session_start();
$userId = $_SESSION['id'];
$oppoBid = $_POST['oppoBid'];
$item_id = $_POST['item_id'];

$placeBid = "INSERT INTO bidreport (productid, bidder, biddatetime, bidamount, status) VALUES ('$item_id', '$userId', NOW(), '$oppoBid', '0')";
$runquery = mysqli_query($conn, $placeBid);

if (!$runquery) {
  // code...
  echo "error: ".$conn->error;
}else {
  echo "Item Uploaded Successfully";
}

 ?>
