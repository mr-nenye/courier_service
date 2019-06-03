<?php
  require 'functions/dbcon.php';

  session_start();

  $userId = $_SESSION['id'];

  echo $userId;

  $getUserDetails = "SELECT * FROM users WHERE userId = '$userId'";
  $run = mysqli_query($conn, $getUserDetails);
  if (mysqli_num_rows($run) > 0) {
    // code...
    while($row = mysqli_fetch_array($run)) {

      $role = $row['role'];
  		$name = $row['name'];
  		$email = $row['email'];
      $phone = $row['phone'];
	  }
  }

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title> Welcome to your Carrier home - Dashboard </title>
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/flexgrid.css">
    <link rel="stylesheet" href="https://cdn.lineicons.com/1.0.1/LineIcons.min.css">
  </head>
  <body>

    <div class="">
      <!-- navbar -->
      <nav id="navbar" class="--navbar-fixed">
          <div class="nav-wrapper">
              <!-- Navbar Logo -->
              <div class="logo">
                  <!-- Logo Placeholder for Inlustration -->
                  <a href="#home">
                    <img src="assets/img/logo.png" width="60" alt="">
                  </a>
              </div>

              <!-- Navbar Links -->
              <ul id="menu">
                  <li><a href="#home">How it works</a></li>
                  <li><a href="services.html">About</a></li>
                  <li><a href="about.html">Help</a></li>
                  <li><a href="contact.html"> <i class="lni-user"></i> <?php echo $name; ?> </a></li>
              </ul>
          </div>
      </nav>
      <!-- Menu Icon -->
      <div class="menuIcon">
          <span class="icon icon-bars"></span>
          <span class="icon icon-bars overlay"></span>
      </div>
      <!-- overlay mobile menu -->
      <div class="overlay-menu">
        <ul id="menu">
            <li><a href="#home">Home</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
      </div>

      <div class="main-section">
        <!-- <div class="sidemenu">

          <div class="menulist">
            <a href="#">
              <i class="lni-travel"></i>
              My Trips
            </a>
            <a href="#">
              <i class="lni-archive"></i>
              My Packages
            </a>
            <a href="#">
              <i class="lni-travel"></i>
              Pick up
            </a>
            <a href="#">
              <i class="lni-travel"></i>
              Pick up
            </a>
          </div>

        </div> -->
        <div class="content-section">
          <div class="container">

            <!-- table display -->
            <div class="limiter">
              <div class="table-tops">
                <span class="table-title"> Table Title </span>
                <span class="btn --btn-primary cd-popup-trigger"> <i class="lni-plus"></i> create new delivery</span>
                <!-- <span class="table-switch --list"> <i class="lni-list"></i> </span>
                <span class="table-switch --grid"> <i class="lni-grid-alt"></i> </span> -->
              </div>
          		<div class="container-table100">
          			<div class="wrap-table100">
          				<div class="table100">
          					<table>
          						<thead>
          							<tr class="table100-head">
          								<th class="column1">Date</th>
          								<th class="column2">Order ID</th>
          								<th class="column3">Name</th>
          								<th class="column4">Price</th>
          								<th class="column5">Bids</th>
          								<th class="column6">Action</th>
          							</tr>
          						</thead>
          						<tbody>
          								<tr>
          									<td class="column1">2017-09-29 01:22</td>
          									<td class="column2">200398</td>
          									<td class="column3">iPhone X 64Gb Grey</td>
          									<td class="column4">₦ 999.00</td>
          									<td class="column5">4</td>
          									<td class="column6">
                              <a href="#" class="tbl-btn"> view bids </a>
                            </td>
          								</tr>
          								<tr>
          									<td class="column1">2017-09-18 05:57</td>
          									<td class="column2">200386</td>
          									<td class="column3">iPhone X 64Gb Grey</td>
          									<td class="column4">₦ 999.00</td>
          									<td class="column5">2</td>
          									<td class="column6">
                              <a href="#" class=""> view bids </a>
                            </td>
          								</tr>

          						</tbody>
          					</table>
                    <div class="pagination p2">
                     <ul>
                       <a href="#"><li>1</li></a>
                       <a class="is-active" href="#"><li>2</li></a>
                       <a href="#"><li>3</li></a>
                       <a href="#"><li>4</li></a>
                       <a href="#"><li>5</li></a>
                       <a href="#"><li>6</li></a>
                     </ul>
                   </div>
          				</div>
          			</div>
          		</div>
          	</div>

            <div class="cd-popup" role="alert">
            	<div class="cd-popup-container">
                <form class="" action="" method="post" id="prodtform">
                  <span class="cd-popup-title"> Modal Title </span>

              		<div class="cd-popup-body">
                    <div class="cd-content">
                      <div class="row">
                        <div class="col-8 col-md-8 col-sm-12">
                          <label for="" class="label "> Item name </label>
                          <input type="text" class="txt-input itemname" placeholder="enter the name of the item" name="itemname">
                          <small style="text-align: right; color: red" class="error-name"></small>
                        </div>
                        <div class="col-4 col-md-6 col-sm-12">
                          <label for="" class="label "> Category </label>
                          <select class="txt-input category" name="category">
                            <?php

                              $getCate = "SELECT * FROM category";
                              $run = mysqli_query($conn, $getCate);

                              if (mysqli_num_rows($run) > 0) {
                                // code...
                                while ($row = mysqli_fetch_array($run)) {
                                  // code...
                                  echo "<option value=".$row['categoryid']."> ".$row['categoryname']." </option>";
                                }
                              }

                             ?>
                            <!-- <option value=""> Option 1 </option>
                            <option value=""> Option 2 </option>
                            <option value=""> Option 3 </option>
                            <option value=""> Option 4 </option> -->
                          </select>
                          <small style="text-align: right; color: red" class="error-category"></small>
                        </div>
                        <div class="col-8 col-md-8 col-sm-12">
                          <label for="" class="label "> Pickup address </label>
                          <input type="text" class="txt-input fromaddress" placeholder="enter pickup address" name="fromaddress">
                          <small style="text-align: right; color: red" class="error-from-address"></small>
                        </div>
                        <div class="col-4 col-md-4 col-sm-12">
                          <label for="" class="label "> Pickup state </label>
                          <select class="txt-input fromstate" name="fromstate">
                            <option value="Abia"> Abia </option>
                            <option value="Adamawa"> Adamawa </option>
                            <option value="Akwa Ibom"> Akwa Ibom </option>
                            <option value="Anambra"> Anambra </option>
                            <option value="Bauchi"> Bauchi </option>
                            <option value="Bayelsa"> Bayelsa </option>
                            <option value="Benue"> Benue </option>
                            <option value="Borno"> Borno </option>
                            <option value="Cross River"> Cross River </option>
                            <option value="Delta"> Delta </option>
                            <option value="Ebonyi"> Ebonyi </option>
                            <option value="Enugu"> Enugu </option>
                            <option value="Edo"> Edo </option>
                            <option value="Ekiti"> Ekiti </option>
                            <option value="Abuja"> FCT Abuja </option>
                            <option value="Gombe"> Gombe </option>
                            <option value="Imo"> Imo </option>
                            <option value="Jigawa"> Jigawa </option>
                            <option value="Kaduna"> Kaduna </option>
                            <option value="Kano"> Kano </option>
                            <option value="Katsina"> Katsina </option>
                            <option value="Kebbi"> Kebbi </option>
                            <option value="Kogi"> Kogi </option>
                            <option value="Kwara"> Kwara </option>
                            <option value="Lagos"> Lagos </option>
                            <option value="Nasarawa"> Nasarawa </option>
                            <option value="Niger"> Niger </option>
                            <option value="Ogun"> Ogun </option>
                            <option value="Ondo"> Ondo </option>
                            <option value="Osun"> Osun </option>
                            <option value="Oyo"> Oyo </option>
                            <option value="Plateau"> Plateau </option>
                            <option value="Rivers"> Rivers </option>
                            <option value="Sokoto"> Sokoto </option>
                            <option value="Taraba"> Taraba </option>
                            <option value="Yobe"> Yobe </option>
                            <option value="Zamfara"> Zamfara </option>
                          </select>
                          <small style="text-align: right; color: red" class="error-from-state"></small>
                        </div>
                        <div class="col-6 col-md-6 col-sm-12">
                          <label for="" class="label "> Recipient name </label>
                          <input type="text" class="txt-input receivername" placeholder="enter recipient name" name="receivername">
                          <small style="text-align: right; color: red" class="error-recv-name"></small>
                        </div>
                        <div class="col-6 col-md-6 col-sm-12">
                          <label for="" class="label "> Recipient phone number </label>
                          <input type="text" class="txt-input receiverphone" placeholder="enter recipient phone number" name="receiverphone">
                          <small style="text-align: right; color: red" class="error-recv-phone"></small>
                        </div>
                        <div class="col-8 col-md-8 col-sm-12">
                          <label for="" class="label "> Destination address </label>
                          <input type="text" class="txt-input toaddress" placeholder="enter destination address" name="toaddress">
                          <small style="text-align: right; color: red" class="error-to-address"></small>
                        </div>
                        <div class="col-4 col-md-4 col-sm-12">
                          <label for="" class="label "> Destination state </label>
                          <select class="txt-input tostate" name="tostate">
                            <option value="Abia"> Abia </option>
                            <option value="Adamawa"> Adamawa </option>
                            <option value="Akwa Ibom"> Akwa Ibom </option>
                            <option value="Anambra"> Anambra </option>
                            <option value="Bauchi"> Bauchi </option>
                            <option value="Bayelsa"> Bayelsa </option>
                            <option value="Benue"> Benue </option>
                            <option value="Borno"> Borno </option>
                            <option value="Cross River"> Cross River </option>
                            <option value="Delta"> Delta </option>
                            <option value="Ebonyi"> Ebonyi </option>
                            <option value="Enugu"> Enugu </option>
                            <option value="Edo"> Edo </option>
                            <option value="Ekiti"> Ekiti </option>
                            <option value="Abuja"> FCT Abuja </option>
                            <option value="Gombe"> Gombe </option>
                            <option value="Imo"> Imo </option>
                            <option value="Jigawa"> Jigawa </option>
                            <option value="Kaduna"> Kaduna </option>
                            <option value="Kano"> Kano </option>
                            <option value="Katsina"> Katsina </option>
                            <option value="Kebbi"> Kebbi </option>
                            <option value="Kogi"> Kogi </option>
                            <option value="Kwara"> Kwara </option>
                            <option value="Lagos"> Lagos </option>
                            <option value="Nasarawa"> Nasarawa </option>
                            <option value="Niger"> Niger </option>
                            <option value="Ogun"> Ogun </option>
                            <option value="Ondo"> Ondo </option>
                            <option value="Osun"> Osun </option>
                            <option value="Oyo"> Oyo </option>
                            <option value="Plateau"> Plateau </option>
                            <option value="Rivers"> Rivers </option>
                            <option value="Sokoto"> Sokoto </option>
                            <option value="Taraba"> Taraba </option>
                            <option value="Yobe"> Yobe </option>
                            <option value="Zamfara"> Zamfara </option>
                          </select>
                          <small style="text-align: right; color: red" class="error-to-state"></small>
                        </div>
                        <div class="col-6 col-md-6 col-sm-12">
                          <label for="" class="label "> Quantity </label>
                          <input type="number" class="txt-input quantity" placeholder="enter quantity" name="quantity">
                          <small style="text-align: right; color: red" class="error-quantity"></small>
                        </div>
                        <div class="col-6 col-md-6 col-sm-12">
                          <label for="" class="label "> Starting price </label>
                          <input type="text" class="txt-input startprice" placeholder="enter your base price" name="startprice">
                          <small style="text-align: right; color: red" class="error-start-price"></small>
                        </div>
                        <div class="col-6 col-md-6 col-sm-12">
                          <input type="hidden" class="txt-input userId"  placeholder="enter your base price" value="<?php echo $userId; ?>"  name="userId">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="cd-buttons">
                    <span class="btn --btn-flat close"> close</span>
                    <button type="submit" name="button" class="btn --btn-primary"> place order </button>
                  </div>

              		<a href="#0" class="cd-popup-close img-replace"></a>
                </form>

            	</div> <!-- cd-popup-container -->
            </div> <!-- cd-popup -->

          </div>
        </div>
      </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script type="text/javascript">
      jQuery(document).ready(function($){
      	//open popup
      	$('.cd-popup-trigger').on('click', function(event){
      		event.preventDefault();
      		$('.cd-popup').addClass('is-visible');
      	});

      	//close popup
      	$('.cd-popup').on('click', function(event){
      		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') || $(event.target).is('.close') ) {
      			event.preventDefault();
      			$(this).removeClass('is-visible');
      		}
      	});
      	//close popup when clicking the esc keyboard button
      	$(document).keyup(function(event){
          	if(event.which=='27'){
          		$('.cd-popup').removeClass('is-visible');
      	    }
          });
      });
    </script>

    <script type="text/javascript">
      $("#prodtform").on("submit", function(e) {
        // e.preventDefault();
        $('.error-name').html('');
        $('.error-category').html('');
        $('#message').html('');
        $('.error-from-address').html('');
        $('.error-from-state').html('');
        $('.error-recv-name').html('');
        $('.error-recv-phone').html('');
        $('.error-to-address').html('');
        $('.error-to-state').html('');
        $('.error-quantity').html('');
        $('.error-start-price').html('');

        var itemname = $(".itemname").val();
        var category = $(".category").val();
        var fromaddress = $(".fromaddress").val();
        var fromstate = $(".fromstate").val();
        var receivername = $(".receivername").val();
        var receiverphone = $(".receiverphone").val();
        var toaddress = $(".toaddress").val();
        var tostate = $(".tostate").val();
        var quantity = $(".quantity").val();
        var startprice = $(".startprice").val();
        var userId = $(".userId").val();

        if($(".itemname").val()==""){
          $(".error-name").html("Please enter item name.");
          $(".error-name").css("color", "red");
          $(".itemname").focus();
        }else {
          $.ajax({
            type: "POST",
            url:"functions/uploadItem.php",
            data: {
              "itemname":itemname,
              "category":category,
              "fromaddress":fromaddress,
              "fromstate":fromstate,
              "receivername":receivername,
              "receiverphone":receiverphone,
              "toaddress":toaddress,
              "tostate":tostate,
              "quantity":quantity,
              "startprice":startprice,
              "userId":userId
            },
            success:function(result){
              alert(result);
             if(result==0){
               //alert("invalid");
               $("#message").html("An error occured. Item nor added");
               $("#message").css("color", "red");
             } else{
               $("#message").html("Item added Successfully");
               $("#message").css("color", "green");
              }
            }
          })
        }
        e.preventDefault();
      })
    </script>

  </body>
</html>
