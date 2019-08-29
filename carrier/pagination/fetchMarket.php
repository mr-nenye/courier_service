<?php
  include '../functions/dbcon.php';
  session_start();
  if (!isset($_SESSION['id'])) {
    header('location: login');
  }
  $userId = $_SESSION['id']; //current ID of logged in user
  $record_perpage = 10;

  // $getJoinItem = "SELECT * FROM biditem
  //                INNER JOIN users ON users.userid = biditem.sellerId
  //                INNER JOIN bidreport ON bidreport.productid = biditem.itemId
  //                WHERE biditem.itemname LIKE '%".$_POST['search']."%' AND bidreport.status = 0 GROUP BY bidreport.productid";

  $getJoinItem = "SELECT * FROM biditem WHERE itemname LIKE '%".$_POST['search']."%'";
  $runget = mysqli_query($conn, $getJoinItem);

  $output = '';

  if (mysqli_num_rows($runget) > 0) {
    // code...
    while($rec = mysqli_fetch_array($runget)) {

      $getJoinItem2 = "SELECT * FROM bidreport WHERE productid =" .$rec['itemId']." AND status = 1 ";
      $runget2 = mysqli_query($conn, $getJoinItem2);

      if (mysqli_num_rows($runget2) > 0) {
        // code...
        $output .='';
      }else {
        $output .='
        <div class="col-4 col-md-4 col-sm-12">
          <div class="custom-card">
            <div class="card-name">
              <h4> '.$rec["itemname"].' </h4>
            </div>
            <div class="card-info">
              <div>
                <small> FROM </small>
                <p>'.$rec["fromstate"].'</p>
              </div>
              <div>
                <small> TO </small>
                <p>'.$rec["tostate"].'</p>
              </div>
              <div class="">
                <small> CATEGORY </small>
                <p> '.$rec["category"].' </p>
              </div>
              <div class="">
                <p> '.$rec["startprice"].' </p>
              </div>

              <a href="makebid?q='.$rec["itemId"].'" class="actBtn iconbtn round" id="'.$rec["itemId"].'">
                  <span class="icon"><i data-feather="eye"></i></span>
                  <span class="text"> View </span>
              </a>
            </div>
          </div>
        </div>
        ';
      }



      $output .='
      <div class="cd-popup" role="alert">
       <div class="cd-popup-container cd-popup-container-sm">
          <form class="" action="" method="post" id="bidform">
           <span class="cd-popup-title"> Make Bid </span>

           <div class="cd-popup-body">
              <div class="cd-content" id="item_detail">
               <!-- display bid popup here -->
               <input type="hidden" class="txt-input userId" value="<?php echo $userId; ?>" placeholder="enter the name of the item" name="userId">
              </div>
            </div>
            <div class="cd-buttons">
              <span class="btn --btn-flat close"> Close</span>
              <button type="submit" name="button" class="btn --btn-primary"> Place Bid </button>
            </div>

           <a href="#0" class="cd-popup-close img-replace"></a>
          </form>

       </div>
      </div> ';

    }
    echo $output;
  } else{
    echo 'nothing to see here...';
  }


 ?>

 <script src="https://unpkg.com/feather-icons"></script>
 <script>
   feather.replace()
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
</script>
