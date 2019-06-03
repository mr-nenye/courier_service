<?php

include 'dbcon.php';


session_start();
// login script goes here
$email = $_POST['email'];
$password = $_POST['password'];

$getUser = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$runUser = mysqli_query($conn, $getUser);

if (mysqli_num_rows($runUser) > 0) {
  // code...
  $row=mysqli_fetch_array($runUser);

    // if checkbox is marked for cookies
    //if (isset($_POST['remember'])){
      //set up cookie
      //setcookie("user", $row['username'], time() + (86400 * 30));
      //setcookie("pass", $row['password'], time() + (86400 * 30));
    //}
    $_SESSION['id'] = $row['userid'];
    header('location: ../dashboard');

}else{
  echo "error: ".$conn->error;
}

 ?>
