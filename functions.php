<?php  
/*
if($_SESSION['userLoggedIn'] && $_SESSION['userLoggedIn']==TRUE) {

} else {
    header("Location:login.php");
}
/*
$mysqli = new mysqli("localhost", "root","","halalwayz");  
/* check connection 
if ($mysqli->connect_errno) {  
    printf("Connect failed: %s\n", $mysqli->connect_error);  
    exit();  
}  
if(!$mysqli->set_charset("utf8")) {  
    printf("Error loading character set utf8: %s\n", $mysqli->error);  
    exit();  
}
*/
function cutString($str,$strlenght) {
    if (strlen($str) > $strlenght) {
        return substr_replace($str,'…',$strlenght);
    } else {
        return $str;
    }
}


function slugify($text){
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');

  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}
?>
