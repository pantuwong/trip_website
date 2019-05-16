<?php

    if ( 0 < $_FILES['file']['error'] ) {
        echo "e";
    }
    else {
        $uniqueID = uniqid();
        $fileInfo = pathinfo($_FILES["file"]["name"]);
        $filename = $uniqueID . '.' . $fileInfo['extension'];
        move_uploaded_file($_FILES['file']['tmp_name'], 'upload/' . $filename);
        
        echo $filename;
    }

?>