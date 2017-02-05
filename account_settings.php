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
      <h2>Edit Account Information</h2>
        <div class="newspaper">
        <form method="post" id="login-form" action="change_profile.php">
          
          <fieldset id="inputs">
            <div class="inputs">
              <label for="email">Email</label>
              <input type="text" name="email" value='<?php echo $userRow["user_email"]?>'>
            </div>
            
            <div class="inputs">
              <label for="name">Name</label>
              <input type="text" name="name" value='<?php echo $userRow["user_name"]?>'> 
            </div>
            
            <div class="inputs">
              <label for="description">Description</label>
              <textarea name="description" placeholder='<?php echo $userRow["description"]?>'></textarea>
            </div>

            <div class="inputs">
              <label for="image_url">Image</label>
              <input type="text" name="image_url" value='<?php echo $userRow["image_url"]?>'> 
            </div>
            
            <div class="inputs">
              <label for="address">Address</label>
              <input type="text" name="address" value='<?php echo $userRow["address"]?>'> 
            </div>
            
            <div class="inputs">
              <label for="website">Website</label>
              <input type="text" name="website" value='<?php echo $userRow["website"]?>'> 
            </div>

            <div class="inputs">
              <label for="name">Current Password</label>
              <input type="text" name="old_password"> 
            </div>

            <div class="inputs">
              <label for="name">New Password</label>
              <input type="text" name="new_password"> 
            </div>
            
            <div class="inputs">
              <label for="name">New Password Confirmation</label>
              <input type="text" name="new_password_confirmation"> 
            </div>
          </fieldset>
          <fieldset id="actions">
          <input type="submit" value="Update" name="btn-update-profile" class="tweetbutton">
          </fieldset>        
        </form>
        </div>
    </section>
  </body>
</html>
