<?php

class Database
{

  private $host  = "localhost";
  private $user  = "root";
  private $password   = "groot";
  private $database  = "natnotes";

  public function koneksi()
  {
    try {
      $conn = new PDO(
        "mysql:host=$this->host;dbname=$this->database",
        $this->user,
        $this->password
      );
      return $conn;
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }
}
