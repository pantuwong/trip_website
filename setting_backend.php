<?php
    session_start();
    require_once("functions.php");
    include("db_connect.php");

    $cust_com = $_POST['cust_com'];
    $guide_com = $_POST['guide_com'];
    $withdrawal_miminum = $_POST['withdrawal_minimum'];
    $withdrawal_process_day = $_POST['withdrawal_process_day'];
 

    $sql = "UPDATE settings SET customer_commission='".$cust_com."', guide_commission='".$guide_com."', withdrawal_minimum='".$withdrawal_miminum."', withdrawal_process_day='".$withdrawal_process_day."' WHERE setting_id='1'";

    if ($conn->query($sql) === TRUE) 
    {
        echo "success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    

?>
