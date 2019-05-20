<?php
    session_start();
    require_once("functions.php");
    include("db_connect.php");

    if(!isset($_POST['method']))
    {
        $user_id = $_POST['user_id'];
        $withdraw_amt = $_POST['withdraw_amt'];
    

        $sql = "INSERT INTO withdraw (user_id,amount) VALUES ('".$user_id."','".$withdraw_amt."')";

        if ($conn->query($sql) === TRUE) 
        {
            $withdraw_id = $conn->insert_id;
            
            $sql = "UPDATE trip_reservation SET trip_res_withdraw_id='".$withdraw_id."' WHERE trip_res_withdraw_id is NULL";
            if ($conn->query($sql) === TRUE) 
            {
                echo "success";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }else if ($_POST['method']=='cancle'){
        $withdraw_id = $_POST['withdraw_id'];
        $sql = "UPDATE trip_reservation SET trip_res_withdraw_id = NULL WHERE trip_res_withdraw_id ='".$withdraw_id."'";
            if ($conn->query($sql) === TRUE) 
            {
                $sql = "UPDATE withdraw set status='1' WHERE withdraw_id='".$withdraw_id."'";
                if ($conn->query($sql) === TRUE) 
                {
                    echo "success";
                }
                else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

    }else if($_POST['method']=='complete'){
        $withdraw_id = $_POST['withdraw_id'];
        $sql = "UPDATE withdraw set status='2' WHERE withdraw_id='".$withdraw_id."'";
        if ($conn->query($sql) === TRUE) 
        {
            echo "success";
        }
        else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

?>