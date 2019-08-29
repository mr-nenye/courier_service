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
              <a href="#"> <i data-feather="lock"></i> Sign out </a>
            </div>
          </div>
          <div class="menulist">
            <a href="dashboard" >
              <i data-feather="home"></i>
              Dashboard
            </a>
            <a href="messages">
              <i data-feather="message-square"></i>
              Messages
            </a>
            <a href="mypackage" class="active">
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

              <div class="page__section">
                <nav class="breadcrumb breadcrumb_type1" aria-label="Breadcrumb">
                  <ol class="breadcrumb__list r-list">
                    <li class="breadcrumb__group">
                      <a href="#0" class="breadcrumb__point r-link">Dashboard</a>
                      <span class="breadcrumb__divider" aria-hidden="true">/</span>
                    </li>
                    <li class="breadcrumb__group">
                      <span class="breadcrumb__point" aria-current="page">My packages</span>
                    </li>
                  </ol>
                </nav>
              </div>

            <!-- table display -->
            <div class="limiter">
              <div class="table-tops">
                <span class="table-title"> My Package </span>
                <!-- <span class="btn --btn-primary cd-popup-trigger"> <i data-feather="file-plus"></i> create new delivery</span> -->
                <span class="table-switch --list"> <i data-feather="list"></i> </span>
                <span class="table-switch --grid"> <i data-feather="grid"></i> </span>

                <span class="iconbtn round cd-popup-trigger">
                    <span class="icon"><i data-feather="file-plus"></i></span>
                    <span class="text">Create New Delivery</span>
                </span>
              </div>
          		<div class="container-table100">
          			<div class="wrap-table100">
          				<div class="table100">
                    <div id="target">
                    </div>
                    <!-- <div class="pagination p2">
                     <ul>
                       <?php if(!empty($total_pages)):for($i=1; $i<=$total_pages; $i++):
                      		if($i == 1):?>
                                  <a class='is-active' id="<?php echo $i;?>" href='mypackage?page=<?php echo $i;?>'><li id="<?php echo $i;?>"><?php echo $i;?></li></a>
                      		<?php else:?>
                      		<a href='mypackage?page=<?php echo $i;?>'><li id="<?php echo $i;?>"><?php echo $i;?></li></a>
                      		<?php endif;?>
                       <?php endfor;endif;?>
                     </ul>
                   </div> -->
          				</div>
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

            <div class="page__section">
              <nav class="breadcrumb breadcrumb_type1" aria-label="Breadcrumb">
                <ol class="breadcrumb__list r-list">
                  <li class="breadcrumb__group">
                    <a href="#0" class="breadcrumb__point r-link">Dashboard</a>
                    <span class="breadcrumb__divider" aria-hidden="true">/</span>
                  </li>
                  <li class="breadcrumb__group">
                    <span class="breadcrumb__point" aria-current="page">Marketplace</span>
                  </li>
                </ol>
              </nav>
            </div>

            <p class="page-title"> Marketplace </p>

            <div class="row">
              <div class="col-3 col-md-3 col-sm-12">
                <input type="text" class="txt-input search_input" placeholder="Search by item name OR item owner" name="search_input" id="search_input">
              </div>
              <div class="col-2 col-md-2 col-sm-12">
                <select class="txt-input state" name="state" autocomplete="off">
                </select>
              </div>
              <div class="col-3 col-md-3 col-sm-12">
                <!-- <span class="actBtn iconbtn round cd-popup-trigger" id="'.$rec["itemId"].'" style="margin-top: 1px;">
                    <span class="icon"><i data-feather="filter"></i></span>
                    <span class="text"> Filter </span>
                </span> -->
              </div>
            </div>

            <div class="row" id="fetchMarket">

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
    <script>
      $(document).ready(function() {
        load_data();
        function load_data(page) {
          $.ajax({
            url: 'pagination/mypackage.php',
            method: 'POST',
            data: {page:page},
            success: function (data) {
              $('#target').html(data);
            }
          })
        }

        $(document).on('click', '.pagination_link', function() {
          var page = $(this).attr('id');
          load_data(page);
        })
      })

      $(document).ready(function() {
        var text = $(this).val();
        $.ajax({
          url: 'pagination/fetchMarket',
          method: 'POST',
          data: {search:text},
          dataType: 'text',
          success: function(data) {
            $('#fetchMarket').html(data)
          }
        })

        $('#search_input').keyup(function() {
          var text = $(this).val();
          console.log(text);
          if(text != "") {
            if(text.length == 3) {
              $.ajax({
                url: 'pagination/fetchMarket',
                method: 'POST',
                data: {search:text},
                dataType: 'text',
                success: function(data) {
                  $('#fetchMarket').html(data)
                }
              })
            }
          } else{
            // $('#fetchMarket').html('');
            $.ajax({
              url: 'pagination/fetchMarket',
              method: 'POST',
              data: {search:text},
              dataType: 'text',
              success: function(data) {
                $('#fetchMarket').html(data)
              }
            })
          }
        })


        // load_by_cate()
        // function load_by_cate(query = "") {
        //   $.ajax({
        //     url: '',
        //     method: 'POST',
        //     data: {query:query},
        //     success: function (data) {
        //       $('#fetchMarket').html(data);
        //     }
        //   })
        // }

      })

    </script>
  </body>
</html>
