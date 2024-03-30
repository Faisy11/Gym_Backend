<?php
class Database
{

   
    private $servername = "193.203.184.1";
    private $username = "u651328475_gym_be";
    private $password = "Gym_be@123";
    private $dbname = "u651328475_gym_be";

    // private $servername = "localhost";
    // private $username = "root";
    // private $password = "";
    // private $dbname = "gym";

   
    private $conn;

    public function connect()
    {
        $this->conn = null;
        // Create connection
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        // Check connection
        if ($conn->connect_error) {

            die("Connection failed: " . $conn->connect_error);

        } else {
            return $conn;
        
        }

    }
   
}



?>