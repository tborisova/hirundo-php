<?php

require_once('db/dbconfig.php');

class DB_OPERATION
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

  public function executeQuery($sql, $array){
    $stmt = $this->conn->prepare($sql);
    $stmt->execute($array);
    
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $result;
  }
}
?>