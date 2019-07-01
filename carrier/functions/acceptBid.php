<?php

require 'dbcon.php';

session_start();
$userId = $_SESSION['id'];
$accptId = $_POST['accptId'];
$bidderId = $_POST['bidderId'];

$acptBid = "UPDATE bidreport SET status = '1' WHERE productid = $accptId AND bidder = $bidderId";
$runQuery = mysqli_query($conn, $acptBid);

if ($runQuery) {
  // code...
  $rjctBid = "UPDATE bidreport SET status = '2' WHERE productid = $accptId AND bidder != $bidderId";
  $runRjctQuery = mysqli_query($conn, $rjctBid);

  if ($runRjctQuery) {
    // code...
    echo 'Bid accepted Successfully';
  } else {
    // code...
    echo "error: ".$conn->error;
  }

}else {
    echo "error: ".$conn->error;
}

 ?>
