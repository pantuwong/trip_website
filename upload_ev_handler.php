<?php
    session_start();
    require_once("functions.php");
    include("db_connect.php");
    $filename_id;
    if ( 0 < $_FILES['file_id']['error'] ) {
        echo "e";
    }
    else {
        $uniqueID = uniqid();
        $fileInfo = pathinfo($_FILES["file_id"]["name"]);
        $filename_id = $uniqueID . '.' . $fileInfo['extension'];
        move_uploaded_file($_FILES['file_id']['tmp_name'], 'upload/' . $filename_id);
        
    }
    $filename_bank;
    if ( 0 < $_FILES['file_bank']['error'] ) {
        echo "e";
    }
    else {
        $uniqueID = uniqid();
        $fileInfo = pathinfo($_FILES["file_bank"]["name"]);
        $filename_bank = $uniqueID . '.' . $fileInfo['extension'];
        move_uploaded_file($_FILES['file_bank']['tmp_name'], 'upload/' . $filename_bank);
        
    }
    $filename_self;
    if ( 0 < $_FILES['file_self']['error'] ) {
        echo "e";
    }
    else {
        $uniqueID = uniqid();
        $fileInfo = pathinfo($_FILES["file_self"]["name"]);
        $filename_self = $uniqueID . '.' . $fileInfo['extension'];
        move_uploaded_file($_FILES['file_self']['tmp_name'], 'upload/' . $filename_self);
        
    }
    
    // echo $_FILES["file_self"]["name"]." ".$_FILES["file_bank"]["name"]." ".$_FILES["file_id"]["name"];
    
    $sql = "UPDATE users SET evidence_id='".$filename_id."', evidence_bank='".$filename_bank."', evidence_self='".$filename_self."', status='1', verify_reason = NULL WHERE user_id='".$_SESSION['userID']."'";
    if ($conn->query($sql) === TRUE) 
    {
        echo "success";
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>