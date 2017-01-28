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

  $usersToFollow = $db_operation->executeQuery("SELECT user_id, user_email from 
                                                users WHERE user_id NOT 
                                                IN(SELECT followee_id from 
                                                follows where 
                                                follower_id = :user_id) AND user_id != :user_id", 
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
        if(empty($usersToFollow)){
          echo 'You follow all users here!';
        }else{
          foreach($usersToFollow as $row) {
            echo '<div class="tweet_message"><img class="user-two" src="https://s-media-cache-ak0.pinimg.com/236x/e4/fa/53/e4fa53ab96509501880f20faeac2556a.jpg">'.$row["user_email"].
        '<form method="post" action="follow.php">
          <input id="tweet" type="hidden" name="followee" value='.$row["user_id"].'> 
          <br/>
          <br/>          
          <input type="submit" value="Follow" name="btn-follow" class="tweetbutton"s>
        </form></div><hr class="style-two"/>';
          }
        }
          
      ?>
    </section>
  </body>
</html>


