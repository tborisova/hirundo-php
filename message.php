<?php

  require_once("session.php");  
  require_once("classes/class.user.php");
  require_once("classes/class.message.php");
  $user_id = $_SESSION['user_session'];
  $message = new Message($user_id);
  
  if(isset($_POST['btn-tweet']))
  {
    $content = strip_tags($_POST['message']);
    $recepient_id = strip_tags($_POST['recepient_id']);
    if(empty($message) == true){
      $error = "Message is empty!";
    }else{
      $message->addPrivateMessage($content, $recepient_id);
    }
    header("Location: home.php");
  } 
?>
