<?php

  include 'functions/user.php';

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title> Login to you Carrier account </title>
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/flexgrid.css">
    <link rel="stylesheet" href="https://cdn.lineicons.com/1.0.1/LineIcons.min.css">
    <script src="https://unpkg.com/feather-icons"></script>
  </head>
  <body class="--bg-pattern">

    <div class="container-sm">
      <div class="wrapper --marg-y-100">
        <p class="header-title"> <i class="lni-unlock"></i> login to your account </p>
        <!-- <p class=" --pad-y-30">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p> -->

        <div class="" id="message">

        </div>

        <form class="" action="" method="post" id="">
          <div class="row">
            <div class="col-12">
            </div>
            <!-- <div class="col-12">
              <label for="" class="label font-oswald"> Role </label>
              <input type="text" class="txt-input role" value="commissioner" name="role" disabled>
            </div> -->
            <div class="col-12">
              <label for="" class="label font-oswald"> Email Address </label>
              <input type="email" class="txt-input email" placeholder="enter email address" name="email" >
              <small style="text-align: right; color: red" class="umail"></small>
            </div>
            <div class="col-12">
              <label for="" class="label font-oswald"> Password </label>
              <input type="password" class="txt-input password" placeholder="enter password" name="password">
              <small style="text-align: right; color: red" class="upass"></small>
            </div>
          </div>

          <div class="row --center">
            <div class="col-12">
              <button>
                <span class="iconbtn round cd-popup-trigger" id="loginform">
                    <span class="icon"><i data-feather="unlock"></i></span>
                    <span class="text">Login</span>
                </span>
              </button>
            </div>
          </div>
        </form>

        <div class="--center">
          <p> Don't have an account? <a href="register"> create one now </a> </p>
        </div>

      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script type="text/javascript">
      $("#loginform").on("click",function(e){


        $('.umail').html('');
        $('.upass').html('');
        $('#message').html('');

            var email=$(".email").val();
            var password=$(".password").val();
            if($(".email").val()==""){
                   $(".umail").html("Please enter email.");
                   $(".umail").css("color", "red");
                   $(".email").focus();
                 }

            else if($(".password").val()==""){
                  $(".upass").html("Please enter password.");
                   $(".upass").css("color", "red");
                  $(".password").focus();
            }
          else
          {
               $.ajax({
                type:"POST",
                url:"functions/auth.php",
                data:{"email":email, "password":password},
                success:function(result){
                  alert(result);
                 if(result==0){
                   $("#message").html("Invalid Email-id/Password");
                   $("#message").css("color", "red");
                   //alert("invalid")
                 }
                  else{
                  $("#message").html("Login successful");
                  $("#message").css("color", "green");
                    window.location.replace("dashboard")
               }
              }

        });

    }

    e.preventDefault();


      });
    </script>
    <script>
      feather.replace()
    </script>
  </body>
</html>
