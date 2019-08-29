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
      $address = $row['address'];
      $state = $row['state'];
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

            <div class="page__section">
              <nav class="breadcrumb breadcrumb_type1" aria-label="Breadcrumb">
                <ol class="breadcrumb__list r-list">
                  <li class="breadcrumb__group">
                    <a href="#0" class="breadcrumb__point r-link">Dashboard</a>
                    <span class="breadcrumb__divider" aria-hidden="true">/</span>
                  </li>
                  <li class="breadcrumb__group">
                    <span class="breadcrumb__point" aria-current="page">My Profile</span>
                  </li>
                </ol>
              </nav>
            </div>

            <p class="page-title"> My Profile </p>

            <div class="tabs">

              <input type="radio" id="tab1" name="tab-control" checked>
              <input type="radio" id="tab2" name="tab-control">
              <ul>
                <li title="Account setting"><label for="tab1" role="button"><br><span>Account setting</span></label></li>
                <li title="Password"><label for="tab2" role="button"><br><span>Password</span></label></li>
              </ul>

              <div class="" id="message">

              </div>

              <div class="content">
                <section class="">
                  <div class="container">
                    <div class="row">
                      <form method="post" id="editForm">
                        <div class="col-12">
                          <div class='request-card'>
                            <header class="no-space">
                              <div class="avatar"></div>
                              &nbsp;
                              &nbsp;
                              &nbsp;
                              <div>
                                <h1> <?php echo $name;  ?> </h1>
                                <span class="userprofile-mail"> <?php echo $email;  ?> </span> <br />
                                <small style="color: #3b40e4"> Change Avatar</small>
                              </div>
                            </header> <br /><br />

                            <div class="row">
                              <div class="col-6 col-md-6 col-sm-12">
                                <label for="" class="label font-oswald"> Full Name </label>
                                <input type="text" class="txt-input fname" placeholder="enter full name" name="fname" value="<?php echo $name;  ?>" autocomplete="off">
                                <small style="text-align: right; color: red" class="uname"></small>
                              </div>
                              <div class="col-6 col-md-6 col-sm-12">
                                <label for="" class="label font-oswald"> Email Address </label>
                                <input type="email" class="txt-input email" placeholder="enter email address" name="email" value="<?php echo $email;  ?>"  autocomplete="off">
                                <small style="text-align: right; color: red" class="umail"></small>
                              </div>
                              <div class="col-6 col-md-6 col-sm-12">
                                <label for="" class="label font-oswald"> Phone </label>
                                <input type="text" class="txt-input phone" placeholder="enter phone number" name="phone" value="<?php echo $phone;  ?>"  autocomplete="off">
                                <small style="text-align: right; color: red" class="uphone"></small>
                              </div>



                            </div>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class='request-card'>

                            <div class="row">

                              <h3> Address details </h3>

                              <div class="col-12">
                                <label for="" class="label font-oswald"> Full Address </label>
                                <input type="text" class="txt-input address" placeholder="enter full address" name="address" value="<?php echo $address ?>" autocomplete="off">
                                <small style="text-align: right; color: red" class="uaddress"></small>
                              </div>
                              <div class="col-6 col-md-6 col-sm-12">
                                <label for="" class="label "> State </label>
                                <select class="txt-input state" name="state" value="<? echo $state; ?>" autocomplete="off">
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
                                <input type="hidden" class="txt-input userId"  value="<?php echo $userId; ?>"  name="userId">
                              </div>

                            </div>

                            <div class="row">
                              <div class="col-6 col-md-6 col-sm-12">
                                <button >
                                  <span class="iconbtn round updtbtn">
                                      <span class="icon"><i data-feather="save"></i></span>
                                      <span class="text">Save changes</span>
                                  </span>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>

                    </div>
                  </div>
                </section>
                <section class="">
                  <div class="container">
                    <div class="row">
                      <form>
                        <div class="col-12">
                          <div class='request-card'>
                            <h3> Change password </h3>
                            <div class="row">
                              <div class="col-6 col-md-6 col-sm-12">
                                <label for="" class="label font-oswald"> New password </label>
                                <input type="password" class="txt-input newPassword" placeholder="enter new password" name="newPassword" value="" autocomplete="off">
                                <small style="text-align: right; color: red" class="unewpass"></small>
                              </div>
                              <div class="col-6 col-md-6 col-sm-12">
                                <label for="" class="label "> Confirm new passcode </label>
                                <input type="password" class="txt-input confirmNewPassword" placeholder="confirm new password" name="confirmNewPassword" value="" autocomplete="off">
                                <small style="text-align: right; color: red" class="uconNewpass"></small>
                              </div>
                              <div class="col-6 col-md-6 col-sm-12">
                                <button >
                                  <span class="iconbtn round updtbtn">
                                      <span class="icon"><i data-feather="key"></i></span>
                                      <span class="text">Changes password</span>
                                  </span>
                                </button>
                              </div>

                              <div class="col-6 col-md-6 col-sm-12">
                                <input type="hidden" class="txt-input userId"  value="<?php echo $userId; ?>"  name="userId">
                              </div>
                            </div>

                            <div class="row">

                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </section>
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
      $(".updtbtn").on("click", function(e) {
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

        var fname = $(".fname").val();
        var email = $(".email").val();
        var phone = $(".phone").val();
        var address = $(".address").val();
        var state = $(".state").val();
        var userId = $(".userId").val();

        console.log(name);

        $.ajax({
          type: "POST",
          url:"functions/updateprofile.php",
          data: {
            "fname":fname,
            "email":email,
            "phone":phone,
            "address":address,
            "state":state,
            "userId":userId
          },
          success:function(result){
           if(result==0){
             //alert("invalid");
             alert(result)
             $("#message").html("An error occured. Item not added");
             $("#message").css("color", "red");
           } else{
             alert(result)
             $("#message").html("Item added Successfully");
             $("#message").css("color", "green");
            }
          }
        })
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
