<?php
    session_start();
    require_once("functions.php");
    include("db_connect.php");

    $trip_id = $_POST['trip_id'];
    $trip_status = $_POST['trip_status'];
    $trip_ver_reason = addslashes($_POST['trip_ver_reason']);


    $sql = "UPDATE trips SET trip_status = '".$trip_status."', trip_ver_reason='".$trip_ver_reason."' WHERE trip_id=".$trip_id;


    if ($conn->query($sql) === TRUE) 
    {
        echo "success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    

?>
