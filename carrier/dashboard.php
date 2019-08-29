<?php
  require 'functions/dbcon.php';

  session_start();
  if (!isset($_SESSION['id'])) {
    header('location: login');
  }
  $userId = $_SESSION['id'];


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
    <script src="https://unpkg.com/feather-icons"></script>
  </head>
  <body>

    <div class="">
      <!-- navbar -->
      <!-- <nav id="navbar" class="--navbar-fixed">
          <div class="nav-wrapper">
              <div class="logo">
                  <a href="#home">
                    <img src="assets/img/logo.png" width="60" alt="">
                  </a>
              </div>
              <ul id="menu">
                  <li>
                    <a href="services.html"> <i data-feather="message-square"></i>
                      <?php
                        $sql="SELECT * FROM chats WHERE sender = $userId AND readStatus = 0";

                        if ($result=mysqli_query($conn,$sql)) {
                          $rowcount=mysqli_num_rows($result);
                          if ($rowcount === 0) {
                            echo "";
                          }elseif ($rowcount > 0) {
                            echo "<span>$rowcount</span>";
                          }
                        }

                       ?>
                    </a>
                  </li>
                  <li><a href="about.html"> <i data-feather="bell"></i> <span> 1 </span> </a></li>
                  <li>
                    <div class="user-info">
                      <div class="avatar">
                        <i data-feather="user"></i>
                      </div>
                      <div class="name">
                        <?php echo $name; ?>
                      </div>
                    </div>
                  </li>
              </ul>
          </div>
      </nav> -->
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
        <div class="sidemenu">
          <div class="user-info" onclick="toggleDropMenu()">
            <div class="avatar">
              <!-- <i data-feather="user"></i> -->
              <p>
                <?php
                $words = explode(" ", $name);
                $acronym = "";

                foreach ($words as $w) {
                  $acronym .= $w[0];
                }

                echo $acronym;
                 ?>
              </p>
            </div>
            <div class="name">
              <?php echo $name; ?>
            </div>
            <div class="dropmenu">
              <a href="profile"> <i data-feather='user'></i> Profile </a>
              <hr>
              <div class="separator"></div>
              <a href="functions/logout"> <i data-feather="lock"></i> Sign out </a>
            </div>
          </div>
          <div class="menulist">
            <a href="dashboard" class="active">
              <i data-feather="home"></i>
              Dashboard
            </a>
            <a href="messages">
              <i data-feather="message-square"></i>
              Messages
            </a>
            <a href="mypackage">
              <i data-feather="package"></i>
              My packages
            </a>
            <a href="support">
              <i data-feather="headphones"></i>
              Support
            </a>
          </div>

        </div>
        <div class="content-section">
          <div class="container-lg">

            <?php if($role === 'commissioner') { ?>

            <div class="row">
              <div class="col-12">
                <p class="page-title"> Overview </p>
              </div>
            </div>

            <div class="row">
              <div class="col-4 col-md-4 col-sm-12">
                <div class="stat-card">
                  <div class="stat-card-icon">
                    <i class="" data-feather="upload"></i>
                  </div>
                  <p class="stat-by-number">
                    <?php

                      $sql="SELECT * FROM biditem WHERE sellerId = $userId";

                      if ($result=mysqli_query($conn,$sql)) {
                        // Return the number of rows in result set
                        $rowcount=mysqli_num_rows($result);
                        printf(" %d \n",$rowcount);
                        // Free result set
                        mysqli_free_result($result);
                      }

                    ?>
                   </p>
                   <small class="stat-title"> Total number of upload </small>
                </div>
              </div>
              <div class="col-4 col-md-4 col-sm-12">
                <div class="stat-card">
                  <div class="stat-card-icon danger">
                    <i data-feather="file-text"></i>
                  </div>

                  <p class="stat-by-number">
                    <?php

                      $sql="SELECT * FROM tickets WHERE ticketholderId = $userId";

                      if ($result=mysqli_query($conn,$sql)) {
                        // Return the number of rows in result set
                        $rowcount=mysqli_num_rows($result);
                        printf(" %d \n",$rowcount);
                        // Free result set
                        mysqli_free_result($result);
                      }

                    ?>
                   </p>
                   <small class="stat-title"> Total number of Ticket opened </small>
                </div>
              </div>
              <div class="col-4 col-md-4 col-sm-12">
                <div class="stat-card">
                  <div class="stat-card-icon info">
                    <i data-feather="user-plus"></i>
                  </div>
                  <p class="stat-by-number">
                    <?php

                      $sql="SELECT *  FROM biditem
                      INNER JOIN bidreport ON biditem.itemId = bidreport.productId
                      WHERE sellerId = $userId";

                      if ($result=mysqli_query($conn,$sql)) {
                        // Return the number of rows in result set
                        $rowcount=mysqli_num_rows($result);
                        printf(" %d \n",$rowcount);
                        // Free result set
                        mysqli_free_result($result);
                      }

                    ?>
                   </p>
                   <small class="stat-title"> Total bids received </small>
                </div>
              </div>
          	</div>
            <div class="row">

              <div class="col-7 col-md-7 col-sm-12">
                <div class='request-card accepted full-width'>
                  <header>
                    <div>
                      <h3> Welcome back <br /> <h1><?php echo $name ?></h1></h3>
                    </div>
                    <img src="assets/img/dashy2.svg" class="absolute" alt="">
                  </header>

                  <nav>
                    <ul>
                      <li> <h3> Welcome to your dashboard or your little home that gives <br /> you a straight insight on account and activities </h3> </li>
                    </ul>
                  </nav>
                </div>
              </div>

              <div class="col-5 col-md-5 col-sm-12">
                <div class='request-card'>
                  <header>
                    <div>
                      <h1> Shippment </h1>
                    </div>
                    <img src="assets/img/delivery.svg" class="absolute" alt="">
                  </header>

                  <nav>
                    <ul>
                      <li>
                        Jump straight into the action and  <br /> create a fresh new delivery item
                      </li>
                      <li>
                        <span class="iconbtn round cd-popup-trigger">
                            <span class="icon"><i data-feather="file-plus"></i></span>
                            <span class="text">Create New Delivery</span>
                        </span>
                      </li>
                    </ul>
                  </nav>
                </div>
              </div>

            </div>


            <!-- popup -->

            <div class="cd-popup" role="alert">
              <div class="cd-popup-container cd-popup-container-sm">
                <form class="" action="" method="post" id="prodtform">
                  <span class="cd-popup-title"> Modal Title </span>

                  <div class="cd-popup-body">
                    <div class="cd-content">
                      <div class="row">
                        <div class="col-12">
                          <label for="" class="label "> Item name </label>
                          <input type="text" class="txt-input itemname" placeholder="enter the name of the item" name="itemname">
                          <small style="text-align: right; color: red" class="error-name"></small>
                        </div>
                        <div class="col-12">
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
                          </select>
                          <small style="text-align: right; color: red" class="error-category"></small>
                        </div>
                        <div class="col-7">
                          <label for="" class="label "> Pickup address </label>
                          <input type="text" class="txt-input fromaddress" placeholder="enter pickup address" name="fromaddress">
                          <small style="text-align: right; color: red" class="error-from-address"></small>
                        </div>
                        <div class="col-5">
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
                        <div class="col-12">
                          <label for="" class="label "> Recipient name </label>
                          <input type="text" class="txt-input receivername" placeholder="enter recipient name" name="receivername">
                          <small style="text-align: right; color: red" class="error-recv-name"></small>
                        </div>
                        <div class="col-12">
                          <label for="" class="label "> Recipient phone number </label>
                          <input type="text" class="txt-input receiverphone" placeholder="enter recipient phone number" name="receiverphone">
                          <small style="text-align: right; color: red" class="error-recv-phone"></small>
                        </div>
                        <div class="col-7">
                          <label for="" class="label "> Destination address </label>
                          <input type="text" class="txt-input toaddress" placeholder="enter destination address" name="toaddress">
                          <small style="text-align: right; color: red" class="error-to-address"></small>
                        </div>
                        <div class="col-5">
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
                    <button type="submit" name="button" class="btn --btn-primary" onclick="updateDiv()"> place order </button>
                  </div>

                  <a href="#0" class="cd-popup-close img-replace"></a>
                </form>

              </div> <!-- cd-popup-container -->
            </div> <!-- cd-popup -->



          <?php  } elseif ($role === 'carrier') {?>

            <div class="row">

              <div class="col-12">
                <p class="page-title"> Overview </p>
              </div>

              <div class="row">

            	</div>

              <div class="col-7 col-md-7 col-sm-12">
                <div class='request-card accepted full-width'>
                  <header>
                    <div>
                      <h3> Welcome back <br /> <h1><?php echo $name ?></h1></h3>
                    </div>
                    <img src="assets/img/dashy2.svg" class="absolute" alt="">
                  </header>

                  <nav>
                    <ul>
                      <li> <h3> Welcome to your dashboard or your little home that gives <br /> you a straight insight on account and activities </h3> </li>
                    </ul>
                  </nav>
                </div>
              </div>
              <div class="col-6 col-md-6 col-sm-12">
                <div class="stat-card">
                  <div class="stat-card-icon">
                    <i class="" data-feather="flag"></i>
                  </div>
                  <p class="stat-by-number">
                    <?php

                      $sql="SELECT * FROM bidreport WHERE bidder = $userId";

                      if ($result=mysqli_query($conn,$sql)) {
                        // Return the number of rows in result set
                        $rowcount=mysqli_num_rows($result);
                        printf(" %d \n",$rowcount);
                        // Free result set
                        mysqli_free_result($result);
                      }

                    ?>
                   </p>
                   <small class="stat-title"> Total number of bid made </small>
                </div>
              </div>
              <div class="col-6 col-md-6 col-sm-12">
                <div class="stat-card">
                  <div class="stat-card-icon danger">
                    <i data-feather="check"></i>
                  </div>

                  <p class="stat-by-number">
                    <?php

                      $sql="SELECT * FROM bidreport WHERE bidder = $userId AND status = 1";

                      if ($result=mysqli_query($conn,$sql)) {
                        // Return the number of rows in result set
                        $rowcount=mysqli_num_rows($result);
                        printf(" %d \n",$rowcount);
                        // Free result set
                        mysqli_free_result($result);
                      }

                    ?>
                   </p>
                   <small class="stat-title"> Total number of bid accepted </small>
                </div>
              </div>

              <div class="limiter">
                <div class="table-tops">
                  <span class="table-title"> My Parcel </span>
                  <span class="table-switch --list"> <i data-feather="list"></i> </span>
                  <span class="table-switch --grid"> <i data-feather="grid"></i> </span>
                </div>
            		<div class="container-table100">
            			<div class="wrap-table100">
            				<div class="table100">

                          <?php
                            // $getMyStuffs = "SELECT a.*, (SELECT * FROM biditem WHERE itemId = a.productid ) AS total FROM bidreport a WHERE a.bidder = $userId AND status = '1' ORDER BY biddatetime DESC";
                            $getMyStuffs = "SELECT *  FROM bidreport
                            INNER JOIN biditem ON bidreport.productid = biditem.itemId
                            INNER JOIN users ON biditem.sellerId = users.userid
                            WHERE bidder = $userId AND status = '1'";
                            $run = mysqli_query($conn, $getMyStuffs);

                            if (mysqli_num_rows($run) > 0) {
                              // code...
                              echo "<table class='list-view'>
                    						<thead>
                    							<tr class='table100-head'>
                    								<th class='column1'>Date</th>
                    								<th class='column2'>Order ID</th>
                    								<th class='column3'>Owners Name</th>
                    								<th class='column4'>Start Price</th>
                    								<th class='column5'>My Bid</th>
                                    <th class='column5'>Origin</th>
                                    <th class='column5'>Destination</th>
                    								<th class='column6'>  </th>
                    							</tr>
                    						</thead>
                    						<tbody>";
                              while($row = mysqli_fetch_array($run)) {
                                echo "<tr>
                									<td class='column1'>".$row['date_made']."</td>
                									<td class='column2'>200398</td>
                									<td class='column3'>".$row['name']."</td>
                									<td class='column4'>".$row['startprice']."</td>
                									<td class='column5'>".$row['bidamount']."</td>
                									<td class='column5'>".$row['fromstate']."</td>
                									<td class='column5'>".$row['tostate']."</td>
                									<td class='column6'>
                                    <a href='overview?q=".$row['itemId']."' class=''> Open </a> &nbsp;&nbsp;&nbsp;
                                  </td>
                								</tr>";
                              }
                              echo "</tbody></table>";
                            } else {

                              echo "
                              <div class='empty-state'>
                                <div class='--center'>
                                  <div class='col-12 --center'>
                                    <img src='assets/img/empty-state.svg' />
                                  </div>
                                  <div class='col-12 --center'>
                                    <h3> No file found </h3>
                                    <span> Click on the <b> Create New Delivery </b> buttno to start  </span>
                                  </div>
                                </div>
                              </div>
                              ";

                            }

                           ?>


                      <div class="card-view">
                        <div class="row">
                        <?php
                          $getMyStuffs = "SELECT a.*, (SELECT * FROM biditem WHERE itemId = a.productid ) AS total FROM bidreport a WHERE a.bidder = $userId AND status = '1' ORDER BY biddatetime DESC";
                          $run = mysqli_query($conn, $getMyStuffs);

                          if (mysqli_num_rows($run) > 0) {
                            // code...
                            while($row = mysqli_fetch_array($run)) {
                              echo "<div class='col-4 col-md-4 col-sm-12'>
                                <div class='panel'>
                                  <div class='panel-body job'>
                                    <span class='badge badge-success'> ".$row['startprice']."  </span>
                                    <h4> ".$row['name']." </h4>
                                    <ul class='tags'>
                                      <li> 3 new messages </li>
                                      <li> ".$row['total']." bids </li>
                                    </ul>
                                    <span class='date'> <i data-feather='calendar'></i> ".$row['date_made']." </span>
                                    <a href='' class='badge badge-link'> ".$row['total']." Bids </a>
                                  </div>
                                </div>
                              </div>";
                            }
                          }
                        ?>
                      </div>
                      </div>
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


               <!-- popup -->

               <div class="cd-popup" role="alert">
               	<div class="cd-popup-container cd-popup-container-sm">
                   <form class="" action="" method="post" id="bidform">
                    <span class="cd-popup-title"> Make Bid </span>

                 		<div class="cd-popup-body">
                       <div class="cd-content" id="item_detail">
                        <!-- display bid popup here -->
                        <input type="hidden" class="txt-input userId" value="<?php echo $userId; ?>" placeholder="enter the name of the item" name="userId">
                       </div>
                     </div>
                     <div class="cd-buttons">
                       <span class="btn --btn-flat close"> Close</span>
                       <button type="submit" name="button" class="btn --btn-primary"> Place Bid </button>
                     </div>

                 		<a href="#0" class="cd-popup-close img-replace"></a>
                   </form>

               	</div> <!-- cd-popup-container -->
               </div> <!-- cd-popup -->


            </div>


          <?php } ?>

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

      $(document).on('click', '.cd-popup-trigger', function(){
        //$('#dataModal').modal();
        var item_id = $(this).attr("id");
        $.ajax({
         url:"functions/select.php",
         method:"POST",
         data:{item_id:item_id},
         success:function(data){
          $('#item_detail').html(data);
          $('.cd-popup').addClass('is-visible');
         }
        });
      });

      $("#bidform").on("submit", function(e) {
        // e.preventDefault();
        $('.error-oppoBid').html('');

        var oppoBid = $(".oppoBid").val();
        var item_id = $(".item_id").val();
        var userId = $(".userId").val();

        if($(".oppoBid").val()==""){
          $(".error-oppoBid").html("Enter your countr bid.");
          $(".error-oppoBid").css("color", "red");
          $(".oppoBid").focus();
        }else {
          $.ajax({
            type: "POST",
            url:"functions/placebid.php",
            data: {
              "oppoBid":oppoBid,
              "item_id":item_id,
              "userId":userId
            },
            success:function(result){
              alert(result);
             if(result==0){
               // alert(result);
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

      $(document).ready( function() {

        let cardView  = document.querySelector(".card-view");
        $("cardView").css("display", "none");
        $(".--list").on('click', function(e) {
          // e.preventDefault();
          $(".card-view").css("display", "none");
          $(".list-view").css("display", "block");
        })

        $(".--grid").on('click', function(e) {
          // e.preventDefault();
          $(".list-view").css("display", "none");
          $(".card-view").css("display", "block");
        })
      })

      updateDiv = () => {
        $( ".table100" ).load(window.location.href + " .table100" );
      }
      toggleDropMenu = () => {
        $(".dropmenu").toggleClass("active");
      }
    </script>
    <script>
      feather.replace()
    </script>
  </body>
</html>
