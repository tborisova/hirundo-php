<?php

require_once(__DIR__.'/../db/dbconfig.php');

class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function register($params, $upass)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
			$stmt = $this->conn->prepare("INSERT INTO users(user_name, user_email, user_pass,
																	  description, address, website, image_url) 
		                                VALUES(:uname, :umail, :upass, :description, 
		                                :address, :website, :image_url)");
			$result = array_merge($params, array(":upass" => $new_password));
			$stmt->execute($result);
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	
	public function doLogin($uname, $umail, $upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT user_id, user_name, user_email, user_pass FROM users WHERE user_name=:uname OR user_email=:umail ");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				if(password_verify($upass, $userRow['user_pass']))
				{
					$_SESSION['user_session'] = $userRow['user_id'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function doLogout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}

	public function follow($followee_id)
	{

		$stmt = $this->conn->prepare("select follower_id, followee_id from follows where follower_id=:follower_id AND followee_id=:followee_id");
											  
		$stmt->execute(array(":followee_id" => $followee_id, ":follower_id" => $_SESSION['user_session']));	

		if(empty($stmt->fetch(PDO::FETCH_ASSOC))){
			$stmt = $this->conn->prepare("INSERT INTO follows(follower_id, followee_id) 
		                                               VALUES(:follower_id, :followee_id)");
												  
			$stmt->execute(array(":followee_id" => $followee_id, ":follower_id" => $_SESSION['user_session']));	

			return $stmt;
		}else{	
			return;
		}		
	}

	public function unfollow($followee_id)
	{
		$stmt = $this->conn->prepare("DELETE FROM follows WHERE follower_id = :follower_id AND followee_id = :followee_id");
											  
		$stmt->execute(array(":followee_id" => $followee_id, ":follower_id" => $_SESSION['user_session']));	
			
		return $stmt;	
	}

	public function update_profile($user_id, $params, $password)
	{

		$stmt = $this->conn->prepare("select count(user_id) as count from users where user_email = :email and user_id != :user_id");

		$stmt->execute(array(":email" => $params[":email"], ":user_id" => $user_id));

    $result=$stmt->fetchAll(PDO::FETCH_ASSOC)[0];

    if(empty($result['count'])){
			$new_password = password_hash($password, PASSWORD_DEFAULT);

	    $stmt = $this->conn->prepare("update users set user_name = :uname,
																		user_email = :email, user_pass = :password,
																	  description = :description, address = :address,
																	  website = :website, image_url = :image_url,
																	  user_pass = :password
																	  where user_id = :user_id");

			$stmt->execute(array_merge($params, array(":password" => $new_password, ":user_id" => $user_id)));
			return [];
    }else{
    	return $errors[] = "User with that email already exists!";
    }
	}
}
?>