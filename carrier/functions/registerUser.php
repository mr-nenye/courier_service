<?php

include 'dbcon.php';

$role = $_POST['role'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$name = $_POST['name'];
$password = $_POST['password'];
$passRev = strrev($access_code); // passcode reversed
$hashKey = sha1($passRev); // for the hashed passcode

$makeUser = "INSERT INTO users(role, email, phone, name, password) VALUES ('$role', '$email', '$phone', '$name', '$password')";
$newUser = mysqli_query($conn, $makeUser);

if(!$newUser){
  // message for use already existing
  echo "<p class='--center alert alert-danger'> user already exist! </p>";
  echo "error: ".$conn->error;
}else{
  // header('location: dashboard.html');
}

 ?>
