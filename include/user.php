<?php
class User{
    private $dbHost     = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "?halalwayz";
    private $dbName     = "halalwayz";
    private $userTbl    = "users";
    
    public function __construct(){
        //echo 'aaaa';
        if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
    public function checkExitedUser($email) {
        echo $email;
        if(!empty($email)) {
            $sql_check="SELECT * FROM users WHERE email = AND user_gg_connect=1 
            ";
            $result = $mysqli->query($sql_check);
        }
    }
    public function checkUser($email,$password) {
        $sql = "SELECT * FROM  users";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "id: " . $row["id"]. " - Name: " . $row["first_name"]. " " . $row["last_name"]. "<br>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
    }
    public function test1($text){
        echo $text;
    }
    public function getUserProfile($userid) {

    }
    public function updateuser() {

    }
}

?>