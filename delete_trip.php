<?php
include "config.php";
include "db_connect.php";
include "functions.php";
$conn = new mysqli($dbHost ,$dbUsername,$dbPassword,$dbName);
if ($conn->connect_errno) {
  echo $conn->connect_error;
  exit;
}
else
{
    // delete trip
    $sql = "DELETE FROM trips WHERE trip_id = '".$_GET["tripid"]."'";
    if ($conn->query($sql) === TRUE) {
        //echo "Record deleted successfully";
    } else {
        //echo "Error deleting record: " . $conn->error;
    }

    $sql = "SELECT * FROM trip_photo WHERE trip_id = '".$_GET["tripid"]."'";
        $photoNameQuery = mysqli_query($conn,$sql);
        while($result=mysqli_fetch_array($photoNameQuery,MYSQLI_ASSOC)) { 
            $filename = 'upload/'.$result['trip_photo_name'];
            unlink($filename);
    }
}
echo '<script>window.location.href = "myprofile.php";</script>';
?>