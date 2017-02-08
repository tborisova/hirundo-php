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


  $receivedMessages = $db_operation->executeQuery("SELECT receiver_id, sender_id,
                                                  message, user_email, user_name, image_url
                                                  from messages
                                                  join users on messages.sender_id=users.user_id where 
                                                  receiver_id = :user_id order by id desc",
                                                  array(":user_id"=>$user_id));


  $sentMessages = $db_operation->executeQuery("SELECT receiver_id, sender_id,
                                                  message, user_email, user_name, image_url
                                                  from messages
                                                  join users on messages.receiver_id=users.user_id where 
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
            <?php
              foreach ($receivedMessages as $row) {
                echo
                  '<div class="tweet_message"><a href=profile.php?user_id='.$row['user_email'].'><img class="user-three" src='.$row["image_url"]."></a><i>".$row["user_name"].'</i> sent you: '.$row["message"].'</div><hr class="style-two">';
              }

              foreach ($receivedMessages as $row) {
                echo
                  '<div class="tweet_message"><a href=profile.php?user_id='.$row['user_email'].'><img class="user-three" src='.$row["image_url"]."></a><i>You sent to ".$row["user_name"].': </i>'.$row["message"].'</div><hr class="style-two">';
              }
            ?>
        </div>
      </section>
      <?php include('who_to_follow.php');?>
    </main>
  </body>
</html>
