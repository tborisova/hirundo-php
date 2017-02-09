<?php

  require_once(__DIR__."/../functions/session.php");
  require_once("classes/class.user.php");
  require_once("classes/class.message.php");
  require_once("classes/class.db_operations.php");

  $user_id = $_SESSION['user_session'];

  $db_operation = new DB_OPERATION();

  $userRow = $db_operation->executeQuery("SELECT *
                                FROM users WHERE user_id=:user_id",
                                array(":user_id"=>$user_id))[0];

  $usersToFollow = $db_operation->executeQuery("SELECT user_id, user_email, image_url from
                                                users WHERE user_id NOT
                                                IN(SELECT followee_id from
                                                follows where
                                                follower_id = :user_id) AND user_id != :user_id",
                                array(":user_id"=>$user_id));
?>


<aside class="column-right">
  <div class="panel">
        <?php
          if(empty($usersToFollow)){
            echo 'You follow all users here!';
          }else{
            foreach($usersToFollow as $row) {
              echo '<div class="tweet_message"><a href=profile.php?user_id='.$row['user_id'].'><img class="user-two" src='.$row["image_url"].'></a>'.$row["user_email"].
          '<form method="post" action="functions/follow.php">
            <input id="tweet" type="hidden" name="followee" value='.$row["user_id"].'>
            <br/>
            <br/>
            <input type="submit" value="Follow" name="btn-follow" class="tweetbutton"s>
          </form></div><hr class="style-two"/>';
            }
          }

        ?>
  </div>
</aside>