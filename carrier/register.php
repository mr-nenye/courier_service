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
    <script src="https://unpkg.com/feather-icons"></script>
  </head>
  <body class="--bg-pattern">

    <div id="success-msg">
      <div class="alert alert-success">
        <div class="alert-container">
          <button type="button" class="close-icon" data-dismiss="alert" aria-label="Close">
                <span>clear</span>
          </button>
          <b class="alert-info">Success alert:</b> User successfully registered, go ahead and login
        </div>
      </div>
    </div>

    <div id="danger-msg">
      <div class="alert alert-danger">
        <div class="alert-container">
          <button type="button" class="close-icon" data-dismiss="alert" aria-label="Close">
                <span>clear</span>
          </button>
          <b class="alert-info">Danger alert:</b> Email already exist, Please try again
        </div>
      </div>
    </div>

    <div class="container">
      <div class="wrapper --marg-y-100">
        <p class="header-title"> <i class="lni-pencil-alt"></i> create your account </p>

        <form class="" action="" method="post" id="">
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
              <input type="radio" class="form-radio role" id="check-radio-1" name="role" value="commissioner" onclick="hide();"><label for="check-radio-1" class="medium"> commissioner </label>
              <input type="radio" class="form-radio role" id="check-radio-2" name="role" value="carrier" onclick="show();" ><label for="check-radio-2" class="medium"> Carrier </label>
              <small style="text-align: right; color: red" class="urole"></small>
            </div>

              <div class="categorys" id="categorys">
                <div class="row">
                  <div class="col-12">
                    <label for="" class="label font-oswald"> Courier category </label>
                  </div>
                  <div class="col-6 negMarginTop">
                    <input type="checkbox" class="form-checkbox" name="cate" id="check-one" value="Vehicles and Boats"><label for="check-one" class="medium">
                      Vehicles and Boats
                    </label>
                  </div>
                  <div class="col-6 negMarginTop">
                    <input type="checkbox" class="form-checkbox" name="cate" id="check-two" value="House hold items"><label for="check-two" class="medium">
                       House hold items
                     </label>
                   </div>
                   <div class="col-6 negMarginTop">
                    <input type="checkbox" class="form-checkbox" name="cate" id="check-thirteen" value="Moves"><label for="check-three" class="medium">
                      Moves
                    </label>
                  </div>
                  <div class="col-6 negMarginTop">
                    <input type="checkbox" class="form-checkbox" name="cate" id="check-four" value="Heavy equipments"><label for="check-four" class="medium">
                      Heavy equipments
                    </label>
                  </div>
                  <div class="col-6 negMarginTop">
                    <input type="checkbox" class="form-checkbox" name="cate" id="check-five" value="Freight"><label for="check-five" class="medium">
                      Freight
                    </label>
                  </div>
                  <div class="col-6 negMarginTop">
                    <input type="checkbox" class="form-checkbox" name="cate" id="check-six" value="Live animals"><label for="check-six" class="medium">
                      Live animals
                    </label>
                  </div>
                  <div class="col-6 negMarginTop">
                    <input type="checkbox" class="form-checkbox" name="cate" id="check-seven" value="Frozen items"><label for="check-seven" class="medium">
                      Frozen items
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row --center">
              <div class="col-12">
                <button>
                  <span class="iconbtn round cd-popup-trigger" id="regform">
                      <span class="icon"><i data-feather="user-plus"></i></span>
                      <span class="text">Create accouont</span>
                  </span>
                </button>
              </div>
            </div>
          </div>


        </form>

        <div class="--center">
          <p> Already have an account? <a href="login"> login now </a> </p>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script type="text/javascript">
      $("#regform").on("click",function(e){


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
            var role = $("input[name='role']:checked").val();

            if (role === 'carrier') {
              $('.categorys').css('display', 'block')
            }

            var categories = $("input[name='cate']:checked").map(function() {
                return this.value;
            }).get().join(', ');
            // var radioValue = $("input[name='gender']:checked").val();

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
                data:{"name":name,"password":password,"email":email,"phone":phone, "role":role, "categories":categories},
                success:function(result){
                  alert(result);
                if(result==0){
                  $("#danger-msg").css("display", "block");
                }else{
                  $("#success-msg").css("display", "block");
               }
              }

        });

      }

      e.preventDefault();


      });

      function show(){
        document.getElementById('categorys').style.display = 'block';
      }
      function hide(){
        document.getElementById('categorys').style.display = 'none';
      }
    </script>
    <script>
      feather.replace()
    </script>

  </body>
</html>
