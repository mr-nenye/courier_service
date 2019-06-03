<?php

  include 'functions/user.php';

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title> Register to Carrier as a driver or somthing </title>
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/flexgrid.css">
    <link rel="stylesheet" href="https://cdn.lineicons.com/1.0.1/LineIcons.min.css">
  </head>
  <body class="--bg-pattern">

    <div class="container-sm">
      <div class="wrapper --marg-y-100">
        <p class="header-title"> <i class="lni-pencil-alt"></i> create your account </p>

        <div id="message">
        </div>

        <form class="" action="" method="post" id="regform">
          <div class="row">
            <div class="col-12">
              <!-- <span class=""> Enter your information </span> -->
            </div>
            <div class="col-12">
              <label for="" class="label font-oswald"> Name </label>
              <input type="text" class="txt-input name" placeholder="enter your name / company name" name="name">
              <small style="text-align: right; color: red" class="uname"></small>
            </div>
            <div class="col-12">
              <label for="" class="label font-oswald"> Email Address </label>
              <input type="email" class="txt-input email" placeholder="enter email address" name="email">
              <small style="text-align: right; color: red" class="umail"></small>
            </div>
            <div class="col-12">
              <label for="" class="label font-oswald"> Phone number </label>
              <input type="text" class="txt-input phone" placeholder="enter phone number" name="phone" >
              <small style="text-align: right; color: red" class="uphone"></small>
            </div>
            <div class="col-12">
              <label for="" class="label font-oswald"> Password </label>
              <input type="password" class="txt-input password" placeholder="enter password" name="password">
              <small style="text-align: right; color: red" class="upass"></small>
            </div>
            <div class="col-12">
              <label for="" class="label font-oswald"> Role </label> <br>
              <input type="radio" class="form-radio role" id="check-radio" name="role" value="commissioner"><label for="check-radio" class="medium"> commissioner </label>
              <input type="radio" class="form-radio role" id="check-radio" name="role" value="carrier"><label for="check-radio" class="medium"> Carrier </label>
              <small style="text-align: right; color: red" class="urole"></small>
            </div>
            <!-- <div class="col-12">
              <label for="" class="label font-oswald"> Courier Category </label> <br>
              <input type="checkbox" class="form-checkbox" id="check-one"><label for="check-one" class="medium"> cate 1 </label>
              <input type="checkbox" class="form-checkbox" id="check-two"><label for="check-two" class="medium"> cate 2 </label>
              <input type="checkbox" class="form-checkbox" id="check-thirteen"><label for="check-three" class="medium"> cate 3 </label>
              <input type="checkbox" class="form-checkbox" id="check-four"><label for="check-four" class="medium"> cate 4 </label>
              <input type="checkbox" class="form-checkbox" id="check-five"><label for="check-five" class="medium"> cate 5 </label>
              <input type="checkbox" class="form-checkbox" id="check-six"><label for="check-six" class="medium"> cate 6 </label>
            </div> -->
          </div>

          <div class="row --center">
            <div class="col-12">
              <button class="btn --btn-primary" name="createBtn"> Register </button>
            </div>
          </div>
        </form>

        <div class="--center">
          <p> Already have an account? <a href="login.html"> login now </a> </p>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script type="text/javascript">
      $("#regform").on("submit",function(e){


        $('.uname').html('');
        $('.upass').html('');
        $('.umail').html('');
        $('.urole').html('');
        $('.uphone').html('');
        $('#message').html('');

            var name=$(".name").val();
            var password=$(".password").val();
            var phone = $(".phone").val();
            var email = $('.email').val();
            var role = $('.role').val();

            if($(".name").val()==""){
               $(".uname").html("Please enter username.");
               $(".uname").css("color", "red");
               $(".name").focus();
            }
            else if($(".email").val()==""){
              $(".umail").html("Please enter email.");
              $(".umail").css("color", "red");
              $(".email").focus();
            }
            else if($(".phone").val()==""){
              $(".uphone").html("Please enter mobile.");
              $(".uphone").css("color", "red");
              $(".phone").focus();
            }
            else if($(".password").val()==""){
              $(".upass").html("Please enter password.");
              $(".upass").css("color", "red");
              $(".password").focus();
            }
            else if ($(".role").val()==""){
              $(".urole").html("Please enter password.");
              $(".urole").css("color", "red");
            }
          else
          {
               $.ajax({
                type:"POST",
                url:"functions/registerUser.php",
                data:{"name":name,"password":password,"email":email,"phone":phone, "role":role},
                success:function(result){
                 if(result==0){
                    $("#message").html("Email allready exists.");
                     $("#message").css("color", "red");
                    }
                    else{
                    $("#message").html("Successfully register");
                    $("#message").css("color", "green");
               }
              }

        });

      }

      e.preventDefault();


      });
    </script>

  </body>
</html>
