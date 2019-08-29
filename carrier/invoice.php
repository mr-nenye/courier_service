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

  // $itemId = $_GET['q'];

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


            <?php  if ($role === 'commissioner') {?>
                <p class="page-title"> My Offers </p>

            <?php  } elseif ($role === 'carrier') {?>
              <p class="page-title"> My Invoice </p>

              <div class="container-sm">
                <span class='iconbtn round cd-popup-trigger' onclick="printInvoice()">
                    <span class='icon'><i data-feather='printer'></i></span>
                    <span class='text'>Print invoice</span>
                </span>
                <div class="invoice">
                  <div class="invoice-header">
                    <div class="">
                      <p>logo</p>
                    </div>
                    <div class="align-right">
                      <p>Invoice</p>
                    </div>
                  </div>
                  <div class="invoice-meta">
                    <div class="">

                    </div>
                    <div class="align-right">
                      <p> ORDER #800000025 </p>
                      <p> MARCH 4TH 2016 </p>
                    </div>
                  </div>
                  <div class="">
                    <table>
                  		<thead>
                  			<tr class="table100-head">
                  				<th class="column1" style="width: 220px;">Item</th>
                  				<th class="column2" style="width: 520px;">Carrier</th>
                  				<th class="column3">quantity</th>
                  				<th class="column4">Price</th>
                  			</tr>
                  		</thead>
                  		<tbody>
                        <tr>
                          <td class="column1">name my item</td>
                          <td class="column2">Jonn Newmann</td>
                          <td class="column3">4</td>
                          <td class="column4">98,344</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="invoice-meta">
                    <div class="">

                    </div>
                    <div class="align-right">
                      <p> Grand Total: &nbsp; <b>98,344.00</b> </p>
                    </div>
                  </div>
                  <div class="invoice-meta">
                    <div class="">
                      <h3>BILLING INFORMATION</h3>
                      <small>Philip Brooks</small>
                      <small>Public Wales, Somewhere</small>
                      <small>New York NY</small>
                      <small>4468, United States</small>
                      <small>T: 202-555-0133</small>
                    </div>
                    <div class="align-right">
                      <h3>PAYMENT METHOD</h3>
                      <small>Credit Card</small>
                      <small>Credit Card Type: Visa</small>
                      <small>Worldpay Transaction ID: 4185939336</small>
                      <small>Right of Withdrawal</small>
                    </div>
                  </div>
                </div>
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
