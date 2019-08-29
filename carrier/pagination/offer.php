
<script src="https://unpkg.com/feather-icons"></script>
<script>
  feather.replace()
</script>
<?php

include '../functions/dbcon.php';
session_start();
if (!isset($_SESSION['id'])) {
  header('location: login');
}
$userId = $_SESSION['id']; //current ID of logged in user
$record_perpage = 10;
$page = '';
$output = '';

$itemId = $_POST['itemId'];

if (isset($_POST['page'])) {
  // code...
  $page = $_POST['page'];
} else{
  $page = 1;
}

$start_from = ($page - 1) * $record_perpage;

$getMyStuffs = "SELECT *  FROM bidreport
INNER JOIN users ON bidreport.bidder = users.userid
WHERE productid = $itemId LIMIT $start_from, $record_perpage";
$run = mysqli_query($conn, $getMyStuffs);

if (mysqli_num_rows($run) > 0) {
  // code...
  while($row = mysqli_fetch_array($run)) {
    if($row['status'] === '1') {
      $output .="<div class='col-4 col-md-4 col-sm-12'>
        <div class='request-card accepted'>
          <p>
            <i data-feather='truck'></i><span> Carrier info </span>
          </p>
          <header>
            <div>
              <h1> <i data-feather='user'></i> ".$row['name']."</h1>
              <h3> <i data-feather='phone'></i> ".$row['phone']." </h3>
            </div>
            <img src='assets/img/stamp.svg' class='absolute' alt='' style='width: 100px;'>
          </header><br />

          <span> Counter offer </span>
          <b><h1> <i data-feather='tag' style='width: 16px;'></i> ".$row['bidamount']." </h1></b>

          <nav>
            <ul>
              <li> <h3> BID ACCEPTED </h3> </li>
            </ul>
          </nav>
          <div>
            <a href='payment?q=".$row['bidid']."' class='iconbtn round cd-popup-trigger white-bg'>
              <span class='icon'><i data-feather='credit-card'></i></span>
              <span class='text'>Proceed to payment</span>
            </a>
          </div>
        </div>
      </div>";
    } elseif($row['status'] === '2') {
      $output .= "<div class='col-4 col-md-4 col-sm-12'>
        <div class='request-card rejected'>
          <p>
            <i data-feather='truck'></i><span> Carrier info </span>
          </p>
          <header>
            <div>
              <h1> <i data-feather='user'></i> ".$row['name']."</h1>
              <h3> <i data-feather='phone'></i> ".$row['phone']." </h3>
            </div>
          </header><br /><br />

          <span> Counter offer </span>
          <b><h1> <i data-feather='tag' style='width: 16px;'></i> ".$row['bidamount']." </h1></b>
        </div>
      </div>";
    } else {
      $output .="<div class='col-4 col-md-4 col-sm-12'>
        <div class='request-card'>
          <p>
            <i data-feather='truck'></i><span> Carrier info </span>
          </p>
          <header>
            <div>
              <h1> <i data-feather='user'></i> ".$row['name']."</h1>
              <h3> <i data-feather='phone'></i> ".$row['phone']." </h3>
            </div>
          </header><br /><br />

          <span> Counter offer </span>
          <b><h1> <i data-feather='tag' style='width: 16px;'></i> ".$row['bidamount']." </h1></b>

          <nav>
            <ul>
              <li>
                <form class='accptForm'>
                  <input type='hidden' class='accptId' value='".$row['productid']."' />
                  <input type='hidden' class='bidderId' value='".$row['userid']."' />

                  <button>
                    <span class='iconbtn round cd-popup-trigger' id='accptForm'>
                        <span class='icon'><i data-feather='check'></i></span>
                        <span class='text'>Accept Bid</span>
                    </span>
                  </button>
                </form>
              </li>
            </ul>
          </nav>


        </div>
      </div>";
    }
  }
}

$output .='<div class="pagination p2"> <ul>';

$page_query = "SELECT *  FROM bidreport
               INNER JOIN users ON bidreport.bidder = users.userid
               WHERE productid = $itemId";
$page_result = mysqli_query($conn, $page_query);
$total_records = mysqli_num_rows($page_result);
$total_pages = ceil($total_records/$record_perpage);

for($i=1; $i<=$total_pages; $i++) {
  $output .= "<a class='pagination_link'is-active id='".$i."'><li>".$i."</li></a>";
}

$output .='</ul></div>';

echo $output;


?>
