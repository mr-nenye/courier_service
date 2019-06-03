<?php

include 'dbcon.php';

function redirecUrl(){
  $_SESSION["redirectUrl"] = $_SERVER["REQUEST_URI"];
  $url = substr($_SESSION["redirectUrl"], 6);
  echo $url;
}

function authUser($role, $email, $password){
  global $conn;
  global $url;


  if (isset($_POST['loginBtn'])) {
    // code...
    session_start();
    // login script goes here
    $role = $_POST['role'];
    $email = $_POST['email'];
    $password = $_POST['password']; // original passcode
    $passRev = strrev($access_code); // passcode reversed
    $hashKey = sha1($passRev); // for the hashed passcode

    $getUser = "SELECT * FROM users WHERE role = '$role' AND email = '$email' AND password = '$password'";
    $runUser = mysqli_query($conn, $getUser);

    if (mysqli_num_rows($runUser) == 0) {
      // code...
      echo mysqli_num_rows($runUser);
      echo "<p class='--center alert alert-danger'> user not found! </p>";
      echo "error: ".$conn->error;
    }else{
      $row=mysqli_fetch_array($runUser);

        // if checkbox is marked for cookies
  			//if (isset($_POST['remember'])){
  				//set up cookie
  				//setcookie("user", $row['username'], time() + (86400 * 30));
  				//setcookie("pass", $row['password'], time() + (86400 * 30));
  			//}
        $_SESSION['id'] = $row['userId'];
  			header('location: dashboard.html');
    }
  }

}

function createUser($role, $email, $phone, $address, $password){
  global $conn;

  if (isset($_POST['createBtn'])) {
    // code...
    // create user goes here
    $role = $_POST['role'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $passRev = strrev($access_code); // passcode reversed
    $hashKey = sha1($passRev); // for the hashed passcode

    $makeUser = "INSERT INTO users(role, email, phone, address, password) VALUES ('$role', '$email', '$phone', '$address', '$password')";
    $newUser = mysqli_query($conn, $makeUser);

    if(!$newUser){
      // message for use already existing
      echo "<p class='--center alert alert-danger'> user already exist! </p>";
      echo "error: ".$conn->error;
    }else{
      header('location: dashboard.html');
    }
  }

}

function userNav(){
  global $conn;

  @session_start();

  if (isset($_SESSION['id'])) {
    // code...
    $query = "SELECT * FROM users WHERE userId = '".$_SESSION['id']."'";
  	$run = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($run)) {
      // code...
      $username = $row['username'];
      $phone = $row['user_phone'];

      echo '<div class="nav navbar-fixed-top ">
        <ul class="nav-left">
          <li> <a href="index"> Homepage </a> </li>
        </ul>
        <ul class="">';

          $getNotify = "SELECT * FROM message WHERE receiverID = '".$_SESSION['id']."' AND msg_read = 0";
          $runNotify = mysqli_query($conn, $getNotify);

          if (mysqli_num_rows($runNotify) > 0) {
            // code...
            echo '<li> <a href="message" class="notify-icon"> <i class="far fa-bell brand-color"></i> <span class="notify-color"></span> </a> </li>';
          }else{
            echo '<li> <a href="message" class="notify-icon"> <i class="far fa-bell brand-color"></i> </a> </li>';
          }

          echo '<li class="user">
            <a href="#" class="">
              <div class="circle center dp-holder"> <i class="usericon typcn typcn-user-outline" ></i> </div>
            </a>
            <ul class="dropdown">
              <li><a href="profile" class="txt-sm"> Profile </a></li>
              <li><a href="functions/logout" class="txt-sm"> Logout </a></li>
            </ul>
          </li>
          <li> <a href="add-item" class="actBtn"> <i class="fas fa-plus"></i> &nbsp;&nbsp;&nbsp; Create AD </a> </li>
        </ul>
      </div>';
      // <li> <a href="add-item" class="actBtn"> <i class="fas fa-plus"></i> &nbsp;&nbsp;&nbsp; Create AD </a> </li>
    }
  }else {
    // code...
    echo '<div class="nav navbar-fixed-top ">
      <ul class="nav-left">
        <li> <a href="index"> Homepage </a> </li>
      </ul>
      <ul class="">
        <li> <a href="login"> Login / Signup </a> </li>
        <li> <a href="add-item" class="actBtn"> <i class="fas fa-plus"></i> Create AD </a> </li>
      </ul>
    </div> ';
  }

  // <li>
  //   <form action="" method="post">
  //     <input placeholder="enter search here...">
  //   </form>
  // </li>

  // <span> '.$username.' </span>

}

