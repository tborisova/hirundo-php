<?php

  require_once("functions/session.php");
  require_once("classes/class.user.php");
  require_once("classes/class.message.php");
  require_once("classes/class.db_operations.php");

  if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
  }else{
    $user_id = $_SESSION['user_id'];
  }

  $db_operation = new DB_OPERATION();

  $userRow = $db_operation->executeQuery("SELECT user_email
                                FROM users WHERE user_id=:user_id",
                                array(":user_id"=>$user_id));


  $userTweets = $db_operation->executeQuery("SELECT tweets.user_id as t_user_id, content, users.image_url, users.user_name from tweets join users on tweets.user_id=users.user_id where  tweets.user_id = :user_id order by id desc",
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
            <h2 class="panel-title">Tweets from <?php echo $userRow['user_email']?></h2>
          
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
