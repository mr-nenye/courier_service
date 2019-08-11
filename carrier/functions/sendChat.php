
<?php

include 'dbcon.php';

$myMsg = $_POST['myMsg'];
$sender = $_POST['sender'];
$receiver = $_POST['receiver'];

$query = "INSERT INTO chats (sender, receiver, message, readStatus, timeStam) VALUES ('$sender', '$receiver', '$myMsg', '0', NOW())";
$run = mysqli_query($conn, $query);

if (!$run) {
  // code...
  echo "error: ".$conn->error;
}else {
  echo "message sent successfully";
}
 ?>
