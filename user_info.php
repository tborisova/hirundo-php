<?php

  require_once("session.php");  
  require_once("classes/class.user.php");
  require_once("classes/class.message.php");
  require_once("classes/class.db_operations.php");

  if(isset($parent_page) && (strpos($parent_page, 'home.php') !== false || strpos($parent_page, 'account_settings.php') !== false || strpos($parent_page, 'followees.php') !== false || strpos($parent_page, 'who_to_follow.php') !== false)){
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


<img class="user one" src="https://s-media-cache-ak0.pinimg.com/236x/e4/fa/53/e4fa53ab96509501880f20faeac2556a.jpg">
<div id="user-info">
  <p>
  Tweets <a href="user_profile.php"><?php echo $count_of_tweets['count'] ?></a>
  </p>
  <p>
  Follows <a href="tweets_from_user.php"><?php echo $count_of_followees['count'] ?> people</a>
  </p>
  <p><?php echo $userRow['user_email'];?></p>
  <p><?php echo $userRow['description'];?></p>
  <p>From: <?php echo $userRow['address'];?></p>
  <p>WebSite: <?php echo $userRow['website'];?></p>
  <p>Joined at: <?php echo  date("jS F, Y", strtotime($userRow['created_at']));?></p>
  <a href="tweet_to.php/<?php echo $user_id?>" class="tweetbutton" title="Tweet to @jsnwr">Tweet to <?php echo $userRow['user_name']?></a>
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