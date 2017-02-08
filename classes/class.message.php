<?php

require_once('db/dbconfig.php');

class Message
{ 

  private $conn;
  private $user_id;

  public function __construct($user_id)
  {
    $this->user_id = $user_id;
    $database = new Database();
    $db = $database->dbConnection();
    $this->conn = $db;
  }
  
  public function runQuery($sql)
  {
    $stmt = $this->conn->prepare($sql);
    return $stmt;
  }

  public function addMessage($content){
    $stmt = $this->conn->prepare("
      INSERT INTO tweets (USER_ID, CONTENT)
      VALUES(:user_id, :content)");
    $stmt->execute(array(":user_id" => $this->user_id, ":content" => $content));
  }


  public function addPrivateMessage($content, $recepeint_id){
    $stmt = $this->conn->prepare("
      INSERT INTO messages (receiver_id, sender_id, message)
      VALUES(:receiver_id, :sender_id, :message)");
    $stmt->execute(array(":message" => $content, ":sender_id" => $this->user_id, ":receiver_id" => $recepeint_id));
  }
}
?>