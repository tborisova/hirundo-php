<?php

  require_once("session.php");
  require_once("classes/class.user.php");
  $auth_user = new USER();
  
  if(isset($_POST['btn-unfollow'])){
    $auth_user->unfollow(strip_tags($_POST['followee']));
    header("Location: home.php");
  }
?>
