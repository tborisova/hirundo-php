<?php
session_start();
require_once("classes/class.user.php");
$login = new USER();

if($login->is_loggedin()!="")
{
	$login->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
	$uname = strip_tags($_POST['txt_uname_email']);
	$umail = strip_tags($_POST['txt_uname_email']);
	$upass = strip_tags($_POST['txt_password']);

	if($login->doLogin($uname,$umail,$upass))
	{
		$login->redirect('home.php');
	}
	else
	{
		$error = "Wrong Details !";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link rel="stylesheet" href="css/style.css?version=10" type="text/css"  />
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/application.js"></script>
</head>

<body>
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

                    <div class="inputs">
											<input id="username" type="email" name="txt_uname_email" placeholder="Your email address" required>
                    </div>
										<div class="inputs">
											<input id="password" type="password" name="txt_password" placeholder="Password" required>
										</div>

                    <input type="submit" id="submit" value="Log in" name="btn-login">
                
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

    <div class="content">
            <?php
                if(isset($error))
                {
                    ?>
                    <div class="alert" id="alert">
                        <div>
                        <span class="closebtn" id="closebtn">&times;</span>
                            <?php echo $error; ?>
                        </div>
                    </div>
                    <?php
                }
            ?>
        <center>
      <div class="container page-index">
        Easiest way to share
      </div>
      <div>
          <img class="image-index" src="https://abs.twimg.com/a/1482872295/img/t1/download_page_devices.png">
        </div>
        </center>
    </div>
</body>
</html>
