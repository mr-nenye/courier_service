
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
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title> Welcome to your Carrier home - Dashboard </title>
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/flexgrid.css">
    <link rel="stylesheet" href="https://cdn.lineicons.com/1.0.1/LineIcons.min.css">
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
                  <li><a href="#home">How it works</a></li>
                  <li><a href="services.html">About</a></li>
                  <li><a href="about.html">Help</a></li>
                  <li><a href="contact.html"> <i class="lni-user"></i> <?php echo $name; ?> </a></li>
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

      <div class="map-section">
        <small class="throwback-btn" onclick="goBack()"> <i class="lni-close"></i>   Close </small>
        <!-- <iframe src="https://maps.googleapis.com/maps/api/directions/json?origin=Abuja&destination=Lagos&key=AIzaSyDCbMg2d3Wu1jCbEyhp4tZuPEKuwdeM0ho" width="1660" height="500" frameborder="0" style="border:0" allowfullscreen></iframe> -->
        <!-- <iframe src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyDCbMg2d3Wu1jCbEyhp4tZuPEKuwdeM0ho&origin=Abuja&destination=Lagos" width="1660" height="500"></iframe> -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3940.3074910877867!2d7.4756708509614205!3d9.035689591338738!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x104e0b79da613c07%3A0x8c06400f40c0d846!2sArea+2+Shopping+Complex!5e0!3m2!1sen!2sng!4v1558508745467!5m2!1sen!2sng" width="1660" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
        <!-- <iframe src="https://www.google.com/maps/dir/25+Ibadan+St,+Garki,+Abuja/Area+2+Shopping+Complex,+Moshood+Abiola+Rd,+Garki,+Abuja/@9.0323783,7.4781263,17z/data=!3m1!4b1!4m13!4m12!1m5!1m1!1s0x104e0b81f1e3a0c1:0xea723118adf358ac!2m2!1d7.482707!2d9.0302869!1m5!1m1!1s0x104e0b79da613c07:0x8c06400f40c0d846!2m2!1d7.4778649!2d9.0356843" width="1660" height="500" frameborder="0" style="border: 0" allowfullscreen></iframe> -->
      </div>

      <div class="container">
        <div class="row">
          <div class="col-8 col-md-8 col-sm-12">
            <div class="row">
              <?php

                $getDetails = "SELECT * FROM biditem WHERE itemId = $itemId ";
                $run = mysqli_query($conn, $getDetails);

                if (mysqli_num_rows($run) > 0 ) {
                  // code...
                  while ($roc = mysqli_fetch_array($run)) {
                    // code...
                    echo "<div class='col-6 col-md-6 col-sm-12'>
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
               </div>";
                  }
                }

               ?>
            </div>
          </div>
          <div class="col-4 col-md-4 col-sm-12">
            <div class="row">
              <div class="col-12 col-md-12 col-sm-12">
                <label for="" class="label "> Courier image </label>
                <p> Placeholder text </p>
              </div>
              <div class="col-6 col-md-6 col-sm-12">
                <label for="" class="label "> Courier name </label>
                <p> Placeholder text </p>
              </div>
              <div class="col-6 col-md-6 col-sm-12">
                <label for="" class="label "> Courier phone number </label>
                <p> Placeholder text </p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <script type="text/javascript">
      goBack = () => {
        window.history.back();
      }
    </script>
  </body>
</html>
