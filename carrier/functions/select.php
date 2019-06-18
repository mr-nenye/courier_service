
<?php
require 'dbcon.php';

//select.php
if(isset($_POST["item_id"]))
{
 $output = '';
 $query = "SELECT * FROM biditem WHERE itemId = '".$_POST["item_id"]."'";
 $result = mysqli_query($conn, $query);
 $output .= '
      <div class="row">';
    while($row = mysqli_fetch_array($result))
    {
     $output .= '
       <div class="col-12 col-md-12 col-sm-12">
         <label for="" class="label "> Parcel Name </label>
         <span class="desp"> '.$row["name"].' </span>
       </div>
       <div class="col-6 col-md-6 col-sm-12">
         <label for="" class="label "> Pick up State </label>
         <span class="desp"> '.$row["fromstate"].' </span>
       </div>
       <div class="col-6 col-md-6 col-sm-12">
         <label for="" class="label "> Pick up Address </label>
         <span class="desp"> '.$row["fromaddress"].' </span>
       </div>
       <div class="col-6 col-md-6 col-sm-12">
         <label for="" class="label "> Delivery State </label>
         <span class="desp"> '.$row["tostate"].' </span>
       </div>
       <div class="col-6 col-md-6 col-sm-12">
         <label for="" class="label "> Delivery Address </label>
         <span class="desp"> '.$row["toaddress"].' </span>
       </div>
       <div class="col-12 col-md-12 col-sm-12">
         <label for="" class="label "> Starting Price </label>
         <span class="desp"> '.$row["startprice"].' </span>
       </div>
       <div class="col-12 col-md-12 col-sm-12">
         <label for="" class="label "> Enter you Bid </label>
         <input type="text" class="txt-input oppoBid" placeholder="enter the name of the item" name="oppoBid">
         <small style="text-align: right; color: red" class="error-oppoBid"></small>
       </div>
       <div class="col-12 col-md-12 col-sm-12">
         <input type="hidden" class="txt-input item_id" value="'.$row["itemId"].'" placeholder="enter the name of the item" name="item_id">
       </div>
     ';
    }
    $output .= '</div>';
    echo $output;
}
?>

<div class="">

</div>
