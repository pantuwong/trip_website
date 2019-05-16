 <?php
    $dbHost     = "localhost";
    $dbUsername = "root";
    $dbPassword = "?halalwayz";
    $dbName     = "halalwayz";
    $userTbl    = "users";
    $tripTbl    = "trips";
    $tripTypeTbl = "trip_type";
    $vehicleTbl = "vehicle";
    
     // Connect to the database
     $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
     if($conn->connect_error){
         die("Failed to connect with MySQL: " . $conn->connect_error);
     }

?>