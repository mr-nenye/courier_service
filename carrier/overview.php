
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


  $itemId = $_GET['q'];

 ?>

<!DOCTYPE html>
<html lang='en' dir='ltr'>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1' />
    <title> Welcome to your Carrier home - Dashboard </title>
    <link rel='stylesheet' href='assets/css/custom.css'>
    <link rel='stylesheet' href='assets/css/flexgrid.css'>
    <script src='https://unpkg.com/feather-icons'></script>
  </head>
  <body>

    <div class=''>
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
      <div class='menuIcon'>
          <span class='icon icon-bars'></span>
          <span class='icon icon-bars overlay'></span>
      </div>
      <!-- overlay mobile menu -->
      <div class='overlay-menu'>
        <ul id='menu'>
            <li><a href='#home'>Home</a></li>
            <li><a href='#services'>Services</a></li>
            <li><a href='#about'>About</a></li>
            <li><a href='#contact'>Contact</a></li>
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
          <?php

            $getDetails = "SELECT DISTINCT * FROM biditem
            WHERE sellerId = $userId AND itemId = $itemId";
            $run = mysqli_query($conn, $getDetails);

            if (mysqli_num_rows($run) > 0 ) {
              // code...
              while ($roc = mysqli_fetch_array($run)) {
                  echo"
          <div class='data_layer'>
            <div class='data'>
              <div class='data-header'>
                <div class='content-box'>
                  <div class='content-box--header'>
                    <i data-feather='activity'></i>
                    <span> Request Information </span>
                  </div>
                  <div class='row'>
                    <div class='col-6 col-md-6 col-sm-12'>
                      <label for='' class='label '> Item name </label>
                      <p>".$roc['name']."</p>
                    </div>
                    <div class='col-6 col-md-6 col-sm-12'>
                      <label for='' class='label '> Category </label>
                      <p> ".$roc['category']." </p>
                    </div>
                    <div class='col-6 col-md-6 col-sm-12'>
                      <label for='' class='label '> Pickup address </label>
                      <p> ".$roc['fromaddress']." </p>
                    </div>
                   <div class='ol-6 col-md-6 col-sm-12'>
                     <label for='' class='label '> Pickup state </label>
                     <p> ".$roc['fromstate']." </p>
                   </div>
                 </div>
                </div>
                <div class='content-box'>
                  <div class='content-box--header'>
                    <i data-feather='users'></i>
                    <span> Recievers' Information </span>
                  </div>
                  <div class='row'>
                    <div class='col-6 col-md-6 col-sm-12'>
                      <label for='' class='label '> Recipient name </label>
                      <p> ".$roc['recievername']." </p>
                    </div>
                     <div class='col-6 col-md-6 col-sm-12'>
                       <label for='' class='label '> Recipient phone number </label>
                       <p> ".$roc['recieverphone']." </p>
                     </div>
                     <div class='col-6 col-md-6 col-sm-12'>
                      <label for='' class='label '> Destination address </label>
                      <p> ".$roc['toaddress']." </p>
                     </div>
                     <div class='col-6 col-md-6 col-sm-12'>
                       <label for='' class='label '> Destination state </label>
                       <p> ".$roc['tostate']." </p>
                     </div>
                      <div class='col-6 col-md-6 col-sm-12'>
                        <label for='' class='label '> Quantity </label>
                        <p> ".$roc['quantity']." </p>
                      </div>
                     <div class='col-6 col-md-6 col-sm-12'>
                       <label for='' class='label '> Starting price </label>
                       <p> ".$roc['startprice']." </p>
                     </div>
                  </div>
                </div>

              </div>
            </div>
            <div class='' id='map'>
              <iframe class='map' src='https://www.google.com/maps/embed/v1/directions?&origin=".$roc['fromstate']."&destination=".$roc['tostate']."&key=AIzaSyCUSDfomnwJIkuO7qA3zgNwfU8G94tB4X4'></iframe>
            </div>
          </div>";
            }
          }

           ?>
        </div>
      </div>


    </div>
    <script type='text/javascript'>
      goBack = () => {
        window.history.back();
      }
      feather.replace()


      function initMap () {
        var styledMapType = new google.maps.StyledMapType (
          [
              {
                  "featureType": "landscape.natural",
                  "elementType": "geometry.fill",
                  "stylers": [
                      {
                          "visibility": "on"
                      },
                      {
                          "color": "#e0efef"
                      }
                  ]
              },
              {
                  "featureType": "poi",
                  "elementType": "geometry.fill",
                  "stylers": [
                      {
                          "visibility": "on"
                      },
                      {
                          "hue": "#1900ff"
                      },
                      {
                          "color": "#c0e8e8"
                      }
                  ]
              },
              {
                  "featureType": "road",
                  "elementType": "geometry",
                  "stylers": [
                      {
                          "lightness": 100
                      },
                      {
                          "visibility": "simplified"
                      }
                  ]
              },
              {
                  "featureType": "road",
                  "elementType": "labels",
                  "stylers": [
                      {
                          "visibility": "off"
                      }
                  ]
              },
              {
                  "featureType": "transit.line",
                  "elementType": "geometry",
                  "stylers": [
                      {
                          "visibility": "on"
                      },
                      {
                          "lightness": 700
                      }
                  ]
              },
              {
                  "featureType": "water",
                  "elementType": "all",
                  "stylers": [
                      {
                          "color": "#7dcdcd"
                      }
                  ]
              }
          ],
          {name: 'Styled Map'})

          var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 55.647, lng: 37.581},
          zoom: 20,
          mapTypeControlOptions: {
            mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
                    'styled_map']
          }
          });

          map.mapTypes.set('styled_map', styledMapType);
          map.setMapTypeId('styled_map');

        }
    </script>
  </body>
</html>
