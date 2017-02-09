<?php
  require_once("functions/session.php");
  require_once("classes/class.user.php");
  require_once("classes/class.message.php");
  require_once("classes/class.db_operations.php");

  $user_id = $_SESSION['user_session'];
  $user = new USER();
  $db_operation = new DB_OPERATION();
  $userRow = $db_operation->executeQuery("SELECT *
                                FROM users WHERE user_id=:user_id",
                                array(":user_id"=>$user_id))[0];


  if(isset($_POST['btn-update-profile'])){
    $uname = strip_tags($_POST['name']);
    $umail = strip_tags($_POST['email']);
    $old_password = strip_tags($_POST['old_password']);
    $new_password = strip_tags($_POST['new_password']);  
    $new_password_confirmation = strip_tags($_POST['new_password_confirmation']);  
    $description = strip_tags($_POST['description']);
    $address = strip_tags($_POST['address']);
    $image_url = strip_tags($_POST['image_url']);
    $website = strip_tags($_POST['website']);
    
    $errors = $user->update_profile($user_id, array(":uname" => $uname,
                                                    ":email" => $umail,
                                                    ":description" => $description,
                                                    ":website" => $website,
                                                    ":address" => $address,
                                                    ":image_url" => $image_url),
                                    $new_password);

  }
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

            <h2 class="panel-title">Edit Account Information</h2>

            <?php

              if(isset($errors) && !empty($errors)){
                echo '<div class="errors">
                        <ul>';
                foreach($errors as $error){
                  echo '<li>'.$error.'</li>';
                }
                echo '</ul>
                </div>';
              }
            ?>

            <form method="post" id="login-form" action="account_settings.php">


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
                  <input type="password" name="old_password">
                </div>

                <div class="inputs">
                  <label for="name">New Password</label>
                  <input type="password" name="new_password">
                </div>

                <div class="inputs">
                  <label for="name">New Password Confirmation</label>
                  <input type="password" name="new_password_confirmation">
                </div>
              </fieldset>


              <input type="submit" value="Update" name="btn-update-profile" class="tweetbutton">

            </form>
          </div>
        </div>
      </section>
      <?php include('shared/who_to_follow.php');?>
    </main>
  </body>
</html>
