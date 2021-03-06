<?php
  require 'functions/dbcon.php';

  session_start();

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

  $itemId = $_GET['q'];

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
                  <li><a href="services.html"> <i data-feather="message-square"></i> <span> 3 </span> </a></li>
                  <li><a href="about.html"> <i data-feather="bell"></i> <span> 1 </span> </a></li>
                  <!-- <li><a href="contact.html"> <i data-feather="user"></i> <?php echo $name; ?> </a></li> -
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

              <div class="page__section">
                <nav class="breadcrumb breadcrumb_type1" aria-label="Breadcrumb">
                  <ol class="breadcrumb__list r-list">
                    <li class="breadcrumb__group">
                      <a href="#0" class="breadcrumb__point r-link">My packages</a>
                      <span class="breadcrumb__divider" aria-hidden="true">/</span>
                    </li>
                    <li class="breadcrumb__group">
                      <span class="breadcrumb__point" aria-current="page">My offers</span>
                    </li>
                  </ol>
                </nav>
              </div>

              <p class="page-title"> My Offers </p>

            <!-- table display -->
            <div class="">
              <input type="hidden" value="<?php echo $itemId ?>" name="itemId" class="itemId"/>
              <div class="row" id="target">

              </div>
            </div>
           </div>


          <?php  } elseif ($role === 'carrier') {?>

            <div class="row">

              <?php
                $getPublicItems = "SELECT * FROM biditem";
                $runget = mysqli_query($conn, $getPublicItems);

                if (mysqli_num_rows($runget) > 0) {
                  // code...
                  while($rec = mysqli_fetch_array($runget)) {

                    echo '
                    <div class="col-4 col-md-4 col-sm-12">
                      <div class="box-of-stuff">
                        <span class="box-name"> '.$rec["name"].' </span>

                        <!-- <p class="desp"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p> -->

                        <div class="row">
                          <div class="col-6 col-md-6 col-sm-12">
                            <label for="" class="label "> Pick up State </label>
                            <span class="desp"> '.$rec["fromstate"].' </span>
                          </div>
                          <div class="col-6 col-md-6 col-sm-12">
                            <label for="" class="label "> Pick up Address </label>
                            <span class="desp"> '.$rec["fromaddress"].' </span>
                          </div>
                          <div class="col-6 col-md-6 col-sm-12">
                            <label for="" class="label "> Delivery State </label>
                            <span class="desp"> '.$rec["tostate"].' </span>
                          </div>
                          <div class="col-6 col-md-6 col-sm-12">
                            <label for="" class="label "> Delivery Address </label>
                            <span class="desp"> '.$rec["toaddress"].' </span>
                          </div>
                          <div class="col-12 col-md-12 col-sm-12">
                            <label for="" class="label "> Starting Price </label>
                            <span class="desp"> '.$rec["startprice"].' </span>
                          </div>
                          <form class="accptForm">
                            <input type="hidden" value="'.$rec["itemId"].'" />
                          </form>
                        </div>

                        <div class="view-bid-btn">
                          <button href="" class="btn --btn-primary cd-popup-trigger" id="'.$rec["itemId"].'"> Place Bid </button>
                        </div>
                      </div>
                    </div>
                    ';

                  }
                }
               ?>

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

      $("#accptForm").on("click", function(e) {
        // e.preventDefault();

        var accptId = $(".accptId").val();
        var bidderId = $(".bidderId").val();

        $.ajax({
          type: "POST",
          url:"functions/acceptBid.php",
          data: {
            "accptId":accptId,
            "bidderId":bidderId,
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
        e.preventDefault();
      })

    </script>
    <script>
      feather.replace()
    </script>
    <script>
      $(document).ready(function() {
        var itemId = $(".itemId").val();
        load_data();
        function load_data(page) {
          $.ajax({
            url: 'pagination/offer.php',
            method: 'POST',
            data: {page:page, itemId:itemId},
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
    </script>
  </body>
</html>
