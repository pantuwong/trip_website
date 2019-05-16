<?php  
session_start();  
require_once("functions.php");  
unset(  
    $_SESSION['ses_user_id'],  
    $_SESSION['ses_user_name']  ,  
    $_SESSION['ses_user_last_login']  
);  
session_destroy();

exit;