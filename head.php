<?php

  require_once("session.php");
  require_once("classes/class.user.php");
  require_once("classes/class.message.php");
  require_once("classes/class.db_operations.php");

  $user_id = $_SESSION['user_session'];

  $db_operation = new DB_OPERATION();

  $userRow = $db_operation->executeQuery("SELECT *
                                FROM users WHERE user_id=:user_id",
                                array(":user_id"=>$user_id))[0];

?>

<head>
  <link rel="stylesheet" type="text/css" href="css/style.css?version=10">
  <script src="js/jquery-3.1.1.min.js"></script>
  <script src="js/application.js"></script>
  <meta charset="UTF-8">
  <?php
    echo '<title>Welcome .'.$userRow['user_email'].'</title>';
  ?>
</head>
