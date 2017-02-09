<?php

  require_once("session.php");  
  require_once(__DIR__."/../classes/class.user.php");
  require_once(__DIR__."/../classes/class.message.php");

  $user_id = $_SESSION['user_session'];
  $message = new Message($user_id);
  
  if(isset($_POST['btn-tweet']))
  {
    $tweet = strip_tags($_POST['message']);
    if(empty($tweet) == true){
      $error = "Message is empty!";
    }else{
      $message->addMessage($tweet);
    }
  
    header("Location: ".$_SERVER['HTTP_REFERER']);
  } 
?>
