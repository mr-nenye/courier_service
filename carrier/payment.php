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

  $bidid = $_GET['q'];

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

      <div class="container-sm">
        <div class="row">
          <div class="col-12">
            <div class='request-card accepted full-width'>
              <header>
                <div>
                  <h3> Hi there, <br /> <h1><?php echo $name ?></h1></h3>
                </div>
                <img src="assets/img/paymentbox.svg" class="absolute" alt="" style="width: 200px; margin-top: 100px;">
              </header>

              <nav>
                <ul>
                  <li> <h3> Complete the below fields to make payments <br /> for your item to be shipped </h3> </li>
                  <div />
                  <li>
                    <span class='iconbtn round cd-popup-trigger white-bg' onclick="goBack();">
                      <span class='icon'><i data-feather='arrow-left'></i></span>
                      <span class='text'>GoBack</span>
                    </span>
                  </li>
                </ul>
              </nav>
            </div>
          </div>

          <p />

          <div class="page-title d-flex">
            <p class=""> Your Order </p>
            <span class="">
                <span class="icon"></span>
            </span>
            <!-- <div class="btn-sm --btn-primary icon">
              <i data-feather="edit-3"></i>
            </div> -->
          </div>

          <?php

          $getMyStuffs = "SELECT * FROM bidreport
          INNER JOIN biditem ON bidreport.productid = biditem.itemId
          WHERE bidid = $bidid ";
          $run = mysqli_query($conn, $getMyStuffs);

          $output = '';
          while ($row = mysqli_fetch_array($run)) {
            $output .= '<div class="col-12">
              <table class="list-view">
            		<thead>
            			<tr class="table100-head">
            				<th class="column1" style="width: 220px;">Item</th>
            				<th class="column2" style="width: 520px;">Carrier</th>
            				<th class="column3">quantity</th>
            				<th class="column4">Price</th>
            			</tr>
            		</thead>
            		<tbody>';

              $output .='<tr>
                <td class="column1"> '.$row["name"].' </td>
                <td class="column2"> jonn doe  <i> 08182994438 <i> </td>
                <td class="column3"> '.$row["quantity"].' </td>
                <td class="column4"> '.$row["startprice"].' </td>
              </tr>';
            $output .='</tbody>
            <tfoot>
            <tr>
              <td class="column1" colspan="3"> Order Total </td>
              <td class="column2">'.$row["startprice"].'</td>
            </tr>
            </tfoot>
            </table>
            </div>';
          }


            echo $output;

           ?>


          <div class="col-12">
            <input type="radio" class="form-radio role" id="check-radio-1" name="role" value="payonArrival" onclick="hide();"><label for="check-radio-1" class="medium"> Pay on arrival </label>
            <input type="radio" class="form-radio role" id="check-radio-2" name="role" value="payOnline" onclick="show();" ><label for="check-radio-2" class="medium"> Pay online </label>
            <small style="text-align: right; color: red" class="urole"></small>
          </div>

          <div class="col-12">
            <div class="categorys" id="categorys">
              <div id="paystackEmbedContainer"></div>
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
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script type="text/javascript">
      function show(){
        document.getElementById('categorys').style.display = 'block';
      }
      function hide(){
        document.getElementById('categorys').style.display = 'none';
      }

      goBack = () => {
        window.history.back();
      }
    </script>
    <script>
      PaystackPop.setup({
       key: 'pk_test_221221122121',
       email: 'customer@email.com',
       amount: 10000,
       container: 'paystackEmbedContainer',
       callback: function(response){
            alert('successfully subscribed. transaction ref is ' + response.reference);
        },
      });
    </script>
    <script>
      feather.replace()
    </script>
  </body>
</html>
