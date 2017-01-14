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


  $followees = $db_operation->executeQuery("SELECT user_id, user_email 
                                          from users join follows on 
                                          user_id = followee_id where follower_id = :user_id", 
                                array(":user_id"=>$user_id));

?>

<!DOCTYPE HTML>
<html>
  <?php include('head.php') ?>
  <body>
    <?php include('navigation.html');?>
    <aside id="aside-left">
      <?php 
      $parent_page = __FILE__;
      include('user_info.php');?>      
    </aside>
    <section>
    
      <?php
      foreach ($followees as $row) {
        echo 
        '<div class="tweet_message"><img class="user-two" src="https://s-media-cache-ak0.pinimg.com/236x/e4/fa/53/e4fa53ab96509501880f20faeac2556a.jpg">'.$row["user_email"].
        '<form method="post" action="unfollow.php">
          <input id="tweet" type="hidden" name="followee" value='.$row["user_id"].'> 
          <br/>
          <br/>          
          <input type="submit" value="Unfollow" name="btn-unfollow" class="tweetbutton"s>
        </form></div><hr class="style-two"/>';
        }
      ?>
    </section>
  </body>
</html>
