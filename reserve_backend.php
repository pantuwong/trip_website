<?php
    session_start();
    require_once("functions.php");
    include("db_connect.php");

    $trip_id = $_POST['trip_id'];
    $trip_res_adult = $_POST['trip_res_adult'];
    $trip_res_child = $_POST['trip_res_child'];
    $trip_res_date = $_POST['trip_res_date'];
    $trip_res_title = $_POST['trip_res_title'];
    $trip_res_fn = $_POST['trip_res_fn'];
    $trip_res_ln = $_POST['trip_res_ln'];
    $trip_res_email = $_POST['trip_res_email'];
    $trip_res_mobile = $_POST['trip_res_mobile'];
    $trip_res_country = $_POST['trip_res_country'];
    $trip_res_fee = $_POST['trip_res_fee'];
    $trip_res_payment_status = $_POST['trip_res_payment_status'];
    $trip_res_payment_method = $_POST['trip_res_payment_method'];
    $trip_res_cust_com = $_POST['trip_res_cust_com'];
    $trip_res_guide_com = $_POST['trip_res_price_com'];
    $res_no = uniqid();

    $sql = "INSERT INTO trip_reservation (res_no, trip_id, trip_res_adult, trip_res_child, trip_res_date, trip_res_title, trip_res_fn, trip_res_ln, trip_res_email, trip_res_mobile, trip_res_country, trip_res_fee, trip_res_payment_status, trip_res_payment_method, trip_res_cust_com, trip_res_price_com ) VALUES ('".$res_no."','".$trip_id."','".$trip_res_adult."','".$trip_res_child."', STR_TO_DATE('".$trip_res_date."','%m/%d/%Y'),'".$trip_res_title."','".$trip_res_fn."','".$trip_res_ln."','".$trip_res_email."','".$trip_res_mobile."','".$trip_res_country."','".$trip_res_fee."','".$trip_res_payment_status."','".$trip_res_payment_method."','".$trip_res_cust_com."','".$trip_res_guide_com."')";

    if ($conn->query($sql) === TRUE) 
    {
        echo "success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    

?>
