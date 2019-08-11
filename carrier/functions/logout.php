<?php

  session_start();
  unset($_SESSION['id']);
  session_destroy($_SESSION['id']);

  if (session_destroy()) {
    // code...
    header('location: ../login');
  }

 ?>
