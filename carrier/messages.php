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
            <a href="dashboard">
              <i data-feather="home"></i>
              Dashboard
            </a>
            <a href="messages" class="active">
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
              <nav class="breadcrumb breadcrumb_type1" aria-label="Breadcrumb">
                <ol class="breadcrumb__list r-list">
                  <li class="breadcrumb__group">
                    <a href="#0" class="breadcrumb__point r-link">Dashboard</a>
                    <span class="breadcrumb__divider" aria-hidden="true">/</span>
                  </li>
                  <li class="breadcrumb__group">
                    <span class="breadcrumb__point" aria-current="page">My messages</span>
                  </li>
                </ol>
              </nav>
            </div>

            <div class="row">
              <div class="col-5 col-md-5 col-sm-12">
                <div class="page-title d-flex justify-content-between">
                  <p class=""> All Messages </p>
                  <span class="iconbtn round">
                      <span class="icon"><i data-feather="edit"></i></span>
                  </span>
                  <!-- <div class="btn-sm --btn-primary icon">
                    <i data-feather="edit-3"></i>
                  </div> -->
                </div>
                <?php
                  $getChats = "SELECT *, (SELECT name FROM users WHERE userid = receiver ) as msgGeta FROM chats WHERE sender = $userId GROUP BY receiver ORDER BY chatId DESC ";
                  $runChats = mysqli_query($conn, $getChats);

                  if (mysqli_num_rows($runChats) > 0) {
                    while($row = mysqli_fetch_array($runChats)) {
                      echo "
                      <div class='panel msg-panel' id=".$row['receiver']." data-sender-id=".$row['sender'].">
                        <div class='panel-body'>
                          <div class='panel-user'>
                            <div class='avatar'>
                              <span>
                            ";?>
                            <?php
                            $words = explode(" ", $row['msgGeta']);
                            $acronym = "";

                            foreach ($words as $w) {
                              $acronym .= $w[0];
                            }

                            echo $acronym;
                             ?>
                             <?php
                            echo"
                              </span>
                            </div>
                            <div class='content'>
                              <h4> ".$row['msgGeta']." </h4>
                              <div class='date'>
                                3 days ago
                              </div>
                              <div class='text'>
                                ".$row['message']."
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> <br />
                      ";
                    }
                  }else {
                    // code...
                    echo "
                    <div class='empty-state'>
                      <div>
                        <div class='col-7 col-md-7 col-sm-12 --center'>
                          <img src='assets/img/no-msg.svg' />
                        </div>
                        <div class='col-5 col-md-5 col-sm-12 --center'>
                          <h5> No file found </h5>
                          <span> Click on the <b> Create New Delivery </b> buttno to start  </span>
                        </div>
                      </div>
                    </div>
                    ";
                  }
                ?>

              </div>
              <div class="col-7 col-md-7 col-sm-12">
                <Form  id='chatForm'>
                  <div id="chat_view">
                    <!-- display chat histpry here... -->
                  </div>
                </fomr>
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

        let itemname = $(".itemname").val();
        let category = $(".category").val();
        let fromaddress = $(".fromaddress").val();
        let fromstate = $(".fromstate").val();
        let receivername = $(".receivername").val();
        let receiverphone = $(".receiverphone").val();
        let toaddress = $(".toaddress").val();
        let tostate = $(".tostate").val();
        let quantity = $(".quantity").val();
        let startprice = $(".startprice").val();
        let userId = $(".userId").val();

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

      $(document).on('click', '.msg-panel', function(){
        //$('#dataModal').modal();
        let receiver_id = $(this).attr("id");
        let sender_id = $(this).attr("data-sender-id");

        $.ajax({
         url:"functions/chatHistory.php",
         method:"POST",
         data:{receiver_id:receiver_id, sender_id:sender_id},
         success:function(data){
          $('#chat_view').html(data);
          $('.chat-panel').css('visibility', 'visible');
         }
        });
      });

      $("#bidform").on("submit", function(e) {
        // e.preventDefault();
        $('.error-oppoBid').html('');

        let oppoBid = $(".oppoBid").val();
        let item_id = $(".item_id").val();
        let userId = $(".userId").val();

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

      toggleDropMenu = () => {
        $(".dropmenu").toggleClass("active");
      }


        $('#chatForm').on("submit", function(e) {
          let myMsg = $(".myMsg").val();
          let sender = $(".sender").val();
          let receiver = $(".receiver").val();

          $("<div class='message you'><div class=''><div class='txt'>"+myMsg+"</div></div><div class='date'>now</div></div>").insertBefore('.msg_insert')
          $(".message-content").scrollTop($(".message-content")[0].scrollHeight);

          if($(".myMsg").val()=="") {

          }else {
            $.ajax({
              type: "POST",
              url:"functions/sendChat.php",
              data: {
                "myMsg":myMsg,
                "sender":sender,
                "receiver":receiver
              },
              success:function(result){
               if(result==0){
                 $("#message").html("An error occured. Item nor added");
                 $("#message").css("color", "red");
               } else{
                 // let myMsg = $(this).val();
                 // $('.msg-form').val() === "";
                 // $("<div class='message you'><div class=''><div class='txt'>"+myMsg+"</div></div><div class='date'>4 days ago</div></div>").insertBefore('.msg_insert');
                }
              }
            })
          }

          e.preventDefault();
        })
    </script>
    <script>
      feather.replace()
    </script>
  </body>
</html>
