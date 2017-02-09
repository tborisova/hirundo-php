<?php

  require_once("functions/session.php");
  require_once("classes/class.user.php");
  require_once("classes/class.message.php");
  require_once("classes/class.db_operations.php");
  $user_id = $_SESSION['user_session'];

  $db_operation = new DB_OPERATION();

  $userRow = $db_operation->executeQuery("SELECT user_email
                                FROM users WHERE user_id=:user_id",
                                array(":user_id"=>$user_id));


  $userTweets = $db_operation->executeQuery("SELECT tweets.user_id as t_user_id, content, users.image_url, users.user_name from tweets join users on tweets.user_id=users.user_id where tweets.user_id in (select followee_id from follows where follower_id = :user_id) OR tweets.user_id = :user_id order by id desc",
                                array(":user_id"=>$user_id));
?>

<!DOCTYPE HTML>
<html>
  <?php include('shared/head.php') ?>
  <body>
    <?php include('shared/navigation.php');?>

    <main class="container">

      <aside class="column-left">
        <?php
          $parent_page = __FILE__;
          include('shared/user_info.php');
        ?>
      </aside>

      <section class="column-center">
        <div class="panel">
          <form method="post" action="functions/tweet.php">
            <textarea name="message" placeholder="Tweet something" class="tweet"></textarea>
            <input type="submit" class="button" value="Tweet" name="btn-tweet">
          </form>
            <?php
              foreach ($userTweets as $row) {
                echo
                  '<div class="tweet_message"><a href=profile.php?user_id='.$row['t_user_id'].'><img class="user-three" src='.$row["image_url"]."></a><i>".$row["user_name"].'</i> tweeted: '.$row["content"].'</div><hr class="style-two">';
              }
            ?>
        </div>
      </section>
      <?php include('shared/who_to_follow.php');?>
    </main>
  </body>
</html>
