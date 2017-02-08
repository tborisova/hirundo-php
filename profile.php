<?php
  require_once("session.php");
  require_once("classes/class.user.php");
  require_once("classes/class.message.php");
  require_once("classes/class.db_operations.php");

  $db_operation = new DB_OPERATION();

  $user_id = $_GET['user_id'];

  $userRow = $db_operation->executeQuery("SELECT *
                                FROM users WHERE user_id=:user_id",
                                array(":user_id"=>$user_id))[0];

  $userTweets = $db_operation->executeQuery("SELECT * FROM tweets WHERE user_id=:user_id",
                                array(":user_id"=>$user_id));


  $follows = $db_operation->executeQuery("SELECT count(id) as count FROM follows
                                          WHERE follower_id=:follower_id AND followee_id=:followee_id",
                            array(":followee_id" => $user_id, "follower_id" => $_SESSION['user_session']));

?>

<!DOCTYPE HTML>
<html>
  <?php include('head.php') ?>
  <body>
    <?php include('navigation.html');?>

    <main class="container">
      <aside class="column-left">
          <?php
            // $parent_page = __FILE__;
            include('user_info.php');
          ?>
      </aside>
      <section class="column-center">
          <form method="post" action="tweet.php">
            <textarea name="message" placeholder="Tweet something to <?php echo $userRow['user_name']?>" class='tweet'></textarea>
            <input type="submit" class="button" value="Tweet" name="btn-tweet">
          </form>
            <?php
              foreach ($userTweets as $row) {
                echo
                  '<div class="tweet_message"><a href=profile.php?user_id='.$userRow['user_id'].'><img class="user-three" src='.$userRow["image_url"]."></a><i>".$userRow["user_name"].'</i> tweeted: '.$row["content"].'</div><hr class="style-two">';
              }
            ?>
      </section>
    </main>
  </body>
</html>
