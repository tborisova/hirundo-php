<?php 
  function active_or_inactive($page){
    $current_page = explode(".php", basename($_SERVER['PHP_SELF']))[0];
    $page = strtolower($page);
    if($page == $current_page){
      return 'active';
    }else{
      return '';
    }
  }
?>
<header id="header">
  <div class="container">
    <nav id="nav">
      <ul>
        <li>
          <a href="home.php" class=<?php echo(active_or_inactive('home'));?>>Home</a>
        </li>
        <li>
          <a href="messages.php" class=<?php echo(active_or_inactive('messages'));?>>Messages</a>
        </li>
        <li>
          <a href="followees.php" class=<?php echo(active_or_inactive('followees'));?>>Followees</a>
        </li>
        <li>
          <a href="account_settings.php" class=<?php echo(active_or_inactive('account_settings'));?>>Settings</a>
        </li>
        <li>
          <a href="logout.php?logout=true" class=<?php echo(active_or_inactive('logout'));?>>Logout</a>
        </li>
      </ul>
    </nav>
  </div>
</header>