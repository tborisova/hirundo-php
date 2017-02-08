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

    <main class="container">
      <aside class="column-left">
        <?php
        $parent_page = __FILE__;
        include('user_info.php');?>
      </aside>
      <section class="column-center">
        <div class="panel">
          <div class="panel-body">

            <h2 class="panel-title">Edit Account Information</h2>

            <div class="errors">
              <ul>
                <li>Missing email</li>
                <li>Missing name</li>
              </ul>
            </div>

            <form method="post" id="login-form" action="change_profile.php">


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


              <input type="submit" value="Update" name="btn-update-profile" class="tweetbutton">

            </form>


          </div>
        </div>
      </section>
    </main>
  </body>
</html>
