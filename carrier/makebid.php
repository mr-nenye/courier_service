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

              <div class="page__section">
                <nav class="breadcrumb breadcrumb_type1" aria-labell="Breadcrumb">
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

              <?php

              $getJoinItem = "SELECT * FROM biditem
                INNER JOIN users ON users.userid = biditem.sellerId
                WHERE biditem.itemId = $itemId";

              $runquery = mysqli_query($conn, $getJoinItem);

              if (mysqli_num_rows($runquery) > 0) {
                while($rec = mysqli_fetch_array($runquery)) {

                  echo '<p class="page-title">'.$rec["itemname"].' <small> #'.$rec["orderId"].' </small></p>

                  <div class="row">
                    <div class="col-4 col-md-4 col-sm-12 sectoninfo">
                      <span class="secton-title"> Item Owner </span>
                      <div>
                        <label> NAME </label>
                        <p>'.$rec["name"].'<p>
                      </div>
                      <div>
                        <label> PHONE NUMBER </label>
                        <p>'.$rec["phone"].'<p>
                      </div>
                      <div>
                        <label> EMAIL ADDRESS </label>
                        <p>'.$rec["email"].'<p>
                      </div>
                    </div>
                    <div class="col-4 col-md-4 col-sm-12 sectoninfo">
                      <span class="secton-title"> Delivery Info </span>
                      <div>
                        <label> PICK UP STATE </label>
                        <p>'.$rec["fromstate"].'<p>
                      </div>
                      <div>
                        <label> PICK UP ADDRESS </label>
                        <p>'.$rec["fromaddress"].'<p>
                      </div>
                      <div>
                        <label> DESTINATION STATE </label>
                        <p>'.$rec["tostate"].'<p>
                      </div>
                      <div>
                        <label> DESTINATION ADDRESS </label>
                        <p>'.$rec["toaddress"].'<p>
                      </div>
                      <div>
                        <label> RECEIVER NAME </label>
                        <p>'.$rec["recievername"].'<p>
                      </div>
                      <div>
                        <label> RECEIVER PHONE NUMBER </label>
                        <p>'.$rec["recieverphone"].'<p>
                      </div>
                    </div>
                    <div class="col-4 col-md-4 col-sm-12 sectoninfo">
                      <span class="secton-title"> Pricing </span>
                      <div>
                        <label> STARTING PRICE </label>
                        <p class="price">'.$rec["startprice"].'</p>
                      </div>
                      <div>
                        <input type="text" class="txt-input search_input" placeholder="Search by item name OR item owner" name="search_input" id="search_input">
                        <span href="makebid?q='.$rec["itemId"].'" class="actBtn iconbtn round" id="'.$rec["itemId"].'">
                            <span class="icon"><i data-feather="flag"></i></span>
                            <span class="text"> Make a bid </span>
                        </span>
                      </div>
                    </div>
                  </div>';

                }
              }

               ?>

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

      printInvoice = () => {
        window.print();
      }
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
