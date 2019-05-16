<?php
    session_start();
    require_once("functions.php");
    include("db_connect.php");

    $user_id = $_POST['user_id'];
    $withdraw_amt = $_POST['withdraw_amt'];
 

    $sql = "INSERT INTO withdraw (user_id,amount) VALUES ('".$user_id."','".$withdraw_amt."')";

    if ($conn->query($sql) === TRUE) 
    {
        echo "success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    

?>