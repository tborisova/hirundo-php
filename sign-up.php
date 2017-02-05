<?php
session_start();
require_once('classes/class.user.php');

$user = new USER();

if($user->is_loggedin()!="")
{
	$user->redirect('home.php');
}

if(isset($_POST['btn-signup']))
{
	$uname = strip_tags($_POST['name']);
	$umail = strip_tags($_POST['email']);
	$upass = strip_tags($_POST['password']);	
  $upass_confirm = strip_tags($_POST['password_confirmation']);  
  $description = strip_tags($_POST['description']);
  $address = strip_tags($_POST['address']);
  $image_url = strip_tags($_POST['image_url']);
  $website = strip_tags($_POST['website']);
	
	if($umail=="")	{
		$error[] = "provide email id !";	
	}
	else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'Please enter a valid email address !';
	}
	else if($upass=="")	{
		$error[] = "provide password !";
	}
	else if(strlen($upass) < 6){
		$error[] = "Password must be atleast 6 characters";	
	}else if($upass != $upass_confirm){
    $error[] = "Password and Password Confirmation should match!"; 
  }
	else
	{
		try
		{
			$stmt = $user->runQuery("SELECT user_email FROM users WHERE user_email=:umail");
			$stmt->execute(array(':umail'=>$umail));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
				
			if($row['user_email']==$umail) {
				$error[] = "sorry email id already taken !";
			}
			else
			{
        if($user->register(array(":uname" => $uname,
                                 ":umail" => $umail,
                                 ":description" => $description,
                                 ":website" => $website,
                                 ":address" => $address,
                                 ":image_url" => $image_url), $upass))
        {
          $user->doLogin($uname,$umail,$upass);
          $user->redirect('home.php');
        }
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}	
}

?>

<!DOCTYPE HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link rel="stylesheet" href="css/style.css?version=10" type="text/css"  />
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/application.js"></script>
</head>

<html>
      <header id="header">      
      <div class="container">
        <nav id="nav">
          <ul>
            <li>
              <a href="#">Home</a>
            </li>
            <li>
              <a href="#">About</a>
            </li>
            <li id="login">
              <a id="login-trigger" href="#">
                Log in <span>▼</span>
              </a>
              <div id="login-content" class="hidden">
                <form method="post" id="login-form">
                  <fieldset id="inputs">
                    <input id="username" type="email" name="txt_uname_email" placeholder="Your email address" required> 
                    <input id="password" type="password" name="txt_password" placeholder="Password" required>
                  </fieldset>
                  <fieldset id="actions">
                    <input type="submit" id="submit" value="Log in" name="btn-login">
                  </fieldset>
                </form>
              </div>                     
            </li>
            <li id="signup">
              <a href="sign-up.php">Sign up</a>
            </li>
          </ul>
        </nav>
      </div>
    </header>

  <body>
    <aside id="aside-left">
    </aside>
    <section>
      <h2>Create new account</h2>
        <div class="newspaper">
        <form method="post" id="login-form">
          
          <fieldset id="inputs">
            <div class="inputs">
              <label for="email">Email</label>
              <input type="text" name="email">
            </div>
            
            <div class="inputs">
              <label for="name">Name</label>
              <input type="text" name="name"> 
            </div>
            
            <div class="inputs">
              <label for="description">Description</label>
              <textarea name="description" placeholder='Describe yourself...'></textarea>
            </div>

            <div class="inputs">
              <label for="image_url">Image</label>
              <input type="text" name="image_url" value='Add URL of profile image'> 
            </div>
            
            <div class="inputs">
              <label for="address">Address</label>
              <input type="text" name="address"> 
            </div>
            
            <div class="inputs">
              <label for="website">Website</label>
              <input type="text" name="website"> 
            </div>

            <div class="inputs">
              <label for="name">Password</label>
              <input type="password" name="password"> 
            </div>
            
            <div class="inputs">
              <label for="name">Password Confirmation</label>
              <input type="password" name="password_confirmation"> 
            </div>
          </fieldset>
          <fieldset id="actions">
          <input type="submit" value="Sign up" name="btn-signup" class="tweetbutton">
          </fieldset>        
        </form>
        </div>
    </section>
  </body>
</html>
