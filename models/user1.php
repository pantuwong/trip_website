<?php
$servername = "localhost";
$username = "root";
$password = "";
try {
    $GLOBALS['conn'] = new PDO("mysql:host=$servername;dbname=halalwayz", $username, $password);
    // set the PDO error mode to exception
    $GLOBALS['conn']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

if(isset($_POST['loginSubmit'])){
    checkLogin($_POST['email'],$_POST['password']);
}
// User
// Get User
function geLogedintUser($email) {
    $result = $GLOBALS['conn']->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");

    $result->execute([':email' => $email]);
    $rs = $result->fetch();
    return $arr=array("first_name"=>$rs['first_name'],"last_name"=>$rs['last_name'],"email"=>$rs['email'],"user_id"=>$rs['user_id']);
    $_SESSION['user'] = array("first_name"=>$rs['first_name'],"last_name"=>$rs['last_name'],"email"=>$rs['email'],"user_id"=>$rs['user_id']);
    /*
    while($rs = $result->fetch()){
        return $rs['first_name'];
    }
    */
    //return $rs;

}

function checkLogin($email,$password) {
    $result = $GLOBALS['conn']->prepare("SELECT * FROM users WHERE email = :email AND password = :password LIMIT 1");

    $result->execute([':email' => $email],[':password' => $password]);
    $count = $result->rowCount();
    if($count!=0) {
        return $count;
        $_SESSION['userLoggedIn'] = TRUE;
        geLogedintUser($email);
        header("Location:index.php");
    } else {
        $_SESSION['userLoggedIn'] = FALSE;
        $_SESSION['loginmsg'] = 'Wrong email or password, please try again.'; 
        header("Location:../login.php");
    }
}
function test(){
    echo 'Ok';
}

?>