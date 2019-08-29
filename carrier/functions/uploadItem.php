<?php

include 'dbcon.php';

$item_name = $_POST['itemname'];
$item_cate = $_POST['category'];
$from_address = $_POST['fromaddress'];
$from_state = $_POST['fromstate'];
$receiver_name = $_POST['receivername'];
$receiver_phone = $_POST['receiverphone'];
$to_address = $_POST['toaddress'];
$to_state = $_POST['tostate'];
$quantity = $_POST['quantity'];
$start_price = $_POST['startprice'];
$userId = $_POST['userId'];
$substr = substr($item_cate,0,3);
$orderId = uniqid($substr);

$query = "INSERT INTO biditem (orderId, itemname, category, fromaddress,	fromstate, recievername, recieverphone,	toaddress, tostate,	quantity,	startprice,	sellerId,	date_made) VALUES ('$orderId', '$item_name', '$item_cate', '$from_address', '$from_state', '$receiver_name', '$receiver_phone', '$to_address', '$to_state', '$quantity', '$start_price', '$userId', NOW())";
$run = mysqli_query($conn, $query);

if (!$run) {
  // code...
  echo "error: ".$conn->error;
}else {
  echo "Item Uploaded Successfully";
}
 ?>
