<?php
    session_start();
    require_once("functions.php");
    include("db_connect.php");

    $status = $_POST['status'];
    $user_id = $_POST['user_id'];
    $verify_reason = addslashes($_POST['verify_reason']);


    $sql = "UPDATE users SET status = '".$status."', verify_reason='".$verify_reason."' WHERE user_id='".$user_id."'";


    if ($conn->query($sql) === TRUE) 
    {
        echo "success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    

?>
