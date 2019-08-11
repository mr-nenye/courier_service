<?php
require 'dbcon.php';

session_start();

$userId = $_SESSION['id'];

function formatDate($date) {
  return date('F j, Y, g:i a', strtotime($date));
}

  // Set timezone
  date_default_timezone_set("UTC");

  // Time format is UNIX timestamp or
  // PHP strtotime compatible strings
  function dateDiff($time1, $time2, $precision = 1) {
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
      $time2 = strtotime($time2);
    }

    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
      $ttime = $time1;
      $time1 = $time2;
      $time2 = $ttime;
    }

    // Set up intervals and diffs arrays
    $intervals = array('year','month','day','hour','minute','second');
    $diffs = array();

    // Loop thru all intervals
    foreach ($intervals as $interval) {
      // Create temp time from time1 and interval
      $ttime = strtotime('+1 ' . $interval, $time1);
      // Set initial values
      $add = 1;
      $looped = 0;
      // Loop until temp time is smaller than time2
      while ($time2 >= $ttime) {
        // Create new temp time from time1 and interval
        $add++;
        $ttime = strtotime("+" . $add . " " . $interval, $time1);
        $looped++;
      }

      $time1 = strtotime("+" . $looped . " " . $interval, $time1);
      $diffs[$interval] = $looped;
    }

    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
      // Break if we have needed precission
      if ($count >= $precision) {
        break;
      }
      // Add value and interval
      // if value is bigger than 0
      if ($value > 0) {
        // Add s if value is not 1
        if ($value != 1) {
          $interval .= "s";
        }
        // Add value and interval to times array
        $times[] = $value . " " . $interval;
        $count++;
      }
    }

    // Return string with times
    return implode(", ", $times);
  }

// to get the name of user u are chatting with
$queryOne = "SELECT *, (SELECT name FROM users WHERE userid = '".$_POST["receiver_id"]."' ) as msgGeta FROM chats WHERE sender = '".$_POST["sender_id"]."' AND receiver = '".$_POST["receiver_id"]."' ";
$resultOne = mysqli_query($conn, $queryOne);
 if (mysqli_num_rows($resultOne) > 0) {
   while($row = mysqli_fetch_array($resultOne)) {
     $chatBuddy = $row['msgGeta'];
   }
 }

//select.php
if(isset($_POST["receiver_id"]) && isset($_POST["sender_id"]) ) {
 $output = '';
 $query = "SELECT * FROM chats WHERE sender = $userId AND receiver = '".$_POST["receiver_id"]."' OR sender = '".$_POST["receiver_id"]."' AND receiver = $userId";
 $result = mysqli_query($conn, $query);
 if (mysqli_num_rows($result) > 0) {
      $output .= "
      <input type='hidden' value='$userId' class='sender' name='sender' />
      <input type='hidden' value='".$_POST["receiver_id"]."' class='receiver' name='receiver' />
        <div class=''>
        <div class='panel chat-panel'>
          <div class='panel-message-header'>
            <div class='panel-user'>
              <div class='avatar'>
              <span>
            ";
            $words = explode(" ", $chatBuddy);
            $acronym = "";

            foreach ($words as $w) {
              $acronym .= $w[0];
            }

            $output .= $acronym;

            $output .=  "
              </span>
              </div>
              <div class='content'>
                <h4> ".$chatBuddy." </h4>
                <div class='time'>
                  Active Right Now
                </div>
              </div>
            </div>
          </div>
          <div class='message-content'>
            <div class='message-chat'>";
      while($row = mysqli_fetch_array($result)) {
        if ($row['sender'] === $userId) {

          $output .= "<div class='message you'>
            <div class=''>
              <div class='txt'>
                ".$row['message']."
              </div>
            </div>
            <div class='date'>
              ".dateDiff($row['timeStam'], "now")."
            </div>
          </div>";
        }else {
          $output .= "
          <div class='message'>
             <div class=''>
               <div class='txt'>
                 ".$row['message']."
               </div>
             </div>
             <div class='date'>
               ".dateDiff($row['timeStam'], "now")."
             </div>
           </div>
          ";
        }
      }
      $output .= "
      <div class='msg_insert'></div>
      </div>
    </div>
    <div class='message-form'>
      <input type='text' name='myMsg' class='msg-form myMsg' placeholder='Type a message ...' value=''>
      <div class='send'>
        <i data-feather='send'></i>
      </div>
    </div>
  </div></div>";
      echo $output;
 }
}
?>

<script src="https://unpkg.com/feather-icons"></script>
<script>
  feather.replace()

    $(".message-content").scrollTop($(".message-content")[0].scrollHeight)
  // var element = document.getElementById("yourDivID");
  // element.scrollTop = element.scrollHeight
</script>
