<?php

class DBConnection {
    private $conn;
    private $host;
    private $username;
    private $password;
    private $database;

    public function __construct($host, $username, $password, $database) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        $this->conn = mysqli_connect($host, $username, $password, $database);

        if (!$this->conn) {
            echo "Connection failed: " . mysqli_connect_error();
            die();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
    
}

$db = new DBConnection("localhost", "root", "", "db_demo");

$conn = $db->getConnection();
     
?>
