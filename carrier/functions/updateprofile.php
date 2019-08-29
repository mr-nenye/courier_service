<?php

include 'dbcon.php';

$name = $_POST['fname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$state = $_POST['state'];
$userId = $_POST['userId'];

$update = "UPDATE users SET  email = '$email', name = '$name', phone= '$phone', address = '$address', state = '$state' WHERE userid = '$userId' ";
$newUser = mysqli_query($conn, $update);

if(!$newUser){
  // message for use already existing
  echo "error: ".$conn->error;
}else{
  // header('location: dashboard.html');
  echo "error: ".$conn->error;
}


 ?>
