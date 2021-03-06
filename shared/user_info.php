<?php

  require_once(__DIR__."/../functions/session.php");
  require_once("classes/class.user.php");
  require_once("classes/class.message.php");
  require_once("classes/class.db_operations.php");

  if(isset($parent_page) && (strpos($parent_page, 'home.php') !== false || strpos($parent_page, 'account_settings.php') !== false || strpos($parent_page, 'followees.php') !== false || 
    strpos($parent_page, 'who_to_follow.php') !== false  || strpos($parent_page, 'profile.php') != false || 
    strpos($parent_page, 'messages.php') != false)){
    $user_id = $_SESSION['user_session'];
  }else{
    $user_id = $_GET['user_id'];
  }

  $db_operation = new DB_OPERATION();

  $userRow = $db_operation->executeQuery("SELECT *
                                FROM users WHERE user_id=:user_id",
                                array(":user_id"=>$user_id))[0];


  $count_of_tweets = $db_operation->executeQuery("SELECT count(id) as count
                                                  FROM tweets WHERE
                                                  user_id=:user_id", array(":user_id"=>$user_id))[0];



  $count_of_followees = $db_operation->executeQuery("SELECT count(id) as count
                                                      FROM follows WHERE
                                                      follower_id=:user_id", array(":user_id"=>$user_id))[0];

?>

<div class="panel">

  <div class="user">
    <div class="user-photo">
      <?php if ($userRow['image_url'] == "Add URL of profile image"): ?>
        <img src="img/default.jpg">
      <?php else: ?>
        <img src=<?php echo $userRow['image_url']?>>
      <?php endif; ?>
    </div>

    <div class="user-details">
      <p>
      Tweets <a href="tweets_from_user.php?user_id=<?php echo $user_id?>"><?php echo $count_of_tweets['count'] ?></a>
      </p>
      <p>
      Follows <a href="following.php?user_id=<?php echo $user_id?>"><?php echo $count_of_followees['count'] ?> people</a>
      </p>
      <p>Name: <?php echo $userRow['user_name'];?></p>
      <p><?php echo $userRow['user_email'];?></p>
      <p><?php echo $userRow['description'];?></p>
      <p>From: <?php echo $userRow['address'];?></p>
      <p>WebSite: <?php echo $userRow['website'];?></p>
      <p>Joined at: <?php echo  date("jS F, Y", strtotime($userRow['created_at']));?></p>
      <?php
        if(isset($follows['count'])){
          if($follows == '1'){
            echo '<form method="post" action="unfollow.php">
              <input id="tweet" type="hidden" name="followee" value='.$userRow["user_id"].'>
              <br/>
              <br/>
              <input type="submit" value="Unfollow" name="btn-unfollow" class="tweetbutton"s>
            </form></div><hr class="style-two"/>';
          }else{
            echo '<form method="post" action="follow.php">
          <input id="tweet" type="hidden" name="followee" value='.$userRow["user_id"].'>
          <br/>
          <br/>
          <input type="submit" value="Follow" name="btn-follow" class="tweetbutton"s>
        </form>';
          }
        }
      ?>
    </div>

    <div class="">
    <?php if($_SESSION['user_session'] != $userRow['user_id']){
      echo '<button type="button" id="tweet-to" class="button button-tweet-to">Send message</button>';
    }
    ?>
   
  </div>

</div>

<div class="dialog-wrapper">
  <div class="dialog panel">
    <button class="dialog-close">
      Close
    </button>

    <div class="panel-body">
      <h2 class="panel-title">Message to: <?php echo $userRow['user_email']?></h2>
      <form method="post" action="functions/message.php">
        <input type="hidden" name="recepient_id" value="<?php echo $userRow['user_id']?>">
        <textarea name="message" placeholder="Say something" class="tweet"></textarea>
        <input type="submit" class="button button-tweet-to simple" value="Send message" name="btn-tweet">
      </form>
    </div>
  </div>
</div>
