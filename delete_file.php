<?php
    $filename = 'upload/'.$_POST['filename'];
    unlink($filename);
    echo $filename;
?>