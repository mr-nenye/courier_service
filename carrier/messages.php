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
                  <li><a href="services.html"> <i data-feather="message-square"></i> <span> 3 </span> </a></li>
                  <li><a href="about.html"> <i data-feather="bell"></i> <span> 1 </span> </a></li>
                  <!-- <li><a href="contact.html"> <i data-feather="user"></i> <?php echo $name; ?> </a></li> -->
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
        <div class="sidemenu">

          <div class="menulist">
            <a href="dashboard">
              <i data-feather="home"></i>
              Dashboard
            </a>
            <a href="messages">
              <i data-feather="message-square"></i>
              Messages
            </a>
            <a href="#">
              <i data-feather="package"></i>
              My packages
            </a>
            <a href="#">
              <i data-feather="headphones"></i>
              Support
            </a>
            <a href="#">
              <i data-feather="power"></i>
              Pick up
            </a>
          </div>

        </div>
        <div class="content-section">
          <div class="container-lg">
            <div class="row">
              <div class="col-5 col-md-5 col-sm-12">
                <div class="page-title d-flex justify-content-between">
                  <h4> All Messages </h4>
                  <div class="btn-sm --btn-primary icon">
                    <i data-feather="edit-3"></i>
                  </div>
                </div>
                <div class="panel">
                  <div class="panel-body">
                    <div class="panel-user">
                      <div class="avatar">

                      </div>
                      <div class="content">
                        <h4> Mike Creative Mints </h4>
                        <div class="date">
                          3 days ago
                        </div>
                        <div class="text">
                          Hi! We are Educational institution.We are offering computer science and management courses at the present
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-7 col-md-7 col-sm-12">
                <div class="panel">
                  <div class="panel-message-header">
                    <div class="panel-user">
                      <div class="avatar">

                      </div>
                      <div class="content">
                        <h4> Mike Creative Mints </h4>
                        <div class="time">
                          Active Right Now
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="message-content">
                    <div class="message">
                      <div class="">
                        <div class="txt">
                          we have a lot of mobile users so essentially need a mobile first design that will be responsive but designed for desktop as well.
                        </div>
                      </div>
                      <div class="date">
                        4 days ago
                      </div>
                      <div class="avatar">

                      </div>
                    </div>
                    <div class="message you">
                      <div class="">
                        <div class="txt">
                          we have a lot of mobile users so essentially need a mobile first design that will be responsive but designed for desktop as well.
                        </div>
                      </div>
                      <div class="date">
                        4 days ago
                      </div>
                    </div>

                    <div class="line-day">
                      <span></span>
                      <span class="text"> Today </span>
                      <span></span>
                    </div>

                    <div class="message you">
                      <div class="">
                        <div class="txt">
                          we have a lot of mobile users so essentially need a mobile first design that will be responsive but designed for desktop as well.
                        </div>
                      </div>
                      <div class="date">
                        4 days ago
                      </div>
                    </div>
                    <div class="message ">
                      <div class="">
                        <div class="txt file">
                          <div class="title">
                            New fire media
                          </div>
                          <div class="infos">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                          </div>
                          <div class="btn">
                            Download
                          </div>

                        </div>
                      </div>
                      <div class="date">
                        4 days ago
                      </div>
                      <div class="avatar">

                      </div>

                    </div>
                    <div class="message-form">
                      <input type="text" name="" class="msg-form" placeholder="Type a message ..." value="">
                      <div class="send">
                        <i data-feather="send"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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


    </script>
    <script>
      feather.replace()
    </script>
  </body>
</html>