function getProfileInfo() {
  global $conn;

  // session_start();

  if (isset($_SESSION['id'])) {
    // code...
    $query = "SELECT * FROM users WHERE userId = '".$_SESSION['id']."'";
  	$run = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($run)) {
      // code...
      $uname = $row['username'];
      $fname = $row['user_firstname'];
      $lname = $row['user_lastname'];
      $phone = $row['user_phone'];

      // count active post
      $result = mysqli_query($conn, "SELECT * FROM items WHERE userId = '".$_SESSION['id']."' AND item_status = 1");
      $rows = mysqli_num_rows($result);

      // count uploaded post
      $res = mysqli_query($conn, "SELECT * FROM items WHERE userId = '".$_SESSION['id']."'");
      $rec = mysqli_num_rows($result);

      echo '<div class="info-action">
        <div class="container">

          <h5 class="grtMsg"> Good day, <span class="brand-color">'.$uname.'</span> </h5> <br>
          <small class="grtText"> Welcome back to your account dashboard, <br> here are action you can perform on this profile </small> <br> <br>
          <a class="editBtn"> <i class="fas fa-pencil-alt"></i> &nbsp; edit profile </a>

        </div>
      </div>

      <div class="container">

        <p class="section-title"> Upload data </p>

        <div class="row">
          <div class="col s12 m3 l3">
            <div class="stat-box">
              <span class="detail-txt"> active ads </span>
              <p class="detail-stat"> '.$rows.' </p>
            </div>
          </div>
          <div class="col s12 m3 l3">
            <div class="stat-box">
              <span class="detail-txt"> total uploaded ads </span>
              <p class="detail-stat"> '.$rec.' </p>
            </div>
          </div>
        </div>

      </div>';
    }
  }else {
    // code...
    echo '<div class="nav navbar-fixed-top ">
      <ul class="nav-left">
        <li> <a href="index"> Homepage </a> </li>
      </ul>
      <ul class="">
        <li> <a href="login"> Login / Signup </a> </li>
        <li> <a href="add-item" class="actBtn"> <i class="fas fa-plus"></i> Create AD </a> </li>
      </ul>
    </div> ';
  }
}

function getUserItems() {
  global $conn;

  // session_start();

  $getItem = "SELECT * FROM items WHERE userId = '".$_SESSION['id']."'";
  $runItem = mysqli_query($conn, $getItem);

  if (mysqli_num_rows($runItem) > 0) {

    while ($row = mysqli_fetch_array($runItem)) {


      $ID  = $row["itemID"];
      $num = $row["item_xprice"];
      if ($num != "") {
        // code...
        $newNum = number_format($num);

        // echo "<div class='col s12 m4 l4'>
        //   <div class='item-card'>
        //     <div class='item-img'>
        //       <img src=".$row["item_img"]." style='width: 100%'>
        //     </div>
        //     <div class='item-card-footer'>
        //       <p> ".$row["item_name"]." </p>
        //       <p> <span class='item-class'>For ".$row["item_class"]."</span> <span class='right item-price'> &#8358; ".$newNum."</span> </p>
        //     </div>
        //   </div>
        // </div>";

        echo "<tr>
          <td><img src=".$row["item_img"]." class='responsive-img'></td>
          <td class='ad-name'>".$row["item_name"]."</td>
          <td>".$row["item_class"]."</td>
          <td class='ad-price'>".$newNum."</td>
          <td> <a class='actionBtn danger'> deactive </a>  <a class='actionBtn normal'> update </a> </td>
        </tr>";

      }else{
        // return $num;
        // echo "<div class='col s12 m4 l4'>
        //   <div class='item-card'>
        //     <div class='item-img'>
        //       <img src=".$row["item_img"]." style='width: 100%'>
        //     </div>
        //     <div class='item-card-footer'>
        //       <p> ".$row["item_name"]." </p>
        //       <p> <span class='item-class'>For ".$row["item_class"]."</span> <span class='right item-price'>".$num."</span> </p>
        //     </div>
        //   </div>
        // </div>";

        echo "<tr>
          <td><img src=".$row["item_img"]." class='responsive-img'></td>
          <td class='ad-name'>".$row["item_name"]."</td>
          <td>".$row["item_class"]."</td>
          <td class='ad-price'>".$num."</td>
          <td> <a class='actionBtn danger'> deactive </a>  <a class='actionBtn normal'> update </a> </td>
        </tr>";
      }


    }

  }else {
    // code...

  }
}

function getEditField() {
  global $conn;

  @session_start();

  if (isset($_SESSION['id'])) {
    // code...
    $query = "SELECT * FROM users WHERE userId = '".$_SESSION['id']."'";
  	$run = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($run)) {
      // code...
      $uname = $row['username'];
      $fname = $row['user_firstname'];
      $lname = $row['user_lastname'];
      $phone = $row['user_phone'];

      echo '<div class="row">
        <div class="col s12 m12 l12 form-handle">
          <input type="text" name="fname" value="'.$fname.'" placeholder="Enter first name" autocomplete="off">
        </div>
        <div class="col s12 m12 l12 form-handle">
          <input type="text" name="lname" value="'.$lname.'" placeholder="Enter last name" autocomplete="off">
        </div>
        <div class="col s12 m12 l12 form-handle">
          <input type="text" name="uname" value="'.$uname.'" placeholder="Enter user name" autocomplete="off">
        </div>
        <div class="col s12 m12 l12 form-handle">
          <input type="text" name="phoneNum" value="'.$phone.'" placeholder="Enter phone number" autocomplete="off">
        </div>
        <div class="col s12 m12 l12 form-handle center">
          <button type="submit" name="updateBtn" class="login-btn "> <i class=""></i>  Update </button>
        </div>
      </div>';
    }
  }else {
    // code...

  }
}

function editUser($fname, $lname, $uname, $phoneNum){
  global $conn;

  session_start();

  if (isset($_POST['updateBtn'])) {
    // code...
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['uname'];
    $phoneNum = $_POST['phoneNum'];

    $updtUser = "UPDATE users SET  user_firstname = '$fname', user_lastname = '$lname', username = '$uname', user_phone = '$phoneNum' WHERE userId = '".$_SESSION['id']."'";
    $runUpdtUser = mysqli_query($conn, $updtUser);

    if ($runUpdtUser) {
      // code...

    }else {
      // code...

      echo "error: ".$conn->error;
    }
  }


}


 ?>
