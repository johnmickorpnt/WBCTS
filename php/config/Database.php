<?php

class Database{
    private $username = "root";
    private $password = "";
    private $db = "wbcts";
    private $host = "localhost";
    private $conn;
    
    public function connect(){
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        return $this->conn;
    }
}
?>