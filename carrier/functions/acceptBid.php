<?php

require 'dbcon.php';

session_start();
$userId = $_SESSION['id'];

$acptBid = "UPDATE bidrepot SET status = '1' WHERE productid = AND bidder = ";
$runQuery = mysqli_query($conn, $acptBid);

if ($runquery) {
  // code...
  $rjctBid = "UPDATE bidrepot SET status = '2' WHERE productid = AND bidder != ";
  $runRjctQuery = mysqli_query($conn, $rjctBid);

  if ($runRjctQuery) {
    // code...
    echo '';
  }
  
}else {

}

 ?>
