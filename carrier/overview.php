
<?php

  require 'functions/dbcon.php';

  session_start();

  $userId = $_SESSION['id'];

  echo $userId;

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
      <nav id='navbar' class='--navbar-fixed'>
          <div class='nav-wrapper'>
              <!-- Navbar Logo -->
              <div class='logo'>
                  <!-- Logo Placeholder for Inlustration -->
                  <a href='#home'>
                    <img src='assets/img/logo.png' width='60' alt=''>
                  </a>
              </div>

              <!-- Navbar Links -->
              <ul id='menu'>
                  <li><a href='services.html'> <i data-feather='message-square'></i> <span> 3 </span> </a></li>
                  <li><a href='about.html'> <i data-feather='bell'></i> <span> 1 </span> </a></li>
                  <!-- <li><a href='contact.html'> <i data-feather='user'></i> <?php echo $name; ?> </a></li> -->
                  <li>
                    <div class='user-info'>
                      <div class='avatar'>
                        <i data-feather='user'></i>
                      </div>
                      <div class='name'>
                        <?php echo $name; ?>
                      </div>
                    </div>
                  </li>
              </ul>
          </div>
      </nav>
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

      <?php

        $getDetails = "SELECT * FROM biditem WHERE itemId = $itemId ";
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
            <div class='content-box'>
              <div class='content-box--header'>
                <i data-feather='truck'></i>
                <span> Transporter Information </span>
              </div>


              <div class='row'>
                <div class='col-3 col-md-3 col-sm-12'>
                  <p class='avatar'>
                    <?php
                      echo substr('Hello world',0,5)
                     ?>
                  </p>
                </div>
                <div class='col-9 col-md-9 col-sm-12'>
                  <div class='row'>
                    <div class='col-6'>
                      <label for='' class='label '> Courier name </label>
                      <p> Placeholder text </p>
                    </div>
                    <div class='col-6'>
                      <label for='' class='label '> Courier phone number </label>
                      <p> Placeholder text </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class='' id='map'>
          <iframe src='https://www.google.com/maps/embed/v1/directions?&origin=".$roc['fromstate']."&destination=".$roc['tostate']."&key=AIzaSyCUSDfomnwJIkuO7qA3zgNwfU8G94tB4X4'></iframe>
        </div>
      </div>";
        }
      }

       ?>

    </div>
    <script type='text/javascript'>
      goBack = () => {
        window.history.back();
      }
      feather.replace()
    </script>
  </body>
</html>
