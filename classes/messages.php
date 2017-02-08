<?php

  require_once("session.php");
  require_once("classes/class.user.php");
  require_once("classes/class.message.php");
  require_once("classes/class.db_operations.php");

  $user_id = $_SESSION['user_session'];

  $db_operation = new DB_OPERATION();

  $userRow = $db_operation->executeQuery("SELECT user_email
                                FROM users WHERE user_id=:user_id",
                                array(":user_id"=>$user_id));


  $receivedMessages = $db_operation->executeQuery("SELECT * from messages, 
                                                  users.user_email as t_user_email 
                                                  join users on messages.sender_id=users.user_id where 
                                                  recepient_id = :user_id order by id desc",
                                                  array(":user_id"=>$user_id));


  $sentMessages = $db_operation->executeQuery("SELECT * from messages where 
                                                  sender_id = :user_id order by id desc",
                                                  array(":user_id"=>$user_id));
?>

<!DOCTYPE HTML>
<html>
  <?php include('head.php') ?>
  <body>
    <?php include('navigation.html');?>

    <main class="container">

      <aside class="column-left">
        <?php
          $parent_page = __FILE__;
          include('user_info.php');
        ?>
      </aside>

      <section class="column-center">
        <div class="panel">
          <form method="post" action="tweet.php">
            <textarea name="message" placeholder="Tweet something" class="tweet"></textarea>
            <input type="submit" class="button" value="Tweet" name="btn-tweet">
          </form>
            <?php
              foreach ($receivedMessages as $row) {
                echo
                  '<div class="tweet_message"><a href=profile.php?user_id='.$row['t_user_email'].'><img class="user-three" src='.$row["image_url"]."></a><i>".$row["user_name"].'</i> sent yo: '.$row["content"].'</div><hr class="style-two">';
              }
            ?>
        </div>
      </section>
      <?php include('who_to_follow.php');?>
    </main>
  </body>
</html>
