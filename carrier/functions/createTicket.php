<?php

include 'dbcon.php';

$subject = $_POST['subject'];
$msg = $_POST['msg'];
$userPhone = $_POST['userPhone'];
$userEmail = $_POST['userEmail'];
$userName = $_POST['userName'];
$userId = $_POST['userId'];

$query = "INSERT INTO tickets (subject, message, ticketholderID, ticketholder, ticketphone, ticketemail, linkedTo,	dateCreated) VALUES ('$subject', '$msg', '$userId', '$userName', '$userPhone', '$userEmail', '0', NOW())";
$run = mysqli_query($conn, $query);

if (!$run) {
  // code...
  echo "error: ".$conn->error;
}else {
  echo "Item Uploaded Successfully";
}
 ?>
