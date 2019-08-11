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
              <a href="#"> <i data-feather='user'></i> Profile </a>
              <hr>
              <div class="separator"></div>
              <a href="#"> <i data-feather="lock"></i> Sign out </a>
            </div>
          </div>
          <div class="menulist">
            <a href="dashboard">
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
            <a href="support" class="active">
              <i data-feather="headphones"></i>
              Support
            </a>
          </div>

        </div>
        <div class="content-section">
          <div class="emai-l">
            <div class="email-listing">
              <?php
                $getTickets = "SELECT * FROM tickets WHERE ticketemail = '$email' ORDER BY ticketId DESC";
                $runQuery = mysqli_query($conn, $getTickets);

                if (mysqli_num_rows($runQuery) > 0) {
                  // code...
                  while($row = mysqli_fetch_array($runQuery)) {
                    echo "
                      <div class='panel'>
                        <div class='panel-body'>
                          <div class='panel-user'>
                            <div class='content'>
                              <h4> ".$row['subject']." </h4>
                              <div class='time'>
                                <b>  </b>
                              </div>
                              <div class='date'>
                                ".$row['dateCreated']."
                              </div>
                              <div class='text'>
                                ".$row['message']."
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    ";
                  }
                }

              ?>
            </div>
            <div class="mail-view">

              <div class="empty-state --center">
                <div class="row">
                  <div class="col-12">
                    <i data-feather="inbox"></i>
                    <h5> no ticket to preview yet </h5>
                    <a class="cd-popup-trigger"> click here to get started </a>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- popup -->

    <div class="cd-popup" role="alert">
      <div class="cd-popup-container cd-popup-container-sm">
        <form class="" action="" method="post" id="ticketform">
          <span class="cd-popup-title"> Create a Ticket </span>

          <div class="cd-popup-body">
            <div class="cd-content">
              <div class="row">
                <div class="col-12">
                  <label for="" class="label "> Subject </label>
                  <input type="text" class="txt-input subject" placeholder="enter subject to your message" name="subject">
                  <small style="text-align: right; color: red" class="error-subject"></small>
                </div>
                <div class="col-12">
                  <label for="" class="label "> Message </label>
                  <textarea name="msg" class="txt-textarea msg" placeholder="enter your message" ></textarea>
                  <small style="text-align: right; color: red" class="error-msg"></small>
                </div>
                <div class="col-6 col-md-6 col-sm-12">
                  <input type="hidden" class="userId" value="<?php echo $userId; ?>"  name="userId">
                  <input type="hidden" class="userPhone" value="<?php echo $phone; ?>" name="userPhone"/>
                  <input type="hidden" class="userEmail" value="<?php echo $email; ?>" name="userEmail"/>
                  <input type="hidden" class="userName" value="<?php echo $name; ?>" name="userName"/>
                </div>
              </div>
            </div>
          </div>
          <div class="cd-buttons">
            <span class="btn --btn-flat close"> close</span>
            <button type="submit" name="button" class="btn --btn-primary" onclick="updateDiv()">Create Ticket </button>
          </div>

          <a href="#0" class="cd-popup-close img-replace"></a>
        </form>

      </div> <!-- cd-popup-container -->
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script type="text/javascript">
      $("#ticketform").on("submit", function(e) {
        // e.preventDefault();
        $('.error-subject').html('');
        $('.error-msg').html('');
        $('#message').html('');

        var subject = $(".subject").val();
        var msg = $(".msg").val();
        var userPhone = $(".userPhone").val();
        var userEmail = $(".userEmail").val();
        var userName = $(".userName").val();
        var userId = $(".userId").val();

        if($(".subject").val()==""){
          $(".error-subject").html("Please enter the subject.");
          $(".error-subject").css("color", "red");
          $(".subject").focus();
        } else if ($(".msg").val() == "") {
          $(".error-msg").html("Please enter your message.");
          $(".error-msg").css("color", "red");
          $(".msg").focus();
        } else {
          $.ajax({
            type: "POST",
            url:"functions/createTicket.php",
            data: {
              "subject":subject,
              "msg":msg,
              "userPhone":userPhone,
              "userEmail":userEmail,
              "userName":userName,
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
               $('.cd-popup').removeClass('is-visible');
              }
            }
          })
        }
        e.preventDefault();
      })

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
        $( ".email-listing" ).load(window.location.href + " .email-listing" );
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
