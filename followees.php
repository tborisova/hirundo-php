<?php

  require_once("functions/session.php");
  require_once("classes/class.user.php");
  require_once("classes/class.message.php");
  require_once("classes/class.db_operations.php");

  $user_id = $_SESSION['user_session'];
  $db_operation = new DB_OPERATION();

  $userRow = $db_operation->executeQuery("SELECT *
                                FROM users WHERE user_id=:user_id",
                                array(":user_id"=>$user_id))[0];


  $followees = $db_operation->executeQuery("SELECT user_id, user_email, image_url
                                          from users join follows on
                                          user_id = followee_id where follower_id = :user_id",
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
        include('shared/user_info.php');?>
      </aside>

      <section class="column-center">
        <div class="panel">
          <div class="panel-body">
            <h2 class="panel-title">Users you follow:</h2>
            
              <?php
              foreach ($followees as $row) {
                echo
                '<div class="tweet_message"><a href=profile.php?user_id='.$row['user_id'].'><img class="user-three" src='.$row["image_url"].'></a><i>'.$row["user_email"].
                '<form method="post" action="functions/unfollow.php">
                  <input id="tweet" type="hidden" name="followee" value='.$row["user_id"].'>
                  <br/>
                  <br/>
                  <input type="submit" value="Unfollow" name="btn-unfollow" class="tweetbutton"s>
                </form></div><hr class="style-two"/>';
                }
              ?>
            </div>
          </div>
      </section>
      <?php include('shared/who_to_follow.php');?>
    </main>
  </body>
</html>
